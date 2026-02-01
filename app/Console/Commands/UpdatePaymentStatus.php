<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use App\Models\Booking;

class UpdatePaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:update-status {--payment-code= : Specific payment code to update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update payment status for testing purposes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paymentCode = $this->option('payment-code');
        
        if ($paymentCode) {
            // Update specific payment
            $payment = Payment::where('payment_code', $paymentCode)->first();
            
            if (!$payment) {
                $this->error("Payment with code {$paymentCode} not found!");
                return 1;
            }
            
            $this->updatePayment($payment);
        } else {
            // Update all pending payments
            $pendingPayments = Payment::where('status', 'pending')->get();
            
            $this->info("Found " . $pendingPayments->count() . " pending payments");
            
            foreach ($pendingPayments as $payment) {
                $this->updatePayment($payment);
            }
        }
        
        $this->info("Payment status update completed!");
        return 0;
    }
    
    private function updatePayment($payment)
    {
        $this->info("Updating Payment: " . $payment->payment_code);
        $this->info("Booking: " . $payment->booking->booking_code);
        $this->info("Current Status: " . $payment->status);
        
        // Mark as paid
        $payment->markAsPaid();
        $payment->booking->markAsConfirmed();
        
        // Set payment method if null (for testing)
        if (!$payment->payment_method) {
            $payment->payment_method = 'virtual_account';
            $payment->payment_channel = 'bca';
            $payment->save();
            $this->info("Set payment method to: virtual_account (BCA)");
        }
        
        $this->info("New Status: " . $payment->fresh()->status);
        $this->info("Booking Status: " . $payment->booking->fresh()->status);
        $this->info("---");
    }
}
