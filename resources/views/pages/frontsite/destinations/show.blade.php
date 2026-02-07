@extends('layouts.frontsite')

@section('activeMenuDestinations', 'active')

@section('title', $destination->title . ' - Destinations')

@section('meta_description', Str::limit($destination->description, 160))

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content animate-fade-in-up">
                    <div class="mb-3">
                        <span class="badge-modern badge-modern-primary" style="background: rgba(255, 255, 255, 0.2); color: white; font-size: 1rem; padding: 0.5rem 1.5rem;">
                            <i class="bi bi-geo-alt-fill me-2"></i>Destination
                        </span>
                    </div>
                    <h1 class="mb-4">{{ $destination->title }}</h1>
                    <p class="mb-4">{{ Str::limit($destination->description, 200) }}</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('frontsite.destinations.index') }}" class="btn-modern btn-modern-secondary" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255, 255, 255, 0.4); color: white !important;">
                            <i class="bi bi-arrow-left me-2"></i>All Destinations
                        </a>
                        <a href="{{ route('frontsite.home.index') }}" class="btn-modern" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: #764ba2 !important; box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);">
                            <i class="bi bi-house-fill me-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tours Section -->
<section class="section-modern" style="background: #f8fafc;">
    <div class="container">
        @if($tours->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="mb-2" style="color: #0f172a; font-weight: 700;">Available Tours</h3>
                        <p class="text-muted mb-0">
                            <center>
                                Found {{ $tours->total() }} tour{{ $tours->total() > 1 ? 's' : '' }} in {{ $destination->title }}
                            <center>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach($tours as $tour)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card-modern">
                    <div class="card-modern-image">
                        <a href="{{ route('frontsite.tours.show', $tour->slug ?? $tour->id) }}">
                            @if($tour->tour_photos->count() > 0 && $tour->tour_photos->first()->image)
                                <img src="{{ asset('storage/' . $tour->tour_photos->first()->image) }}" 
                                     alt="{{ $tour->title }}"
                                     onerror="this.src='{{ asset('frontsite-assets/img/packages/1.jpg') }}'"
                                     loading="lazy">
                            @else
                                <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" 
                                     alt="{{ $tour->title }}"
                                     loading="lazy">
                            @endif
                        </a>
                        @if($tour->is_best)
                        <div class="card-modern-badge" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: #764ba2;">
                            <i class="bi bi-star-fill me-1"></i>Most Loved
                        </div>
                        @endif
                        <div class="card-modern-badge" style="top: auto; bottom: 1rem; right: 1rem; background: rgba(102, 126, 234, 0.95); color: white;">
                            <i class="bi bi-clock-fill me-1"></i>{{ $tour->time_tour }}
                        </div>
                    </div>
                    <div class="card-modern-content">
                        <h3 class="card-modern-title">
                            <a href="{{ route('frontsite.tours.show', $tour->slug ?? $tour->id) }}">{{ $tour->title }}</a>
                        </h3>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 0.9rem;">
                                <i class="bi bi-geo-alt-fill" style="color: #667eea;"></i>
                                <span>
                                    @if($tour->tour_departures->first())
                                        from {{ $tour->tour_departures->first()->departure->title ?? 'Multiple Cities' }}
                                    @else
                                        from Multiple Cities
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mb-3 flex-wrap">
                            <span class="badge-modern" style="background: rgba(102, 126, 234, 0.1); color: #667eea; font-size: 0.8rem;">
                                <i class="bi bi-people-fill me-1"></i>{{ $tour->type_tour == 0 ? 'Private Tour' : 'Sharing Tour' }}
                            </span>
                            <span class="badge-modern" style="background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 0.8rem;">
                                <i class="bi bi-check-circle-fill me-1"></i>All Inclusive
                            </span>
                        </div>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center pt-3" style="border-top: 1px solid #e2e8f0;">
                                <div>
                                    <div class="text-muted" style="font-size: 0.85rem;">Starting from</div>
                                    <div class="card-modern-price" style="font-size: 1.5rem; font-weight: 800; color: #ec4899;">
                                        ${{ number_format($tour->price ?? 0, 0) }}
                                    </div>
                                </div>
                                <a href="{{ route('frontsite.tours.show', $tour->slug ?? $tour->id) }}" 
                                   class="btn-modern btn-modern-primary" 
                                   style="padding: 0.75rem 1.5rem;">
                                    View Details
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($tours->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Tours pagination">
                    <ul class="pagination justify-content-center gap-2">
                        {{-- Previous Page Link --}}
                        @if ($tours->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link" style="border-radius: 0.75rem; border: 2px solid #e2e8f0; background: white; color: #94a3b8; padding: 0.75rem 1rem;">
                                    <i class="bi bi-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $tours->previousPageUrl() }}" style="border-radius: 0.75rem; border: 2px solid #667eea; background: white; color: #667eea; padding: 0.75rem 1rem; transition: all 0.3s;">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($tours->links()->elements[0] as $page => $url)
                            @if ($page == $tours->currentPage())
                                <li class="page-item active">
                                    <span class="page-link" style="border-radius: 0.75rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; padding: 0.75rem 1rem; min-width: 45px; text-align: center;">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}" style="border-radius: 0.75rem; border: 2px solid #e2e8f0; background: white; color: #475569; padding: 0.75rem 1rem; min-width: 45px; text-align: center; transition: all 0.3s;">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($tours->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $tours->nextPageUrl() }}" style="border-radius: 0.75rem; border: 2px solid #667eea; background: white; color: #667eea; padding: 0.75rem 1rem; transition: all 0.3s;">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link" style="border-radius: 0.75rem; border: 2px solid #e2e8f0; background: white; color: #94a3b8; padding: 0.75rem 1rem;">
                                    <i class="bi bi-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-inbox" style="font-size: 5rem; color: #cbd5e1;"></i>
                    </div>
                    <h3 class="mb-3" style="color: #334155; font-weight: 700;">No Tours Available</h3>
                    <p class="text-muted mb-4" style="font-size: 1.1rem;">
                        There are no tours available in {{ $destination->title }} at the moment. 
                        Please check back later or explore other destinations.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('frontsite.destinations.index') }}" class="btn-modern btn-modern-primary">
                            <i class="bi bi-geo-alt-fill me-2"></i>View All Destinations
                        </a>
                        <a href="{{ route('frontsite.home.index') }}" class="btn-modern btn-modern-secondary">
                            <i class="bi bi-house-fill me-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
/* Pagination Hover Effects */
.pagination .page-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: white !important;
    border-color: #667eea !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

.pagination .page-item.disabled .page-link:hover {
    transform: none;
    box-shadow: none;
    background: white !important;
    color: #94a3b8 !important;
}

.pagination .page-item.active .page-link {
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}
</style>
@endsection
