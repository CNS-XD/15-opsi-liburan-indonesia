<?php

use App\Http\Middleware\IsLoggedIn;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backsite\DestinationController;
use App\Http\Controllers\Backsite\DepartureController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\AdvantageController;
use App\Http\Controllers\Backsite\SliderController;
use App\Http\Controllers\Backsite\GeneralController;
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

    // General
    Route::resource('general', GeneralController::class)->except('destroy', 'edit', 'show', 'create');
    Route::prefix('general')->name('general.')->group(function () {
        Route::get('edit/{id}', [GeneralController::class, 'edit'])->name('edit');
        Route::post('destroy/{id}', [GeneralController::class, 'destroy'])->name('destroy');
        Route::get('dtable/datatable-socmed', [GeneralController::class, 'datatableSocmed'])->name('datatable-socmed');
        Route::get('dtable/datatable-partner', [GeneralController::class, 'datatablePartner'])->name('datatable-partner');
    });

    // Slider
    Route::resource('slider', SliderController::class)->except('destroy');
    Route::prefix('slider')->name('slider.')->group(function () {
        Route::delete('destroy-slider/{id}', [SliderController::class, 'destroy'])->name('destroy');
        Route::post('set-show-slider/{id}', [SliderController::class, 'setShow'])->name('set-show');
        Route::get('dtable/slider', [SliderController::class, 'datatable'])->name('datatable');
    });

    // Advantage
    Route::resource('advantage', AdvantageController::class)->except('destroy');
    Route::prefix('advantage')->name('advantage.')->group(function () {
        Route::delete('destroy-advantage/{id}', [AdvantageController::class, 'destroy'])->name('destroy');
        Route::post('set-show-advantage/{id}', [AdvantageController::class, 'setShow'])->name('set-show');
        Route::get('dtable/advantage', [AdvantageController::class, 'datatable'])->name('datatable');
    });
});