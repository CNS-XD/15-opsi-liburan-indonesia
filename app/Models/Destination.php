<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Destination extends Model
{
    use HasFactory;
    
    protected $table = 'destinations';
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
     * Relationship with tour_destinations
     */
    public function tour_destinations()
    {
        return $this->hasMany(TourDestination::class, 'id_destination');
    }

    /**
     * Get tours through tour_destinations
     */
    public function tours()
    {
        return $this->hasManyThrough(
            Tour::class,
            TourDestination::class,
            'id_destination', // Foreign key on tour_destinations table
            'id', // Foreign key on tours table
            'id', // Local key on destinations table
            'id_tour' // Local key on tour_destinations table
        );
    }

    /**
     * Get count of published tours for this destination
     */
    public function getPublishedToursCountAttribute()
    {
        return $this->tour_destinations()
            ->whereHas('tour', function($query) {
                $query->where('show', Tour::SHOW['publish']);
            })
            ->count();
    }

    /**
     * Scope to get destinations with published tours
     */
    public function scopeWithPublishedTours($query)
    {
        return $query->whereHas('tour_destinations.tour', function($q) {
            $q->where('show', Tour::SHOW['publish']);
        });
    }
}
