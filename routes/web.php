<?php

use App\Http\Controllers\Frontsite\AboutUsController;
use App\Http\Controllers\Frontsite\HomeController;
use App\Http\Controllers\Frontsite\FaqController;
use App\Http\Controllers\Frontsite\TourController;
use App\Http\Controllers\Frontsite\BookingController;
use App\Http\Controllers\Frontsite\PaymentController;
use App\Http\Controllers\Frontsite\ReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontsite\ContactController;
use App\Http\Controllers\Frontsite\NewsController;
use App\Http\Controllers\Frontsite\GuideBookController;
use App\Http\Controllers\Frontsite\SearchController;
use App\Http\Controllers\Frontsite\CustomItineraryController;
use Illuminate\Support\Facades\Route;

// Xendit Webhook (outside middleware)
Route::post('webhook/xendit/invoice', [PaymentController::class, 'webhook'])->name('webhook.xendit.invoice');

// Auth::routes();
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('sinkronisasi/{regCode}/{compCode}', [LoginController::class, 'storeSinkron'])->name('login.store-sinkron');

Route::name('frontsite.')->middleware('pbh')->group(function () {
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
    // Search
    Route::get('search', [SearchController::class, 'index'])->name('search');
    Route::get('search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
    
    // Custom Itinerary
    Route::get('custom-itinerary', [CustomItineraryController::class, 'index'])->name('custom-itinerary.index');
    Route::post('custom-itinerary', [CustomItineraryController::class, 'store'])->name('custom-itinerary.store');
    Route::get('custom-itinerary/success/{id}', [CustomItineraryController::class, 'success'])->name('custom-itinerary.success');
    Route::get('custom-itinerary/{id}', [CustomItineraryController::class, 'show'])->name('custom-itinerary.show');
    
    // Tours
    Route::get('tours', [TourController::class, 'index'])->name('tours.index');
    Route::get('tours/{slug}', [TourController::class, 'show'])->name('tours.show');
    Route::get('tours/{slug}/reviews', [ReviewController::class, 'index'])->name('tours.reviews');
    
    // Booking
    Route::post('booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('booking/success/{bookingCode}', [BookingController::class, 'success'])->name('booking.success');
    Route::get('booking/{bookingCode}', [BookingController::class, 'show'])->name('booking.show');
    
    // Payment
    Route::get('payment/{bookingCode}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('payment/{bookingCode}', [PaymentController::class, 'create'])->name('payment.create');
    Route::get('payment/status/{paymentCode}', [PaymentController::class, 'status'])->name('payment.status');
    Route::get('payment/success/{paymentCode}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('payment/failed/{paymentCode}', [PaymentController::class, 'failed'])->name('payment.failed');
    Route::post('payment/cancel/{paymentCode}', [PaymentController::class, 'cancel'])->name('payment.cancel');
    Route::get('payment/check-status/{paymentCode}', [PaymentController::class, 'checkStatus'])->name('payment.check-status');
    
    // Reviews
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    
    // Guide Book
    Route::get('guide-book', [GuideBookController::class, 'index'])->name('guide-book.index');
    
    // About Us
    Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    // Contact Us
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    // FAQ
    Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
    // News
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
});