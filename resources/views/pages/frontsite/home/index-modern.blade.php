@extends('layouts.frontsite')

@php
use Illuminate\Support\Str;
@endphp

@section('title', 'Opsi Liburan Indonesia | Best Travel & Tour Packages to Bromo, Ijen, Bali, Jogja & More')
@section('activeMenuHome', 'active')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content animate-fade-in-up">
                    <h1>Discover Indonesia, <span class="text-gradient">One Trip at a Time</span></h1>
                    <p>Book curated tours and travel experiences across Indonesia — simple, flexible, and hassle-free.</p>
                    <div class="hero-cta-group">
                        <a href="{{ route('frontsite.tours.index') }}" class="btn-hero-primary">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Explore Tours
                        </a>
                        <a href="{{ route('frontsite.custom-itinerary.index') }}" class="btn-hero-secondary">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Custom Itinerary
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-image animate-float">
                    <img src="/frontsite-assets/img/home2/banner-img1.jpg" alt="Travel Indonesia" style="border-radius: 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Tours Section -->
<section class="section-modern bg-white">
    <div class="container">
        <div class="section-title-modern">
            <h2>Popular Tour Packages</h2>
            <p>Discover our most loved destinations and experiences across Indonesia</p>
        </div>
        
        <div class="row g-4">
            @forelse($tours as $tour)
            <div class="col-lg-4 col-md-6">
                <div class="card-modern">
                    <div class="card-modern-image">
                        @if($tour->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $tour->photos->first()->photo) }}" alt="{{ $tour->name }}">
                        @else
                            <img src="/frontsite-assets/img/packages/package-1.jpg" alt="{{ $tour->name }}">
                        @endif
                        @if($tour->is_featured)
                            <span class="card-modern-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; margin-right: 4px;">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="currentColor"/>
                                </svg>
                                Featured
                            </span>
                        @endif
                    </div>
                    <div class="card-modern-content">
                        <h3 class="card-modern-title">
                            <a href="{{ route('frontsite.tours.show', $tour->slug) }}">{{ $tour->name }}</a>
                        </h3>
                        <p class="card-modern-text">{{ Str::limit($tour->description, 100) }}</p>
                        <div class="card-modern-meta">
                            <div class="card-modern-meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $tour->duration }}
                            </div>
                            @if($tour->destinations->isNotEmpty())
                            <div class="card-modern-meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ $tour->destinations->first()->destination->name }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-modern-footer">
                        <div class="card-modern-price">
                            @if($tour->prices->isNotEmpty())
                                ${{ number_format($tour->prices->first()->price_usd, 0) }}
                                <small>/person</small>
                            @else
                                <small>Contact for price</small>
                            @endif
                        </div>
                        <a href="{{ route('frontsite.tours.show', $tour->slug) }}" class="btn-modern btn-modern-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No tours available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        @if($tours->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('frontsite.tours.index') }}" class="btn-modern btn-modern-accent">
                View All Tours
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Destinations Section -->
<section class="section-modern" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container">
        <div class="section-title-modern">
            <h2>Top Destinations</h2>
            <p>Explore the most beautiful places in Indonesia</p>
        </div>
        
        <div class="row g-4">
            @forelse($destinations->take(6) as $destination)
            <div class="col-lg-4 col-md-6">
                <div class="card-modern">
                    <div class="card-modern-image">
                        @if($destination->image && file_exists(public_path('storage/' . $destination->image)))
                            <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}">
                        @else
                            <img src="/frontsite-assets/img/home2/destination-1.jpg" alt="{{ $destination->name }}">
                        @endif
                    </div>
                    <div class="card-modern-content">
                        <h3 class="card-modern-title">
                            <a href="{{ route('frontsite.destinations.show', $destination->id) }}">{{ $destination->name }}</a>
                        </h3>
                        <p class="card-modern-text">{{ Str::limit($destination->description, 100) }}</p>
                    </div>
                    <div class="card-modern-footer">
                        <span class="badge-modern badge-modern-primary">
                            {{ $destination->tours_count ?? 0 }} Tours Available
                        </span>
                        <a href="{{ route('frontsite.destinations.show', $destination->id) }}" class="btn-modern btn-modern-secondary">
                            Explore
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No destinations available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        @if($destinations->count() > 6)
        <div class="text-center mt-5">
            <a href="{{ route('frontsite.destinations.index') }}" class="btn-modern btn-modern-outline">
                View All Destinations
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Testimonials Section -->
<section class="section-modern bg-white">
    <div class="container">
        <div class="section-title-modern">
            <h2>What Travelers Say</h2>
            <p>Real experiences from our happy customers</p>
        </div>
        
        <div class="row g-4">
            @forelse($testimonials->take(3) as $testimony)
            <div class="col-lg-4 col-md-6">
                <div class="card-modern" style="border: 2px solid var(--neutral-200);">
                    <div class="card-modern-content">
                        <div class="mb-3">
                            @for($i = 1; $i <= 5; $i++)
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="var(--accent-orange)" xmlns="http://www.w3.org/2000/svg" style="display: inline-block;">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                            </svg>
                            @endfor
                        </div>
                        <h4 class="card-modern-title">{{ $testimony->title }}</h4>
                        <p class="card-modern-text">"{{ $testimony->description }}"</p>
                        <div class="d-flex align-items-center gap-3 mt-4">
                            <div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; flex-shrink: 0;">
                                @if($testimony->image && file_exists(public_path('storage/' . $testimony->image)))
                                    <img src="{{ asset('storage/' . $testimony->image) }}" alt="{{ $testimony->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="/frontsite-assets/img/home1/testimonial-author-img{{ ($loop->index % 5) + 1 }}.png" alt="{{ $testimony->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <div>
                                <h6 style="margin: 0; font-weight: 700; color: var(--neutral-900);">{{ $testimony->name }}</h6>
                                <p style="margin: 0; font-size: 0.875rem; color: var(--neutral-500);">{{ $testimony->position ?? 'Traveler' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No testimonials available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        @if($testimonials->count() > 3)
        <div class="text-center mt-5">
            <a href="{{ route('frontsite.testimonies.index') }}" class="btn-modern btn-modern-outline">
                Read More Reviews
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Blog/News Section -->
<section class="section-modern" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
    <div class="container">
        <div class="section-title-modern">
            <h2>Travel Inspiration</h2>
            <p>Latest travel tips, guides, and stories from Indonesia</p>
        </div>
        
        <div class="row g-4">
            @forelse($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="card-modern">
                    <div class="card-modern-image">
                        @if($blog->image && file_exists(public_path('storage/' . $blog->image)))
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                        @else
                            <img src="/frontsite-assets/img/innerpages/blog-1.jpg" alt="{{ $blog->title }}">
                        @endif
                        <span class="card-modern-badge">{{ $blog->type ?? 'Travel' }}</span>
                    </div>
                    <div class="card-modern-content">
                        <h3 class="card-modern-title">
                            <a href="{{ route('frontsite.news.show', $blog->id) }}">{{ Str::limit($blog->title, 60) }}</a>
                        </h3>
                        <p class="card-modern-text">{{ Str::limit($blog->description, 100) }}</p>
                        <div class="card-modern-meta">
                            <div class="card-modern-meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 4H5C3.89543 4 3 4.89543 3 6V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V6C21 4.89543 20.1046 4 19 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3 10H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($blog->date)->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-modern-footer">
                        <a href="{{ route('frontsite.news.show', $blog->id) }}" class="btn-modern btn-modern-primary" style="width: 100%;">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No blog posts available at the moment.</p>
            </div>
            @endforelse
        </div>
        
        @if($blogs->count() > 0)
        <div class="text-center mt-5">
            <a href="{{ route('frontsite.news.index') }}" class="btn-modern btn-modern-accent">
                View All Inspiration
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Partners Section -->
@if($partners->count() > 0)
<section class="section-modern bg-white">
    <div class="container">
        <div class="section-title-modern">
            <h2>Our Trusted Partners</h2>
            <p>Working with the best in the industry</p>
        </div>
        
        <div class="row g-4 align-items-center justify-content-center">
            @foreach($partners as $partner)
            <div class="col-lg-2 col-md-3 col-4 text-center">
                <div style="padding: 1.5rem; background: white; border-radius: var(--radius-lg); border: 1px solid var(--neutral-200); transition: all var(--transition-base);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    @if($partner->link)
                        <a href="{{ $partner->link }}" target="_blank" rel="noopener">
                    @endif
                        @if($partner->image && file_exists(public_path('storage/' . $partner->image)))
                            <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}" style="max-width: 100%; height: auto; filter: grayscale(100%); opacity: 0.7; transition: all var(--transition-base);" onmouseover="this.style.filter='grayscale(0)'; this.style.opacity='1'" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7'">
                        @else
                            <img src="/frontsite-assets/img/partners/wonderful-indonesia.png" alt="{{ $partner->name }}" style="max-width: 100%; height: auto; filter: grayscale(100%); opacity: 0.7; transition: all var(--transition-base);" onmouseover="this.style.filter='grayscale(0)'; this.style.opacity='1'" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7'">
                        @endif
                    @if($partner->link)
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="section-modern" style="background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start">
                <h2 style="color: white; font-size: clamp(1.75rem, 3vw, 2.5rem); margin-bottom: 1rem;">Ready to Start Your Adventure?</h2>
                <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.1rem; margin-bottom: 0;">Book your dream tour today or create a custom itinerary tailored just for you.</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('frontsite.contact.index') }}" class="btn-hero-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.5953 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5864 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Contact Us Now
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
