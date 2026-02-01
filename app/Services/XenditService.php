<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use App\Services\CurrencyService;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceCallback;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class XenditService
{
    protected $invoiceApi;
    protected $secretKey;
    protected $webhookToken;
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->secretKey = config('xendit.secret_key');
        $this->webhookToken = config('xendit.webhook_token');
        $this->currencyService = $currencyService;
        
        Configuration::setXenditKey($this->secretKey);
        $this->invoiceApi = new InvoiceApi();
    }

    /**
     * Create payment invoice for booking
     */
    public function createPaymentInvoice(Booking $booking, array $paymentMethods = ['BANK_TRANSFER', 'EWALLET', 'QR_CODE'], $method = null, $channel = null)
    {
        try {
            // Generate unique external ID
            $externalId = 'booking-' . $booking->booking_code . '-' . time();
            
            // Convert USD to IDR using dynamic exchange rate
            $amountIDR = $this->currencyService->convertUsdToIdr($booking->total_price);
            
            // Prepare payment details based on method
            $paymentDetails = $this->preparePaymentDetails($method, $channel, $amountIDR);
            
            // Create payment record first
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'payment_code' => 'PAY-' . strtoupper(Str::random(8)),
                'xendit_external_id' => $externalId,
                'payment_method' => $method,
                'payment_channel' => $channel,
                'amount' => $amountIDR,
                'currency' => 'IDR',
                'status' => Payment::STATUS_PENDING,
                'expired_at' => now()->addHours(config('xendit.payment_expiry_hours', 24)),
                'payment_details' => $paymentDetails,
            ]);

            // Always use Xendit API for real payment testing
            // Comment out the local testing bypass
            /*
            if (config('app.env') === 'local' || !config('xendit.secret_key')) {
                return [
                    'success' => true,
                    'payment' => $payment,
                    'invoice' => ['invoice_url' => route('frontsite.payment.status', $payment->payment_code)],
                    'payment_url' => route('frontsite.payment.status', $payment->payment_code)
                ];
            }
            */

            // Prepare invoice data for Xendit API
            // For test accounts, let's try without specifying payment methods first
            $invoiceData = new CreateInvoiceRequest([
                'external_id' => $externalId,
                'amount' => $amountIDR,
                'description' => 'Pembayaran untuk ' . $booking->tour->title,
                'invoice_duration' => config('xendit.payment_expiry_hours', 24) * 3600, // in seconds
                'customer' => [
                    'given_names' => $booking->name,
                    'email' => $booking->email,
                    'mobile_number' => $booking->phone,
                ],
                'customer_notification_preference' => [
                    'invoice_created' => ['email'],
                    'invoice_reminder' => ['email'],
                    'invoice_paid' => ['email'],
                    'invoice_expired' => ['email']
                ],
                'success_redirect_url' => route('frontsite.payment.success', $payment->payment_code),
                'failure_redirect_url' => route('frontsite.payment.failed', $payment->payment_code),
                'currency' => 'IDR',
                'items' => [
                    [
                        'name' => $booking->tour->title,
                        'quantity' => $booking->travelers,
                        'price' => $amountIDR / $booking->travelers,
                        'category' => 'Tour Package'
                    ]
                ],
                'fees' => [],
                // Don't specify payment_methods to let Xendit use all available methods
            ]);

            // Create invoice via Xendit API
            $invoice = $this->invoiceApi->createInvoice($invoiceData);

            // Update payment record with Xendit response
            $payment->update([
                'xendit_invoice_id' => $invoice['id'],
                'xendit_response' => $invoice,
                'payment_details' => array_merge($paymentDetails, [
                    'invoice_url' => $invoice['invoice_url'],
                    'payment_methods' => $paymentMethods,
                ])
            ]);

            return [
                'success' => true,
                'payment' => $payment,
                'invoice' => $invoice,
                'payment_url' => $invoice['invoice_url']
            ];

        } catch (Exception $e) {
            Log::error('Xendit payment creation failed: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Prepare payment details based on method and channel
     */
    private function preparePaymentDetails($method, $channel, $amount)
    {
        switch ($method) {
            case 'virtual_account':
                return [
                    'method_name' => 'Virtual Account',
                    'channel_name' => strtoupper($channel),
                    'va_number' => '1234' . rand(100000000000, 999999999999),
                    'account_holder_name' => 'OPSI LIBURAN INDONESIA',
                    'instructions' => 'Transfer ke nomor Virtual Account di atas sebelum expired'
                ];
                
            case 'ewallet':
                return [
                    'method_name' => 'E-Wallet',
                    'channel_name' => strtoupper($channel),
                    'instructions' => 'Buka aplikasi ' . strtoupper($channel) . ' dan konfirmasi pembayaran'
                ];
                
            case 'qr_code':
                return [
                    'method_name' => 'QR Code',
                    'channel_name' => 'QRIS',
                    'qr_string' => '00020101021226580014ID.CO.QRIS.WWW0215ID20232024000010303UMI51440014ID.LINKAJA.WWW0215901234567890103UMI5204481253033605802ID5914OPSI LIBURAN6007JAKARTA61051234062070703A0163044B7A',
                    'instructions' => 'Scan QR Code dengan aplikasi mobile banking atau e-wallet'
                ];
                
            case 'credit_card':
                return [
                    'method_name' => 'Credit Card',
                    'channel_name' => 'VISA/MASTERCARD',
                    'instructions' => 'Masukkan detail kartu kredit di halaman pembayaran yang aman'
                ];
                
            default:
                return [
                    'method_name' => 'Unknown',
                    'channel_name' => 'Unknown',
                    'instructions' => 'Complete payment'
                ];
        }
    }

    /**
     * Create Virtual Account payment
     */
    public function createVirtualAccount(Booking $booking, $bankCode = 'BCA')
    {
        try {
            // For Virtual Account, we'll use the invoice method with specific payment method
            return $this->createPaymentInvoice($booking, ['BANK_TRANSFER'], 'virtual_account', strtolower($bankCode));
        } catch (Exception $e) {
            Log::error('Virtual Account creation failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Create E-Wallet payment
     */
    public function createEWalletPayment(Booking $booking, $ewalletType = 'OVO')
    {
        try {
            return $this->createPaymentInvoice($booking, ['EWALLET'], 'ewallet', strtolower($ewalletType));
        } catch (Exception $e) {
            Log::error('E-Wallet payment creation failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Create QR Code payment
     */
    public function createQRPayment(Booking $booking)
    {
        try {
            return $this->createPaymentInvoice($booking, ['QR_CODE'], 'qr_code', 'qris');
        } catch (Exception $e) {
            Log::error('QR Code payment creation failed: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Handle webhook callback
     */
    public function handleWebhook($payload, $headers)
    {
        try {
            // Verify webhook token
            $webhookToken = $headers['x-callback-token'] ?? '';
            if ($webhookToken !== $this->webhookToken) {
                Log::warning('Invalid webhook token received');
                return ['success' => false, 'error' => 'Invalid webhook token'];
            }

            $externalId = $payload['external_id'];
            $status = $payload['status'];
            $paidAt = isset($payload['paid_at']) ? Carbon::parse($payload['paid_at']) : null;

            // Find payment by external ID
            $payment = Payment::where('xendit_external_id', $externalId)->first();
            
            if (!$payment) {
                Log::warning('Payment not found for external ID: ' . $externalId);
                return ['success' => false, 'error' => 'Payment not found'];
            }

            // Update payment status based on Xendit status
            $payment->xendit_status = $status;
            $payment->xendit_response = $payload;

            switch (strtoupper($status)) {
                case 'PAID':
                    $payment->markAsPaid($paidAt);
                    $payment->booking->update(['status' => 'confirmed']);
                    break;
                    
                case 'EXPIRED':
                    $payment->markAsExpired();
                    break;
                    
                case 'FAILED':
                    $payment->markAsFailed($payload['failure_code'] ?? 'Payment failed');
                    break;
            }

            $payment->save();

            Log::info('Webhook processed successfully', [
                'external_id' => $externalId,
                'status' => $status,
                'payment_id' => $payment->id
            ]);

            return ['success' => true, 'payment' => $payment];

        } catch (Exception $e) {
            Log::error('Webhook processing failed: ' . $e->getMessage(), [
                'payload' => $payload,
                'error' => $e->getMessage()
            ]);

            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get payment status from Xendit
     */
    public function getPaymentStatus($invoiceId)
    {
        try {
            // Use getInvoiceById instead of getInvoice
            $invoice = $this->invoiceApi->getInvoiceById($invoiceId);
            return [
                'success' => true,
                'invoice' => $invoice
            ];
        } catch (Exception $e) {
            Log::error('Failed to get payment status: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Cancel payment
     */
    public function cancelPayment($invoiceId)
    {
        try {
            // Use expireInvoiceById instead of expireInvoice
            $invoice = $this->invoiceApi->expireInvoiceById($invoiceId);
            return [
                'success' => true,
                'invoice' => $invoice
            ];
        } catch (Exception $e) {
            Log::error('Failed to cancel payment: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}