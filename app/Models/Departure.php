<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Departure extends Model
{
    use HasFactory;
    
    protected $table = 'departures';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($newData) {
            $newData->created_by = Auth::user()->email ?? null;
            $newData->created_at = Carbon::now()->toDateTimeString();
            $newData->updated_at = NULL;
        });

        static::updating(function ($updateData) {
            $updateData->updated_by = Auth::user()->email ?? null;
            $updateData->updated_at = Carbon::now()->toDateTimeString();
        });
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)
        ->timezone('Asia/Jakarta')
        ->translatedFormat('l, d F Y H:i') . ' WIB';
    }

    /**
     * Relationship with tour_departures
     */
    public function tour_departures()
    {
        return $this->hasMany(TourDeparture::class, 'id_departure');
    }

    /**
     * Get tours through tour_departures
     */
    public function tours()
    {
        return $this->hasManyThrough(
            Tour::class,
            TourDeparture::class,
            'id_departure', // Foreign key on tour_departures table
            'id', // Foreign key on tours table
            'id', // Local key on departures table
            'id_tour' // Local key on tour_departures table
        );
    }
}
