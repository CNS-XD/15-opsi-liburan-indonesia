@extends('layouts.frontsite')

@section('title', 'Photo Gallery - Travel Indonesia')

@section('meta_description', 'Explore our photo gallery showcasing beautiful destinations and memorable moments from our tour packages across Indonesia.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-images" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Photo Gallery</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Discover the beauty of Indonesia through our collection of stunning photographs</center>
                    </p>
                    <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
                        <div style="text-align: center;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: white;">{{ $photos->total() }}+</div>
                            <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem;">Photos</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: white;">
                                <i class="bi bi-camera" style="font-size: 2rem;"></i>
                            </div>
                            <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem;">Destinations</div>
                        </div>
                    </div>
                    <div style="margin-top: 2rem;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center" style="background: transparent; margin: 0; padding: 0;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('frontsite.home.index') }}" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="bi bi-house-door"></i> Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" style="color: white; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="bi bi-images"></i> Gallery
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<div class="gallery-section" style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row g-4">
            @forelse($photos as $photo)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="gallery-item">
                    <div class="gallery-img">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->tour->title ?? 'Gallery Image' }}">
                        <div class="gallery-overlay">
                            <div class="gallery-content">
                                <a href="{{ asset('storage/' . $photo->image) }}" class="gallery-btn" data-fancybox="gallery" data-caption="{{ $photo->tour->title ?? 'Gallery Image' }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                @if($photo->tour)
                                <a href="{{ route('frontsite.tours.show', $photo->tour->slug) }}" class="tour-link">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($photo->tour)
                    <div class="gallery-info">
                        <h6><a href="{{ route('frontsite.tours.show', $photo->tour->slug) }}">{{ Str::limit($photo->tour->title, 40) }}</a></h6>
                        <span class="gallery-category">
                            @if($photo->tour->tour_destinations->count() > 0)
                            {{ $photo->tour->tour_destinations->first()->destination->title }}
                            @endif
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5" style="background: white; padding: 4rem 2rem !important; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);">
                    <div style="width: 120px; height: 120px; margin: 0 auto 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-images" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <h4 style="color: #1e293b; font-weight: 700; margin-bottom: 1rem;">No photos found</h4>
                    <p style="color: #64748b; margin-bottom: 2rem;">Please check back later for more amazing photos from our tours.</p>
                    <a href="{{ route('frontsite.tours.index') }}" class="btn-modern btn-modern-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 2rem; text-decoration: none; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50px; font-weight: 600;">
                        <i class="bi bi-compass"></i> Browse Tours
                    </a>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($photos->hasPages())
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-area">
                    {{ $photos->links() }}
                </div>
            </div>
        </div>
        @endif
        
        <!-- CTA Section -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="gallery-cta text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 4rem 2rem; border-radius: 1.5rem; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);">
                    <div style="max-width: 600px; margin: 0 auto;">
                        <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera-fill" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 style="color: white; font-weight: 700; margin-bottom: 1rem; font-size: 1.8rem;">Ready to Create Your Own Memories?</h4>
                        <p style="color: rgba(255, 255, 255, 0.95); margin-bottom: 2rem; font-size: 1.1rem;">Join us on an unforgettable journey and capture your own amazing moments!</p>
                        <a href="{{ route('frontsite.tours.index') }}" class="btn-modern" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 2.5rem; text-decoration: none; background: white; color: #667eea; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">
                            <i class="bi bi-compass"></i> Browse Tour Packages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
/* Hero Section Animation */
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Breadcrumb Styling */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.2rem;
    padding: 0 0.5rem;
}

.breadcrumb-item a:hover {
    color: white !important;
    text-decoration: underline;
}

/* Gallery Items */
.gallery-item {
    position: relative;
    border-radius: 1rem;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    animation: fadeIn 0.5s ease-out;
}

.gallery-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.gallery-img {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
    background: #f1f5f9;
}

.gallery-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.gallery-item:hover .gallery-img img {
    transform: scale(1.15);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-content {
    display: flex;
    gap: 15px;
}

.gallery-btn, .tour-link {
    width: 55px;
    height: 55px;
    background-color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #667eea;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.gallery-btn:hover, .tour-link:hover {
    background-color: #667eea;
    color: white;
    transform: scale(1.1);
}

.gallery-btn i, .tour-link i {
    font-size: 1.3rem;
}

.gallery-info {
    padding: 1.25rem;
    background: white;
}

.gallery-info h6 {
    margin: 0 0 0.5rem 0;
    font-weight: 700;
    font-size: 1rem;
    line-height: 1.4;
}

.gallery-info h6 a {
    color: #1e293b;
    text-decoration: none;
    transition: color 0.3s ease;
}

.gallery-info h6 a:hover {
    color: #667eea;
}

.gallery-category {
    color: #64748b;
    font-size: 0.875rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.gallery-category::before {
    content: '📍';
    font-size: 0.875rem;
}

/* CTA Section */
.gallery-cta .btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    background: #f8fafc;
}

/* Pagination */
.pagination-area {
    text-align: center;
    margin-top: 3rem;
}

.pagination-area .pagination {
    justify-content: center;
    gap: 0.5rem;
}

.pagination-area .page-link {
    border-radius: 0.5rem;
    border: 2px solid #e2e8f0;
    color: #667eea;
    font-weight: 600;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.pagination-area .page-link:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}

.pagination-area .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Stagger animation for gallery items */
.gallery-item:nth-child(1) { animation-delay: 0.05s; }
.gallery-item:nth-child(2) { animation-delay: 0.1s; }
.gallery-item:nth-child(3) { animation-delay: 0.15s; }
.gallery-item:nth-child(4) { animation-delay: 0.2s; }
.gallery-item:nth-child(5) { animation-delay: 0.25s; }
.gallery-item:nth-child(6) { animation-delay: 0.3s; }
.gallery-item:nth-child(7) { animation-delay: 0.35s; }
.gallery-item:nth-child(8) { animation-delay: 0.4s; }
.gallery-item:nth-child(9) { animation-delay: 0.45s; }
.gallery-item:nth-child(10) { animation-delay: 0.5s; }
.gallery-item:nth-child(11) { animation-delay: 0.55s; }
.gallery-item:nth-child(12) { animation-delay: 0.6s; }

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-section {
        min-height: 40vh !important;
    }
    
    .hero-content > div:nth-child(3) {
        flex-direction: column !important;
        gap: 1rem !important;
    }
    
    .gallery-content {
        gap: 10px;
    }
    
    .gallery-btn, .tour-link {
        width: 45px;
        height: 45px;
    }
    
    .gallery-btn i, .tour-link i {
        font-size: 1.1rem;
    }
    
    .gallery-info {
        padding: 1rem;
    }
    
    .gallery-info h6 {
        font-size: 0.9rem;
    }
    
    .gallery-cta {
        padding: 3rem 1.5rem !important;
    }
    
    .gallery-cta h4 {
        font-size: 1.5rem !important;
    }
}
</style>
@endpush

@push('after-script')
<script>
$(document).ready(function() {
    // Initialize FancyBox for gallery
    $('[data-fancybox="gallery"]').fancybox({
        buttons: [
            "zoom",
            "slideShow",
            "fullScreen",
            "download",
            "thumbs",
            "close"
        ],
        loop: true,
        protect: true
    });
});
</script>
@endpush