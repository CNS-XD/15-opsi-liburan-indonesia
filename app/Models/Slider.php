<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Slider extends Model
{
    use HasFactory;
    
    public const SHOW = [
        'draft' => 0,
        'publish' => 1
    ];

    public const TYPE = [
        'image' => 0,
        'video' => 1
    ];
    
    protected $table = 'sliders';
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

    /**
     * Get slider media URL
     */
    public function getMediaUrlAttribute()
    {
        if ($this->value) {
            return asset('storage/' . $this->value);
        }
        return null;
    }

    /**
     * Check if slider is video type
     */
    public function isVideo()
    {
        return $this->type == self::TYPE['video'];
    }

    /**
     * Check if slider is image type
     */
    public function isImage()
    {
        return $this->type == self::TYPE['image'];
    }

    /**
     * Check if slider is published
     */
    public function isPublished()
    {
        return $this->show == self::SHOW['publish'];
    }

    /**
     * Scope for published sliders
     */
    public function scopePublished($query)
    {
        return $query->where('show', self::SHOW['publish']);
    }
}
