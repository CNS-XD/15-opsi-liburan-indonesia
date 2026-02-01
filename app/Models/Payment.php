<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'xendit_response' => 'array',
        'payment_details' => 'array',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_EXPIRED = 'expired';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    // Payment method constants
    const METHOD_VIRTUAL_ACCOUNT = 'virtual_account';
    const METHOD_EWALLET = 'ewallet';
    const METHOD_QR_CODE = 'qr_code';
    const METHOD_CREDIT_CARD = 'credit_card';

    /**
     * Get the booking that owns the payment
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Check if payment is pending
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if payment is paid
     */
    public function isPaid()
    {
        return $this->status === self::STATUS_PAID;
    }

    /**
     * Check if payment is expired
     */
    public function isExpired()
    {
        return $this->status === self::STATUS_EXPIRED || 
               ($this->expired_at && $this->expired_at->isPast());
    }

    /**
     * Mark payment as paid
     */
    public function markAsPaid($paidAt = null)
    {
        $this->update([
            'status' => self::STATUS_PAID,
            'paid_at' => $paidAt ?: now(),
        ]);
    }

    /**
     * Mark payment as expired
     */
    public function markAsExpired()
    {
        $this->update([
            'status' => self::STATUS_EXPIRED,
        ]);
    }

    /**
     * Mark payment as failed
     */
    public function markAsFailed($reason = null)
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'failure_reason' => $reason,
        ]);
    }

    /**
     * Mark payment as cancelled
     */
    public function markAsCancelled($reason = null)
    {
        $this->update([
            'status' => self::STATUS_CANCELLED,
            'failure_reason' => $reason,
        ]);
        
        // Also mark the booking as cancelled
        $this->booking->markAsCancelled('Payment cancelled');
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Get USD equivalent amount
     */
    public function getUsdAmountAttribute()
    {
        $currencyService = app(\App\Services\CurrencyService::class);
        return $currencyService->convertIdrToUsd($this->amount);
    }

    /**
     * Get formatted USD amount
     */
    public function getFormattedUsdAmountAttribute()
    {
        return '$' . number_format($this->usd_amount, 2);
    }

    /**
     * Get formatted payment method
     */
    public function getFormattedPaymentMethodAttribute()
    {
        if (!$this->payment_method) {
            return 'N/A';
        }
        
        $method = match($this->payment_method) {
            'virtual_account' => 'Virtual Account',
            'ewallet' => 'E-Wallet',
            'qr_code' => 'QR Code',
            'credit_card' => 'Credit Card',
            'bank_transfer' => 'Bank Transfer',
            default => ucfirst(str_replace('_', ' ', $this->payment_method))
        };
        
        if ($this->payment_channel) {
            $channel = strtoupper($this->payment_channel);
            return "{$method} ({$channel})";
        }
        
        return $method;
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'badge-warning',
            self::STATUS_PAID => 'badge-success',
            self::STATUS_EXPIRED => 'badge-secondary',
            self::STATUS_FAILED => 'badge-danger',
            self::STATUS_CANCELLED => 'badge-dark',
            default => 'badge-secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Menunggu Pembayaran',
            self::STATUS_PAID => 'Sudah Dibayar',
            self::STATUS_EXPIRED => 'Kadaluarsa',
            self::STATUS_FAILED => 'Gagal',
            self::STATUS_CANCELLED => 'Dibatalkan',
            default => 'Unknown',
        };
    }
}
