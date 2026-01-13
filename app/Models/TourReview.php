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

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::user()->email ?? null;
            $model->created_at = Carbon::now()->toDateTimeString();
            $model->updated_at = null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->email ?? null;
            $model->updated_at = Carbon::now()->toDateTimeString();
        });
    }

    /**
     * Relasi ke tabel tours
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }

    /**
     * Format created_at ke WIB (Indonesia)
     */
    public function getCreatedAtAttribute($value)
    {
        if (!$value) {
            return null;
        }

        return Carbon::parse($value)
            ->timezone('Asia/Jakarta')
            ->translatedFormat('l, d F Y H:i') . ' WIB';
    }
}
