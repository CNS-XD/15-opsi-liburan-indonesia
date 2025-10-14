<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;

class Testimony extends Model
{
    use HasFactory;
    
    protected $table = 'testimonys';
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
}
