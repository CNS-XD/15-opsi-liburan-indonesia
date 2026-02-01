<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TourReview extends Model
{
    use HasFactory;

    protected $table = 'tour_reviews';
    protected $guarded = [];

    // Enable timestamps
    public $timestamps = true;
    
    // Cast created_at to Carbon instance
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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

    /**
     * Relasi ke tabel tours
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }
}
