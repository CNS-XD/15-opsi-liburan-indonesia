@extends('layouts.frontsite')

@section('title', 'How to Book - Guide Book | Opsi Liburan Indonesia')
@section('meta_description', 'Learn how to book your perfect tour package with Opsi Liburan Indonesia. Simple step-by-step guide to make your booking process easy and secure.')
@section('activeMenuGuideBook', 'active')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 60vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-book" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">How to Book Your Adventure</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>A quick guide to booking your next adventure in just a few simple steps</center>
                    </p>
                    <div style="margin-top: 2rem;">
                        <ul class="breadcrumb-list" style="display: flex; justify-content: center; gap: 2rem; list-style: none; padding: 0; margin: 0; flex-wrap: wrap;">
                            <li style="color: rgba(255, 255, 255, 0.95); font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-search" style="font-size: 1.2rem;"></i> Plan
                            </li>
                            <li style="color: rgba(255, 255, 255, 0.95); font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-calendar-check" style="font-size: 1.2rem;"></i> Book
                            </li>
                            <li style="color: rgba(255, 255, 255, 0.95); font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="bi bi-emoji-smile" style="font-size: 1.2rem;"></i> Enjoy!
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-guide-book">
    <div class="guide-book">
        <div class="body">
            <div class="container">
                <div class="items">
                    <div class="item">
                        <div class="row">
                            <div class="col-12">
                                <div class="guide-step">
                                    <div class="title">Step 1.</div>
                                    <div class="description">
                                        <h4>Browse & Filter Tours</h4>
                                        Explore our homepage and use the filter section to find your perfect adventure. 
                                        Choose your departure city, trip duration, and destination to narrow down tour 
                                        packages that match your travel dreams.
                                    </div>
                                    <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="guide-image">
                                    <div class="guide-border">
                                        <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                    </div>
                                    <div class="image-step">
                                        <img class="shadow" src="/frontsite-assets/img/guide/step-1-mobile.svg" alt="Step 1. Image" title="Step 1. Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-12">
                                <div class="guide-step">
                                    <div class="title">Step 2.</div>
                                    <div class="description">
                                        <h4>Review Tour Details</h4>
                                        Take your time to review the complete itinerary, inclusions, exclusions, and important details. 
                                        Make sure this tour package is exactly what you\'re looking for before proceeding to book.
                                    </div>
                                    <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="guide-image">
                                    <div class="guide-border">
                                        <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                    </div>
                                    <div class="image-step">
                                        <img class="shadow" src="/frontsite-assets/img/guide/step-2-mobile.svg" alt="Step 2. Image" title="Step 2. Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-12">
                                <div class="guide-step">
                                    <div class="title">Step 3.</div>
                                    <div class="description">
                                        <h4>Fill Booking Form</h4>
                                        Complete the booking form with accurate personal information, travel dates, and special requests. 
                                        Double-check all details to ensure a smooth reservation process.
                                    </div>
                                    <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="guide-image">
                                    <div class="guide-border">
                                        <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                    </div>
                                    <div class="image-step">
                                        <img class="shadow" src="/frontsite-assets/img/guide/step-3-mobile.svg" alt="Step 3. Image" title="Step 3. Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-12">
                                <div class="guide-step">
                                    <div class="title">Step 4.</div>
                                    <div class="description">
                                        <h4>Choose Payment Method</h4>
                                        Select your preferred payment method from various secure options including Virtual Account, E-Wallet, QR Code, or Credit Card. 
                                        All payments are processed securely through Xendit.
                                    </div>
                                    <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="guide-image">
                                    <div class="guide-border">
                                        <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                    </div>
                                    <div class="image-step">
                                        <img class="shadow" src="/frontsite-assets/img/guide/step-4-mobile.svg" alt="Step 4. Image" title="Step 4. Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-12">
                                <div class="guide-step">
                                    <div class="title">Step 5. </div>
                                    <div class="description">
                                        <h4>Confirmation & Enjoy</h4>
                                        Once payment is completed, you\'ll receive a confirmation email with all booking details.
                                        Our team will contact you for final arrangements. Get ready for your amazing adventure!
                                    </div>
                                    <img src="/frontsite-assets/img/icon/aeroplane.png" alt="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="guide-image">
                                    <div class="guide-border guide-border-last"></div>
                                    <div class="image-step">
                                        <img class="shadow" src="/frontsite-assets/img/guide/step-5-mobile.svg" alt="Step 5. Image" title="Step 5. Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <a class="guide-button" href="">Start Your Journey</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection