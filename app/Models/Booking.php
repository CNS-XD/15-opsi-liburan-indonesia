<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $guarded = [];

    public $timestamps = false;

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($newData) {
            // For frontend bookings, use the customer's email as created_by
            $newData->created_by = $newData->email ?? (Auth::user()->email ?? null);
            $newData->created_at = Carbon::now()->toDateTimeString();
            $newData->updated_at = null;
            
            // Set default status if not provided
            if (!$newData->status) {
                $newData->status = self::STATUS_PENDING;
            }
        });

        static::updating(function ($updateData) {
            $updateData->updated_by = Auth::user()->email ?? null;
            $updateData->updated_at = Carbon::now()->toDateTimeString();
        });
    }

    // FORMAT CREATED AT
    public function getCreatedAtAttribute($date)
    {
        if (!$date) {
            return null;
        }

        return Carbon::parse($date)
            ->timezone('Asia/Jakarta')
            ->translatedFormat('l, d F Y H:i') . ' WIB';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'badge-warning',
            self::STATUS_CONFIRMED => 'badge-success',
            self::STATUS_CANCELLED => 'badge-danger',
            self::STATUS_COMPLETED => 'badge-info',
            default => 'badge-secondary',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Menunggu Konfirmasi',
            self::STATUS_CONFIRMED => 'Dikonfirmasi',
            self::STATUS_CANCELLED => 'Dibatalkan',
            self::STATUS_COMPLETED => 'Selesai',
            default => 'Unknown',
        };
    }

    /**
     * Mark booking as cancelled
     */
    public function markAsCancelled($reason = null)
    {
        $this->update([
            'status' => self::STATUS_CANCELLED,
            'cancellation_reason' => $reason,
        ]);
    }

    /**
     * Mark booking as confirmed
     */
    public function markAsConfirmed()
    {
        $this->update([
            'status' => self::STATUS_CONFIRMED,
        ]);
    }

    // RELATION
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }

    public function tourPrice()
    {
        return $this->belongsTo(TourPrice::class, 'id_tour_price');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latest();
    }
}
