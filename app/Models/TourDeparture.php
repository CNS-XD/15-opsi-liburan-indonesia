<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TourDeparture extends Model
{
    use HasFactory;

    protected $table = 'tour_departures';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::user()->email ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->email ?? null;
        });
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class, 'id_departure');
    }
}