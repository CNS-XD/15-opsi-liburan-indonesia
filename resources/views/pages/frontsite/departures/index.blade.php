@extends('layouts.frontsite')

@section('activeMenuDepartures', 'active')
@section('title', 'Departure Cities - Opsi Liburan Indonesia')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <h1 style="color: white; margin-bottom: 1rem;">Departure Cities</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Choose your starting point for an unforgettable Indonesian adventure</center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Departures Grid Section -->
<section class="section-modern bg-white">
    <div class="container">
        <div class="row g-4">
            @forelse($departures as $departure)
            <div class="col-lg-4 col-md-6">
                <div class="card-modern">
                    <div class="card-modern-image">
                        @php
                            $departureImage = null;
                            if($departure->tour_departures->isNotEmpty() && $departure->tour_departures->first()->tour) {
                                $tour = $departure->tour_departures->first()->tour;
                                if($tour->image && file_exists(public_path('storage/' . $tour->image))) {
                                    $departureImage = asset('storage/' . $tour->image);
                                }
                            }
                            if(!$departureImage && $departure->image && file_exists(public_path('storage/' . $departure->image))) {
                                $departureImage = asset('storage/' . $departure->image);
                            }
                            if(!$departureImage) {
                                $departureImage = '/frontsite-assets/img/packages/default.jpg';
                            }
                        @endphp
                        <img src="{{ $departureImage }}" alt="{{ $departure->title }}">
                        
                        <!-- Departure Badge -->
                        <div style="position: absolute; top: 1rem; left: 1rem;">
                            <div style="background: rgba(255, 255, 255, 0.95); padding: 0.5rem 1rem; border-radius: var(--radius-lg); backdrop-filter: blur(10px); display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="#667eea" stroke-width="2"/>
                                    <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="#667eea" stroke-width="2"/>
                                </svg>
                                <span style="font-weight: 600; color: #667eea; font-size: 0.875rem;">Departure City</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-modern-content">
                        <h3 class="card-modern-title">
                            <a href="{{ route('frontsite.departures.show', $departure->id) }}">{{ $departure->title }}</a>
                        </h3>
                        <p class="card-modern-text">{{ Str::limit(strip_tags($departure->description ?? 'Start your journey from this beautiful city'), 100) }}</p>
                    </div>
                    
                    <div class="card-modern-footer">
                        <span class="badge-modern badge-modern-accent">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 0.25rem;">
                                <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $departure->tours_count ?? 0 }} Tours
                        </span>
                        <a href="{{ route('frontsite.departures.show', $departure->id) }}" class="btn-modern btn-modern-primary">
                            View Tours
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div style="max-width: 400px; margin: 0 auto;">
                    <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity: 0.3; margin-bottom: 1.5rem;">
                        <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <h4 style="color: var(--neutral-700); margin-bottom: 0.5rem;">No Departure Cities Found</h4>
                    <p style="color: var(--neutral-500);">Please check back later for more departure options.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($departures->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="pagination-modern">
                    {{ $departures->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

@push('after-style')
<style>
/* Pagination Modern */
.pagination-modern {
    display: flex;
    justify-content: center;
}

.pagination-modern .pagination {
    display: flex;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-modern .page-item {
    display: inline-block;
}

.pagination-modern .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 45px;
    height: 45px;
    padding: 0.5rem 1rem;
    background: white;
    border: 2px solid var(--neutral-200);
    border-radius: var(--radius-lg);
    color: var(--neutral-700);
    text-decoration: none;
    font-weight: 600;
    transition: all var(--transition-base);
}

.pagination-modern .page-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
    transform: translateY(-2px);
}

.pagination-modern .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: white;
}

.pagination-modern .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}
</style>
@endpush
