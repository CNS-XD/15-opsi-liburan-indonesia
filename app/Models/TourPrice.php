<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TourPrice extends Model
{
    use HasFactory;
    
    protected $table = 'tour_price';
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

	public function tour()
	{
		return $this->belongsTo(Tour::class, 'id_tour');
	}
}
