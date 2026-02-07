<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CustomItinerary extends Model
{
    use HasFactory;
    
    protected $table = 'custom_itineraries';
    protected $guarded = [];

    protected $casts = [
        'date_flexible' => 'boolean',
        'travel_date_start' => 'date',
        'travel_date_end' => 'date',
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
        'estimated_price' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'request_code';
    }

    /**
     * Boot method to generate request code automatically
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->request_code)) {
                $model->request_code = self::generateRequestCode();
            }
        });
    }

    /**
     * Generate unique request code
     * Format: CI-YYYYMMDD-XXXX (CI = Custom Itinerary)
     */
    public static function generateRequestCode()
    {
        $date = date('Ymd');
        $prefix = 'CI-' . $date . '-';
        
        // Get last request code for today
        $lastRequest = self::where('request_code', 'like', $prefix . '%')
            ->orderBy('request_code', 'desc')
            ->first();
        
        if ($lastRequest) {
            // Extract number from last code and increment
            $lastNumber = (int) substr($lastRequest->request_code, -4);
            $newNumber = $lastNumber + 1;
        } else {
            // First request of the day
            $newNumber = 1;
        }
        
        // Format: CI-20260207-0001
        return $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    // Status constants
    const STATUS = [
        'pending' => 'pending',
        'review' => 'review',
        'quoted' => 'quoted',
        'confirmed' => 'confirmed',
        'cancelled' => 'cancelled'
    ];

    // Status labels
    const STATUS_LABELS = [
        'pending' => 'Request Received',
        'review' => 'Expert Review',
        'quoted' => 'Quote Preparation',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled'
    ];

    // Tour type constants
    const TOUR_TYPES = [
        'private' => 'Private Tour',
        'sharing' => 'Sharing Tour',
        'group' => 'Group Tour'
    ];

    // Accommodation level constants
    const ACCOMMODATION_LEVELS = [
        'budget' => 'Budget',
        'standard' => 'Standard',
        'luxury' => 'Luxury'
    ];

    // Transportation type constants
    const TRANSPORTATION_TYPES = [
        'car' => 'Car',
        'bus' => 'Bus',
        'flight' => 'Flight'
    ];

    /**
     * Relationship with custom_itinerary_destinations
     */
    public function destinations()
    {
        return $this->hasMany(CustomItineraryDestination::class, 'id_custom_itinerary')
            ->orderBy('sequence_order');
    }

    /**
     * Relationship with custom_itinerary_activities
     */
    public function activities()
    {
        return $this->hasMany(CustomItineraryActivity::class, 'id_custom_itinerary');
    }

    /**
     * Get formatted status
     */
    public function getStatusLabelAttribute()
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get formatted tour type
     */
    public function getTourTypeLabelAttribute()
    {
        return self::TOUR_TYPES[$this->tour_type] ?? $this->tour_type;
    }

    /**
     * Get formatted accommodation level
     */
    public function getAccommodationLevelLabelAttribute()
    {
        return self::ACCOMMODATION_LEVELS[$this->accommodation_level] ?? $this->accommodation_level;
    }

    /**
     * Get formatted transportation type
     */
    public function getTransportationTypeLabelAttribute()
    {
        return self::TRANSPORTATION_TYPES[$this->transportation_type] ?? $this->transportation_type;
    }

    /**
     * Get total participants
     */
    public function getTotalParticipantsAttribute()
    {
        return $this->participants_adult + $this->participants_child;
    }

    /**
     * Get formatted budget range
     */
    public function getBudgetRangeAttribute()
    {
        if ($this->budget_min && $this->budget_max) {
            return '$' . number_format($this->budget_min, 0) . ' - $' . number_format($this->budget_max, 0);
        } elseif ($this->budget_min) {
            return 'From $' . number_format($this->budget_min, 0);
        } elseif ($this->budget_max) {
            return 'Up to $' . number_format($this->budget_max, 0);
        }
        return 'Flexible';
    }

    /**
     * Get formatted travel dates
     */
    public function getTravelDatesAttribute()
    {
        if ($this->date_flexible) {
            return 'Flexible dates';
        }
        
        if ($this->travel_date_start && $this->travel_date_end) {
            return $this->travel_date_start->format('M d, Y') . ' - ' . $this->travel_date_end->format('M d, Y');
        } elseif ($this->travel_date_start) {
            return 'From ' . $this->travel_date_start->format('M d, Y');
        }
        
        return 'Not specified';
    }
}