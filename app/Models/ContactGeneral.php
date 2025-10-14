<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactGeneral extends Model
{
    protected $table = 'contact_generals';
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
}
