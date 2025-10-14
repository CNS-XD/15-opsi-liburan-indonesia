<?php

use App\Http\Middleware\IsLoggedIn;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backsite\DepartureController;
use App\Http\Controllers\Backsite\DestinationController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\BerandaController;
use App\Http\Controllers\Backsite\ProfilController;

// Backsite Routes with Middleware
Route::prefix('backsite')->name('backsite.')->middleware('auth')->group(function () {
    // Profil
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::resource('user', ProfilController::class)->except('destroy');
        Route::get('print', [ProfilController::class, 'print'])->name('print');
    });
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Departure
    Route::resource('departure', DepartureController::class)->except('destroy');
    Route::prefix('departure')->name('departure.')->group(function () {
        Route::delete('destroy-departure/{id}', [DepartureController::class, 'destroy'])->name('destroy');
        Route::get('dtable/departure', [DepartureController::class, 'datatable'])->name('datatable');
    });

    // Destination
    Route::resource('destination', DestinationController::class)->except('destroy');
    Route::prefix('destination')->name('destination.')->group(function () {
        Route::delete('destroy-destination/{id}', [DestinationController::class, 'destroy'])->name('destroy');
        Route::get('dtable/destination', [DestinationController::class, 'datatable'])->name('datatable');
    });
});