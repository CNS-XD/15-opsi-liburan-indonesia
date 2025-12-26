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
        });

        static::updating(function ($data) {
            $data->updated_by = Auth::user()->email ?? null;
        });
    }
}

