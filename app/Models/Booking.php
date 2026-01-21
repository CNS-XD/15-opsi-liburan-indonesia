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

    protected $fillable = [
        'id_tour',
        'id_tour_price',
        'order_date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($newData) {
            $newData->created_by = Auth::user()->email ?? null;
            $newData->created_at = Carbon::now()->toDateTimeString();
            $newData->updated_at = null;
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

    // RELATION
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }

    public function tourPrice()
    {
        return $this->belongsTo(TourPrice::class, 'id_tour_price');
    }
}
