@extends('layouts.frontsite')

@section('activeMenuTours', 'active')

@section('title', 'Tour Packages - Travel Indonesia')

@section('meta_description', 'Discover amazing tour packages across Indonesia. Find the perfect travel experience with our curated selection of tours.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Tour Packages</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Tour Packages</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section pt-60 pb-30" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-wrapper">
                    <div class="filter-content">
                        <h5>Filter Tours</h5>
                        <div class="filter-options">
                            <div class="filter-item">
                                <select class="form-select" id="destinationFilter">
                                    <option value="">All Destinations</option>
                                    <option value="bromo">Mount Bromo</option>
                                    <option value="ijen">Ijen Crater</option>
                                    <option value="tumpak-sewu">Tumpak Sewu</option>
                                    <option value="malang">Malang City</option>
                                </select>
                            </div>
                            <div class="filter-item">
                                <select class="form-select" id="durationFilter">
                                    <option value="">Duration</option>
                                    <option value="1">1 Day</option>
                                    <option value="2">2 Days</option>
                                    <option value="3">3 Days</option>
                                    <option value="4">4+ Days</option>
                                </select>
                            </div>
                            <div class="filter-item">
                                <select class="form-select" id="priceFilter">
                                    <option value="">Price Range</option>
                                    <option value="0-500000">Under $50</option>
                                    <option value="500000-1000000">$50 - $100</option>
                                    <option value="1000000-2000000">$100 - $200</option>
                                    <option value="2000000+">Above $200</option>
                                </select>
                            </div>
                            <div class="filter-item">
                                <button class="btn btn-primary" id="applyFilter">
                                    <i class="bi bi-funnel"></i>
                                    Apply Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tours Section -->
<div class="package-section pt-60 pb-120">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <span class="section-subtitle">Explore Indonesia</span>
                    <h2>Our Amazing Tour Packages</h2>
                    <p>Discover the beauty of Indonesia with our carefully curated tour packages</p>
                </div>
            </div>
        </div>
        
        <!-- Results Info -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="results-info">
                    <p>Showing {{ $tours->count() }} of {{ $tours->total() }} tours</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sort-options text-end">
                    <select class="form-select d-inline-block w-auto" id="sortBy">
                        <option value="newest">Newest First</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row g-4" id="toursContainer">
            @forelse($tours as $tour)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="modern-package-card">
                    <div class="package-image">
                        @if($tour->tour_photos->count() > 0 && $tour->tour_photos->first()->image)
                        <img src="{{ asset('storage/' . $tour->tour_photos->first()->image) }}" alt="{{ $tour->title }}" onerror="this.src='{{ asset('frontsite-assets/img/packages/1.jpg') }}'">
                        @else
                        <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $tour->title }}">
                        @endif
                        
                        <!-- Most Loved Badge -->
                        @if($tour->is_best)
                        <div class="package-badge">
                            <span class="badge-text">Most Loved</span>
                        </div>
                        @endif
                        
                        <!-- Wishlist Button -->
                        <div class="wishlist-btn">
                            <button class="btn-wishlist" data-tour-id="{{ $tour->id }}">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        
                        <!-- Image Overlay -->
                        <div class="image-overlay">
                            <a href="{{ route('frontsite.tours.show', $tour->slug) }}" class="view-details-btn">
                                <i class="bi bi-eye"></i>
                                View Details
                            </a>
                        </div>
                    </div>
                    
                    <div class="package-content">
                        <div class="package-header">
                            <div class="package-meta">
                                <span class="departure-city">
                                    <i class="bi bi-geo-alt"></i>
                                    @if($tour->tour_departures->count() > 0)
                                    from {{ $tour->tour_departures->first()->departure->title }}
                                    @else
                                    from Multiple Cities
                                    @endif
                                </span>
                                <span class="duration">
                                    <i class="bi bi-clock"></i>
                                    @php
                                        // Extract duration from title or set default
                                        preg_match('/(\d+)\s*day/i', $tour->title, $matches);
                                        $days = isset($matches[1]) ? $matches[1] : '3';
                                        $nights = $days > 1 ? ($days - 1) : 0;
                                    @endphp
                                    {{ $days }} Days {{ $nights > 0 ? $nights . ' Nights' : '' }}
                                </span>
                            </div>
                        </div>
                        
                        <h5 class="package-title">
                            <a href="{{ route('frontsite.tours.show', $tour->slug) }}">{{ $tour->title }}</a>
                        </h5>
                        
                        <p class="package-description">{{ Str::limit(strip_tags($tour->description), 100) }}</p>
                        
                        <!-- Tour Features -->
                        <div class="tour-features">
                            <div class="feature-item">
                                <i class="bi bi-person-check"></i>
                                <span>Private Tour</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle"></i>
                                <span>All Inclusive</span>
                            </div>
                        </div>
                        
                        <!-- Price and Booking -->
                        <div class="package-footer">
                            <div class="price-section">
                                <span class="price-label">Per Person</span>
                                <div class="price">
                                    @if($tour->price > 0)
                                    ${{ number_format($tour->price / 15000, 0) }}
                                    @else
                                    <span class="contact-price">Contact for Price</span>
                                    @endif
                                </div>
                            </div>
                            <div class="booking-section">
                                <a href="{{ route('frontsite.tours.show', $tour->slug) }}" class="btn btn-primary book-now-btn">
                                    <i class="bi bi-arrow-right"></i>
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="no-tours-found">
                    <div class="no-tours-content">
                        <i class="bi bi-search"></i>
                        <h4>No tour packages found</h4>
                        <p>Try adjusting your filters or check back later for more amazing tour packages.</p>
                        <a href="{{ route('frontsite.tours.index') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise"></i>
                            Reset Filters
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($tours->hasPages())
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="pagination-wrapper">
                    {{ $tours->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Newsletter Section -->
<div class="newsletter-section pt-80 pb-80" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="newsletter-content">
                    <h3>Get Special Offers & Updates</h3>
                    <p>Subscribe to our newsletter and be the first to know about new tours and exclusive deals!</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newsletter-form">
                    <form class="subscription-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email address" required>
                            <button class="btn btn-light" type="submit">
                                <i class="bi bi-send"></i>
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
/* Section Subtitle */
.section-subtitle {
    color: #007bff;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    display: block;
}

/* Filter Section */
.filter-section {
    border-bottom: 1px solid #e9ecef;
}

.filter-wrapper {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.filter-content h5 {
    margin-bottom: 20px;
    color: #333;
    font-weight: 600;
}

.filter-options {
    display: flex;
    gap: 20px;
    align-items: center;
    flex-wrap: wrap;
}

.filter-item {
    flex: 1;
    min-width: 200px;
}

.filter-item .form-select {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
}

.filter-item .btn {
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
}

/* Results and Sort */
.results-info p {
    color: #666;
    margin: 0;
    font-size: 14px;
}

.sort-options .form-select {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 8px 15px;
    font-size: 14px;
}

/* Modern Package Card */
.modern-package-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.modern-package-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* Package Image */
.package-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.package-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.modern-package-card:hover .package-image img {
    transform: scale(1.1);
}

/* Package Badge */
.package-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 2;
}

.badge-text {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: #fff;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Wishlist Button */
.wishlist-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 2;
}

.btn-wishlist {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.9);
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-wishlist:hover {
    background: #ff6b6b;
    color: #fff;
    transform: scale(1.1);
}

/* Image Overlay */
.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modern-package-card:hover .image-overlay {
    opacity: 1;
}

.view-details-btn {
    background: #fff;
    color: #333;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.view-details-btn:hover {
    background: #007bff;
    color: #fff;
    transform: translateY(-2px);
}

/* Package Content */
.package-content {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.package-header {
    margin-bottom: 15px;
}

.package-meta {
    display: flex;
    gap: 15px;
    margin-bottom: 10px;
}

.package-meta span {
    font-size: 13px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 5px;
}

.package-meta i {
    color: #007bff;
}

.package-title {
    margin-bottom: 15px;
    font-size: 1.2rem;
    font-weight: 700;
    line-height: 1.3;
}

.package-title a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.package-title a:hover {
    color: #007bff;
}

.package-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}

/* Tour Features */
.tour-features {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    padding: 15px 0;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #666;
}

.feature-item i {
    color: #28a745;
    font-size: 14px;
}

/* Package Footer */
.package-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.price-section {
    text-align: left;
}

.price-label {
    font-size: 12px;
    color: #666;
    display: block;
    margin-bottom: 5px;
}

.price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #007bff;
}

.contact-price {
    font-size: 14px;
    color: #666;
    font-weight: 500;
}

.book-now-btn {
    padding: 12px 20px;
    border-radius: 25px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.book-now-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

/* No Tours Found */
.no-tours-found {
    text-align: center;
    padding: 80px 20px;
}

.no-tours-content i {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.no-tours-content h4 {
    color: #333;
    margin-bottom: 15px;
}

.no-tours-content p {
    color: #666;
    margin-bottom: 25px;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

/* Newsletter Section */
.newsletter-section {
    color: #fff;
}

.newsletter-content h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.newsletter-content p {
    opacity: 0.9;
    margin: 0;
}

.subscription-form .input-group {
    max-width: 400px;
    margin-left: auto;
}

.subscription-form .form-control {
    border: none;
    padding: 15px 20px;
    border-radius: 25px 0 0 25px;
    font-size: 14px;
}

.subscription-form .btn {
    border-radius: 0 25px 25px 0;
    padding: 15px 25px;
    font-weight: 600;
    border: none;
}

/* Responsive */
@media (max-width: 768px) {
    .filter-options {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-item {
        min-width: auto;
    }
    
    .package-footer {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .book-now-btn {
        justify-content: center;
    }
    
    .newsletter-section .row {
        text-align: center;
    }
    
    .newsletter-form {
        margin-top: 30px;
    }
    
    .subscription-form .input-group {
        margin: 0 auto;
    }
}

@media (max-width: 576px) {
    .package-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .tour-features {
        flex-direction: column;
        gap: 10px;
    }
}
</style>
@endpush

@push('after-script')
<script>
$(document).ready(function() {
    // Wishlist functionality
    $('.btn-wishlist').on('click', function(e) {
        e.preventDefault();
        const $this = $(this);
        const tourId = $this.data('tour-id');
        
        // Toggle wishlist state
        $this.toggleClass('active');
        
        if ($this.hasClass('active')) {
            $this.find('i').removeClass('bi-heart').addClass('bi-heart-fill');
            $this.css('background', '#ff6b6b');
            $this.css('color', '#fff');
        } else {
            $this.find('i').removeClass('bi-heart-fill').addClass('bi-heart');
            $this.css('background', 'rgba(255,255,255,0.9)');
            $this.css('color', '#666');
        }
        
        // Here you can add AJAX call to save wishlist to backend
        console.log('Wishlist toggled for tour:', tourId);
    });
    
    // Filter functionality
    $('#applyFilter').on('click', function() {
        // Get filter values
        const destination = $('#destinationFilter').val();
        const duration = $('#durationFilter').val();
        const price = $('#priceFilter').val();
        
        // Here you can add AJAX call to filter tours
        console.log('Filters applied:', { destination, duration, price });
        
        // Show loading state
        $('#toursContainer').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>');
        
        // Simulate API call (replace with actual AJAX)
        setTimeout(() => {
            // Reload page with filters (in real implementation, use AJAX)
            window.location.reload();
        }, 1000);
    });
    
    // Sort functionality
    $('#sortBy').on('change', function() {
        const sortValue = $(this).val();
        console.log('Sort by:', sortValue);
        
        // Here you can add AJAX call to sort tours
        // For now, just reload the page
        window.location.reload();
    });
    
    // Newsletter subscription
    $('.subscription-form').on('submit', function(e) {
        e.preventDefault();
        const email = $(this).find('input[type="email"]').val();
        
        if (email) {
            // Show success message
            alert('Thank you for subscribing! We\'ll keep you updated with our latest tours and offers.');
            $(this).find('input[type="email"]').val('');
        }
    });
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $($(this).attr('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });
});
</script>
@endpush