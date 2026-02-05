<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $xenditService;
    protected $currencyService;

    public function __construct(XenditService $xenditService, \App\Services\CurrencyService $currencyService)
    {
        $this->xenditService = $xenditService;
        $this->currencyService = $currencyService;
    }

    /**
     * Show booking confirmation page before payment
     */
    public function show($bookingCode)
    {
        $booking = Booking::with('tour')->where('booking_code', $bookingCode)->firstOrFail();
        
        // Check if booking already has a pending payment
        $existingPayment = $booking->payments()->where('status', Payment::STATUS_PENDING)->first();
        
        if ($existingPayment && !$existingPayment->isExpired()) {
            return redirect()->route('frontsite.payment.status', $existingPayment->payment_code);
        }

        // Get current exchange rate
        $exchangeRate = $this->currencyService->getUsdToIdrRate();
        $idrAmount = $this->currencyService->convertUsdToIdr($booking->total_price);

        return view('pages.frontsite.payment.confirmation', compact('booking', 'exchangeRate', 'idrAmount'));
    }

    /**
     * Process payment creation and redirect to Xendit
     */
    public function create($bookingCode)
    {
        $booking = Booking::with('tour')->where('booking_code', $bookingCode)->firstOrFail();
        
        // Check if booking already has a pending payment
        $existingPayment = $booking->payments()->where('status', Payment::STATUS_PENDING)->first();
        
        if ($existingPayment && !$existingPayment->isExpired()) {
            return redirect()->route('frontsite.payment.status', $existingPayment->payment_code);
        }

        // Directly create payment without method selection
        try {
            // Cancel any existing pending payments
            $booking->payments()->where('status', Payment::STATUS_PENDING)->update([
                'status' => Payment::STATUS_CANCELLED
            ]);

            // Create payment with all available methods (let Xendit handle the selection)
            $result = $this->xenditService->createPaymentInvoice($booking, ['BANK_TRANSFER', 'EWALLET', 'QR_CODE', 'CREDIT_CARD']);

            if ($result['success']) {
                $payment = $result['payment'];
                
                // If we have invoice URL, redirect directly to Xendit
                if (isset($result['invoice']['invoice_url'])) {
                    return redirect($result['invoice']['invoice_url']);
                }
                
                // Otherwise, show status page
                return redirect()->route('frontsite.payment.status', $payment->payment_code);
            } else {
                return redirect()->back()
                    ->with('error', 'Gagal membuat pembayaran: ' . $result['error']);
            }

        } catch (\Exception $e) {
            Log::error('Payment creation failed', [
                'booking_code' => $bookingCode,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat membuat pembayaran. Silakan coba lagi.');
        }
    }

    /**
     * Show payment status
     */
    public function status($paymentCode)
    {
        $payment = Payment::with('booking.tour')->where('payment_code', $paymentCode)->firstOrFail();
        
        // Check if payment is expired
        if ($payment->isExpired() && $payment->status === Payment::STATUS_PENDING) {
            $payment->markAsExpired();
        }

        return view('pages.frontsite.payment.status', compact('payment'));
    }

    /**
     * Payment success callback
     */
    public function success($paymentCode)
    {
        $payment = Payment::with('booking.tour')->where('payment_code', $paymentCode)->firstOrFail();
        
        // For test environment, manually mark as paid if coming from success URL
        if ($payment->status === Payment::STATUS_PENDING) {
            Log::info('Payment success page accessed, marking as paid', [
                'payment_code' => $paymentCode,
                'payment_id' => $payment->id
            ]);
            
            $payment->markAsPaid();
            $payment->booking->markAsConfirmed();
        }
        
        // Also try to get latest status from Xendit
        if ($payment->xendit_invoice_id) {
            $statusResult = $this->xenditService->getPaymentStatus($payment->xendit_invoice_id);
            if ($statusResult['success']) {
                $invoice = $statusResult['invoice'];
                Log::info('Xendit status check', [
                    'payment_code' => $paymentCode,
                    'xendit_status' => $invoice['status'] ?? 'unknown'
                ]);
                
                // Update payment method and channel from Xendit response
                if (isset($invoice['payment_method']) && !$payment->payment_method) {
                    $payment->payment_method = $invoice['payment_method'];
                }
                if (isset($invoice['payment_channel']) && !$payment->payment_channel) {
                    $payment->payment_channel = $invoice['payment_channel'];
                }
                
                if (strtoupper($invoice['status']) === 'PAID' && $payment->status !== Payment::STATUS_PAID) {
                    $payment->markAsPaid();
                    $payment->booking->markAsConfirmed();
                }
                
                $payment->save();
            }
        }

        return view('pages.frontsite.payment.success', compact('payment'));
    }

    /**
     * Payment failed callback
     */
    public function failed($paymentCode)
    {
        $payment = Payment::with('booking.tour')->where('payment_code', $paymentCode)->firstOrFail();
        
        if ($payment->status === Payment::STATUS_PENDING) {
            $payment->markAsFailed('Payment failed or cancelled by user');
        }

        return view('pages.frontsite.payment.failed', compact('payment'));
    }

    /**
     * Cancel payment
     */
    public function cancel($paymentCode)
    {
        try {
            Log::info('Cancel payment request received', ['payment_code' => $paymentCode]);
            
            $payment = Payment::with('booking.tour')->where('payment_code', $paymentCode)->firstOrFail();
            
            Log::info('Payment found for cancellation', [
                'payment_id' => $payment->id,
                'status' => $payment->status,
                'xendit_invoice_id' => $payment->xendit_invoice_id
            ]);
            
            if ($payment->status === Payment::STATUS_PENDING) {
                if ($payment->xendit_invoice_id) {
                    Log::info('Attempting to cancel payment via Xendit API');
                    $result = $this->xenditService->cancelPayment($payment->xendit_invoice_id);
                    
                    Log::info('Xendit cancel result', $result);
                    
                    if ($result['success']) {
                        Log::info('Payment cancelled successfully via Xendit');
                        return redirect()->route('frontsite.payment.status', $payment->payment_code)
                            ->with('success', 'Pembayaran berhasil dibatalkan.');
                    } else {
                        Log::error('Failed to cancel payment via Xendit', ['error' => $result['error']]);
                        
                        // If Xendit API fails, still cancel locally
                        Log::info('Xendit API failed, cancelling payment locally');
                        $payment->markAsCancelled('Cancelled by user (Xendit API failed)');
                        
                        return redirect()->route('frontsite.payment.status', $payment->payment_code)
                            ->with('info', 'Pembayaran telah dibatalkan secara lokal.');
                    }
                } else {
                    // Manually cancel if no Xendit invoice ID
                    Log::info('Manually cancelling payment (no Xendit invoice ID)');
                    $payment->markAsCancelled('Cancelled by user');
                    
                    return redirect()->route('frontsite.payment.status', $payment->payment_code)
                        ->with('info', 'Pembayaran telah dibatalkan.');
                }
            } else {
                Log::warning('Attempted to cancel payment with non-pending status', [
                    'payment_code' => $paymentCode,
                    'current_status' => $payment->status
                ]);
                
                return redirect()->back()
                    ->with('error', 'Pembayaran tidak dapat dibatalkan karena status saat ini: ' . $payment->status_label);
            }
        } catch (\Exception $e) {
            Log::error('Error in cancel payment', [
                'payment_code' => $paymentCode,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat membatalkan pembayaran. Silakan coba lagi.');
        }
    }

    /**
     * Webhook handler for Xendit callbacks
     */
    public function webhook(Request $request)
    {
        $payload = $request->all();
        $headers = $request->headers->all();

        $result = $this->xenditService->handleWebhook($payload, $headers);

        if ($result['success']) {
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => $result['error']], 400);
        }
    }

    /**
     * Check payment status via AJAX
     */
    public function checkStatus($paymentCode)
    {
        $payment = Payment::where('payment_code', $paymentCode)->firstOrFail();
        
        // Get latest status from Xendit
        if ($payment->xendit_invoice_id) {
            $statusResult = $this->xenditService->getPaymentStatus($payment->xendit_invoice_id);
            if ($statusResult['success']) {
                $invoice = $statusResult['invoice'];
                $xenditStatus = strtoupper($invoice['status']);
                
                if ($xenditStatus === 'PAID' && $payment->status !== Payment::STATUS_PAID) {
                    $payment->markAsPaid();
                    $payment->booking->markAsConfirmed();
                } elseif ($xenditStatus === 'EXPIRED' && $payment->status === Payment::STATUS_PENDING) {
                    $payment->markAsExpired();
                }
            }
        }

        return response()->json([
            'status' => $payment->status,
            'status_label' => $payment->status_label,
            'is_paid' => $payment->isPaid(),
            'is_expired' => $payment->isExpired(),
        ]);
    }
}
