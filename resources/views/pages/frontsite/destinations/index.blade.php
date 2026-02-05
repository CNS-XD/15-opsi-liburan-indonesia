@extends('layouts.frontsite')

@section('activeMenuDestinations', 'active')

@section('title', 'Destinations - Travel Indonesia')

@section('meta_description', 'Explore amazing destinations in Indonesia. Find the perfect place for your next adventure.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Destinations</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Destinations</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Destinations Section -->
<div class="destination-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head">
                    <h2>Popular Destinations</h2>
                    <p>Discover amazing places around Indonesia</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @forelse($destinations as $destination)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="destination-card destination-card-custom">
                    <div class="destination-img">
                        @if($destination->image)
                        <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}">
                        @else
                        <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $destination->title }}">
                        @endif
                        <div class="destination-overlay">
                            <a href="{{ route('frontsite.destinations.show', $destination->id) }}" class="destination-btn">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="destination-content">
                        <h5><a href="{{ route('frontsite.destinations.show', $destination->id) }}">{{ $destination->title }}</a></h5>
                        <p>{{ Str::limit($destination->description, 80) }}</p>
                        <div class="destination-info">
                            <span class="tour-count">{{ $destination->tours_count }} Tours</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h4>No destinations found</h4>
                    <p>Please check back later for more destinations.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($destinations->hasPages())
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-area">
                    {{ $destinations->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('after-style')
<style>
.destination-card-custom {
    height: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    background: white;
    margin-bottom: 30px;
}

.destination-card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.destination-card-custom .destination-img {
    height: 280px;
    overflow: hidden;
    border-radius: 10px 10px 0 0;
    position: relative;
}

.destination-card-custom .destination-img img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.destination-card-custom:hover .destination-img img {
    transform: scale(1.05);
}

.destination-card-custom .destination-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    background: white;
    border-radius: 0 0 10px 10px;
}

.destination-card-custom .destination-content h5 {
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.destination-card-custom .destination-content h5 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.destination-card-custom .destination-content h5 a:hover {
    color: #007bff;
}

.destination-card-custom .destination-content p {
    flex-grow: 1;
    margin-bottom: 15px;
    color: #666;
    line-height: 1.5;
    font-size: 14px;
}

.destination-card-custom .destination-info {
    margin-top: auto;
}

.destination-card-custom .tour-count {
    background: linear-gradient(45deg, #007bff, #0056b3);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
}

.destination-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.destination-card-custom:hover .destination-overlay {
    opacity: 1;
}

.destination-btn {
    background: #007bff;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 18px;
}

.destination-btn:hover {
    background: #0056b3;
    transform: scale(1.1);
    color: white;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .destination-card-custom .destination-img {
        height: 250px;
    }
    
    .destination-card-custom .destination-img img {
        height: 250px;
    }
}

@media (max-width: 768px) {
    .destination-card-custom .destination-img {
        height: 220px;
    }
    
    .destination-card-custom .destination-img img {
        height: 220px;
    }
    
    .destination-card-custom .destination-content {
        padding: 15px;
    }
    
    .destination-card-custom .destination-content h5 {
        font-size: 16px;
    }
}
</style>
@endpush