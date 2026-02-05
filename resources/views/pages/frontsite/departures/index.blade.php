@extends('layouts.frontsite')

@section('activeMenuDepartures', 'active')

@section('title', 'Departure Cities - Travel Indonesia')

@section('meta_description', 'Choose your departure city for tours across Indonesia. Find tours starting from your preferred location.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Departure Cities</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Departure Cities</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Departures Section -->
<div class="destination-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head">
                    <h2>Choose Your Departure City</h2>
                    <p>Find tours starting from your preferred location</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @forelse($departures as $departure)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="destination-card departure-card">
                    <div class="destination-img">
                        @if($departure->image)
                        <img src="{{ asset('storage/' . $departure->image) }}" alt="{{ $departure->title }}">
                        @else
                        <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $departure->title }}">
                        @endif
                        <div class="destination-overlay">
                            <a href="{{ route('frontsite.departures.show', $departure->id) }}" class="destination-btn">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="destination-content">
                        <h5><a href="{{ route('frontsite.departures.show', $departure->id) }}">{{ $departure->title }}</a></h5>
                        <p>{{ Str::limit($departure->description ?? 'Departure city for various tour packages', 80) }}</p>
                        <div class="destination-info">
                            <span class="tour-count">{{ $departure->tours_count }} Tours</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h4>No departure cities found</h4>
                    <p>Please check back later for more departure options.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($departures->hasPages())
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-area">
                    {{ $departures->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('after-style')
<style>
.departure-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    background: white;
    margin-bottom: 30px;
}

.departure-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.departure-card .destination-img {
    height: 280px;
    overflow: hidden;
    border-radius: 10px 10px 0 0;
    position: relative;
}

.departure-card .destination-img img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.departure-card:hover .destination-img img {
    transform: scale(1.05);
}

.departure-card .destination-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    background: white;
    border-radius: 0 0 10px 10px;
}

.departure-card .destination-content h5 {
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: 600;
    color: #333;
}

.departure-card .destination-content h5 a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.departure-card .destination-content h5 a:hover {
    color: #007bff;
}

.departure-card .destination-content p {
    flex-grow: 1;
    margin-bottom: 15px;
    color: #666;
    line-height: 1.5;
    font-size: 14px;
}

.departure-card .destination-info {
    margin-top: auto;
}

.departure-card .tour-count {
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

.departure-card:hover .destination-overlay {
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
    .departure-card .destination-img {
        height: 250px;
    }
    
    .departure-card .destination-img img {
        height: 250px;
    }
}

@media (max-width: 768px) {
    .departure-card .destination-img {
        height: 220px;
    }
    
    .departure-card .destination-img img {
        height: 220px;
    }
    
    .departure-card .destination-content {
        padding: 15px;
    }
    
    .departure-card .destination-content h5 {
        font-size: 16px;
    }
}
</style>
@endpush