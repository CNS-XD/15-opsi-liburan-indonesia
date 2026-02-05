@extends('layouts.frontsite')

@section('title', 'Photo Gallery - Travel Indonesia')

@section('meta_description', 'Explore our photo gallery showcasing beautiful destinations and memorable moments from our tour packages across Indonesia.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Photo Gallery</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Section -->
<div class="gallery-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <h2>Photo Gallery</h2>
                    <p>Discover the beauty of Indonesia through our collection of stunning photographs</p>
                </div>
            </div>
        </div>
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
                <div class="text-center py-5">
                    <h4>No photos found</h4>
                    <p>Please check back later for more amazing photos from our tours.</p>
                    <a href="{{ route('frontsite.tours.index') }}" class="btn btn-primary">Browse Tours</a>
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
                <div class="gallery-cta text-center">
                    <h4>Ready to Create Your Own Memories?</h4>
                    <p>Join us on an unforgettable journey and capture your own amazing moments!</p>
                    <a href="{{ route('frontsite.tours.index') }}" class="btn btn-primary">Browse Tour Packages</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
.gallery-item {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
}

.gallery-img {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4/3;
}

.gallery-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-img img {
    transform: scale(1.1);
}

.gallery-overlay {
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

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-content {
    display: flex;
    gap: 15px;
}

.gallery-btn, .tour-link {
    width: 50px;
    height: 50px;
    background-color: #007bff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.gallery-btn:hover, .tour-link:hover {
    background-color: #0056b3;
    color: #fff;
}

.gallery-info {
    padding: 20px;
}

.gallery-info h6 {
    margin: 0 0 8px 0;
    font-weight: 600;
}

.gallery-info h6 a {
    color: #333;
    text-decoration: none;
}

.gallery-info h6 a:hover {
    color: #007bff;
}

.gallery-category {
    color: #666;
    font-size: 14px;
}

.gallery-cta {
    background-color: #f8f9fa;
    padding: 50px 30px;
    border-radius: 10px;
}

.gallery-cta h4 {
    margin-bottom: 15px;
    color: #333;
}

.gallery-cta p {
    margin-bottom: 25px;
    color: #666;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 5px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gallery-content {
        gap: 10px;
    }
    
    .gallery-btn, .tour-link {
        width: 40px;
        height: 40px;
    }
    
    .gallery-info {
        padding: 15px;
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