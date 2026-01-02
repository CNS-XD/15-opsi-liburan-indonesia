<?php

use App\Http\Middleware\IsLoggedIn;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backsite\TourDepartureController;
use App\Http\Controllers\Backsite\DestinationController;
use App\Http\Controllers\Backsite\DepartureController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\AdvantageController;
use App\Http\Controllers\Backsite\TestimonyController;
use App\Http\Controllers\Backsite\GeneralController;
use App\Http\Controllers\Backsite\SliderController;
use App\Http\Controllers\Backsite\ProfilController;
use App\Http\Controllers\Backsite\AboutController;
use App\Http\Controllers\Backsite\ThemeController;
use App\Http\Controllers\Backsite\BlogController;
use App\Http\Controllers\Backsite\TourController;
use App\Http\Controllers\Backsite\UserController;
use App\Http\Controllers\Backsite\FaqController;

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

    // About
    Route::prefix('about')->name('about.')->group(function () {
        Route::post('update', [AboutController::class, 'update'])->name('update');
        Route::get('/', [AboutController::class, 'index'])->name('index');
    });

    // Advantage
    Route::resource('advantage', AdvantageController::class)->except('destroy');
    Route::prefix('advantage')->name('advantage.')->group(function () {
        Route::delete('destroy-advantage/{id}', [AdvantageController::class, 'destroy'])->name('destroy');
        Route::post('set-show-advantage/{id}', [AdvantageController::class, 'setShow'])->name('set-show');
        Route::get('dtable/advantage', [AdvantageController::class, 'datatable'])->name('datatable');
    });

    // Testimony
    Route::resource('testimony', TestimonyController::class)->except('destroy');
    Route::prefix('testimony')->name('testimony.')->group(function () {
        Route::delete('destroy-testimony/{id}', [TestimonyController::class, 'destroy'])->name('destroy');
        Route::post('set-show-testimony/{id}', [TestimonyController::class, 'setShow'])->name('set-show');
        Route::get('dtable/testimony', [TestimonyController::class, 'datatable'])->name('datatable');
    });

    // Faq
    Route::resource('faq', FaqController::class)->except('destroy');
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::delete('destroy-faq/{id}', [FaqController::class, 'destroy'])->name('destroy');
        Route::post('set-show-faq/{id}', [FaqController::class, 'setShow'])->name('set-show');
        Route::get('dtable/faq', [FaqController::class, 'datatable'])->name('datatable');
    });

    // Blog
    Route::resource('blog', BlogController::class)->except('destroy');
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::delete('destroy-blog/{id}', [BlogController::class, 'destroy'])->name('destroy');
        Route::post('set-show-blog/{id}', [BlogController::class, 'setShow'])->name('set-show');
        Route::get('dtable/blog', [BlogController::class, 'datatable'])->name('datatable');
    });

    // Tour
    Route::resource('tour', TourController::class)->except('destroy');
    Route::prefix('tour')->name('tour.')->group(function () {
        Route::delete('destroy-tour/{id}', [TourController::class, 'destroy'])->name('destroy');
        Route::post('set-show-tour/{id}', [TourController::class, 'setShow'])->name('set-show');
        Route::get('dtable/tour', [TourController::class, 'datatable'])->name('datatable');
    });

    // Tour Departure (custom karena nested ke Tour)
Route::prefix('tour-departure')->name('tour-departure.')->group(function () {

    Route::get(
        'datatable/{idTour}',
        [TourDepartureController::class, 'datatable']
    )->name('datatable');

    Route::get(
        '{idTour}',
        [TourDepartureController::class, 'index']
    )->name('index');

    Route::get(
        '{idTour}/create',
        [TourDepartureController::class, 'create']
    )->name('create');

    Route::post(
        'store',
        [TourDepartureController::class, 'store']
    )->name('store');

    Route::get(
        '{idTour}/edit/{idTourDeparture}',
        [TourDepartureController::class, 'edit']
    )->name('edit');

    Route::put(
        'update/{idTourDeparture}',
        [TourDepartureController::class, 'update']
    )->name('update');

    Route::delete(
        'destroy/{idTourDeparture}',
        [TourDepartureController::class, 'destroy']
    )->name('destroy');

});

    // User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('dtable/user/{role}', [UserController::class, 'datatable'])->name('datatable');
        Route::get('{role}', [UserController::class, 'index'])->name('index');
        Route::delete('{role}/{id}/destroy-user', [UserController::class, 'destroy'])->name('destroy');
        Route::post('{role}/{id}/set-status-user', [UserController::class, 'setStatus'])->name('set-status');
    
        // Routes that depend only on ID (create, store, edit, update, show) – avoid conflict with {role}
        Route::get('{role}/create', [UserController::class, 'create'])->name('create');
        Route::post('{role}', [UserController::class, 'store'])->name('store');
        Route::get('{role}/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{role}/{id}', [UserController::class, 'update'])->name('update');
        Route::get('{role}/{id}', [UserController::class, 'show'])->name('show');
    });

    // Theme
    Route::resource('theme', ThemeController::class)->except('destroy');
    Route::name('theme.')->group(function () {
        Route::get('dtable/theme', [ThemeController::class, 'datatable'])->name('datatable');
    });
});