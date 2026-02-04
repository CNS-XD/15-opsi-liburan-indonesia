@extends('layouts.frontsite')

@section('title', 'How to Book - Guide Book | Opsi Liburan Indonesia')
@section('meta_description', 'Learn how to book your perfect tour package with Opsi Liburan Indonesia. Simple step-by-step guide to make your booking process easy and secure.')
@section('activeMenuGuideBook', 'active')

@section('content')
<div class="main-guide-book">
    <div class="guide-book">
        <!-- Start Breadcrumb section -->
        <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/frontsite-assets/img/innerpages/breadcrumb-bg1.jpg);">  
            <div class="container">
                <div class="banner-content">
                    <h3 class="text-white">A quick guide to booking your next adventure in just a few simple steps.</h3>
                    <ul class="breadcrumb-list">
                        <li>Plan</li>
                        <li>Book</li>
                        <li>Enjoy!</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb section -->

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