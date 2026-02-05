<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomItineraryDestination extends Model
{
    use HasFactory;
    
    protected $table = 'custom_itinerary_destinations';
    protected $guarded = [];

    /**
     * Relationship with custom_itineraries
     */
    public function customItinerary()
    {
        return $this->belongsTo(CustomItinerary::class, 'id_custom_itinerary');
    }

    /**
     * Relationship with destinations
     */
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'id_destination');
    }
}