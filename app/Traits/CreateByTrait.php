<?php
/**
* @author Nando (c) 2018
* Simple Ajax Trait
*/
namespace App\Traits;
use Illuminate\Support\Carbon;
use Schema;
use log;

trait CreateByTrait
{
    protected static function booted()
    {
        parent::boot();
        static::creating(function ($model) {
            try {
                if (!app()->runningInConsole()) {
                    if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                        $model->created_by = auth()->user()->email ?? NULL;
                    }
                    $model->created_at = Carbon::now()->toDateTimeString();
                    $model->updated_at = NULL;
                }
            } catch (\Exception $e) {
                Log::error("ERROR By Trait : " . $e->getMessage());
                abort(500, $e->getMessage());
            }
        });

        static::updating(function ($model) {
            try {
                if (!app()->runningInConsole()) {
                    if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                        $model->updated_by = auth()->user()->email ?? NULL;
                    }
                    $model->updated_at = Carbon::now()->toDateTimeString();
                }
            } catch (\Exception $e) {
                Log::error("ERROR By Trait : " . $e->getMessage());
                abort(500, $e->getMessage());
            }
        });        
    }
}
