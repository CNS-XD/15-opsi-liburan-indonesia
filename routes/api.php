<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('opsitravel', Controller::class)->names('opsitravel');
});
