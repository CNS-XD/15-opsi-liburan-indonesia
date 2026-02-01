<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';
    protected $guarded = [];

    const SHOW = [
        'draft' => 0,
        'publish' => 1,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($data) {
            $data->created_by = Auth::user()->email ?? null;
            
            // Generate slug if not provided
            if (empty($data->slug)) {
                $data->slug = Str::slug($data->title);
            }
        });

        static::updating(function ($data) {
            $data->updated_by = Auth::user()->email ?? null;
            
            // Update slug if title changed
            if ($data->isDirty('title') && empty($data->slug)) {
                $data->slug = Str::slug($data->title);
            }
        });
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)
        ->timezone('Asia/Jakarta')
        ->translatedFormat('l, d F Y H:i') . ' WIB';
    }

	public function tour_departures()
	{
		return $this->hasMany(TourDeparture::class, 'id_tour');
	}

	public function tour_destinations()
	{
		return $this->hasMany(TourDestination::class, 'id_tour');
	}

	public function tour_details()
	{
		return $this->hasMany(TourDetail::class, 'id_tour');
	}

	public function tour_photos()
	{
		return $this->hasMany(TourPhoto::class, 'id_tour');
	}

	public function tour_prices()
	{
		return $this->hasMany(TourPrice::class, 'id_tour');
	}

	public function tour_reviews()
	{
		return $this->hasMany(TourReview::class, 'id_tour');
	}

	public function bookings()
	{
		return $this->hasMany(Booking::class, 'id_tour');
	}
}

