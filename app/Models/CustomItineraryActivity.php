<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomItineraryActivity extends Model
{
    use HasFactory;
    
    protected $table = 'custom_itinerary_activities';
    protected $guarded = [];

    /**
     * Relationship with custom_itineraries
     */
    public function customItinerary()
    {
        return $this->belongsTo(CustomItinerary::class, 'id_custom_itinerary');
    }
}