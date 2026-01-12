<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TourPrice extends Model
{
    use HasFactory;

    protected $table = 'tour_prices';
    protected $guarded = [];

    /**
     * Disable default timestamps karena kita handle manual
     */
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
     * Format created_at (WIB)
     */
    public function getCreatedAtAttribute($date)
    {
        if (!$date) {
            return null;
        }

        return Carbon::parse($date)
            ->timezone('Asia/Jakarta')
            ->translatedFormat('l, d F Y H:i') . ' WIB';
    }

    /**
     * Relasi ke Tour
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour');
    }
}
