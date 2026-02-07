@extends('layouts.frontsite')

@section('activeMenuTours', 'active')

@section('title', 'Tour Packages - Travel Indonesia')

@section('meta_description', 'Discover amazing tour packages across Indonesia. Find the perfect travel experience with our curated selection of tours.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <h1 style="color: white; margin-bottom: 1rem;">Tour Packages</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Discover amazing tour packages across Indonesia and find your perfect adventure</center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="section-modern" style="background: #f8fafc; padding-top: 3rem; padding-bottom: 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-modern" style="padding: 2rem;">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg col-md-6">
                            <label class="form-label" style="font-weight: 600; color: #0f172a; margin-bottom: 0.5rem; display: block;">
                                <i class="bi bi-geo-alt-fill me-2" style="color: #667eea;"></i>Destination
                            </label>
                            <select class="form-select" id="destinationFilter" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 0.75rem 1rem; font-size: 14px; transition: all 0.3s;">
                                <option value="">All Destinations</option>
                                @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg col-md-6">
                            <label class="form-label" style="font-weight: 600; color: #0f172a; margin-bottom: 0.5rem; display: block;">
                                <i class="bi bi-pin-map-fill me-2" style="color: #667eea;"></i>Departure
                            </label>
                            <select class="form-select" id="departureFilter" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 0.75rem 1rem; font-size: 14px; transition: all 0.3s;">
                                <option value="">All Departures</option>
                                @foreach($departures as $departure)
                                <option value="{{ $departure->id }}">{{ $departure->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg col-md-6">
                            <label class="form-label" style="font-weight: 600; color: #0f172a; margin-bottom: 0.5rem; display: block;">
                                <i class="bi bi-clock-fill me-2" style="color: #667eea;"></i>Duration
                            </label>
                            <select class="form-select" id="durationFilter" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 0.75rem 1rem; font-size: 14px; transition: all 0.3s;">
                                <option value="">Any Duration</option>
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="3">3 Days</option>
                                <option value="4">4+ Days</option>
                            </select>
                        </div>
                        <div class="col-lg col-md-6">
                            <label class="form-label" style="font-weight: 600; color: #0f172a; margin-bottom: 0.5rem; display: block;">
                                <i class="bi bi-cash-stack me-2" style="color: #667eea;"></i>Price Range
                            </label>
                            <select class="form-select" id="priceFilter" style="border: 2px solid #e2e8f0; border-radius: 10px; padding: 0.75rem 1rem; font-size: 14px; transition: all 0.3s;">
                                <option value="">Any Price</option>
                                <option value="0-500000">Under $50</option>
                                <option value="500000-1000000">$50 - $100</option>
                                <option value="1000000-2000000">$100 - $200</option>
                                <option value="2000000+">Above $200</option>
                            </select>
                        </div>
                        <div class="col-lg-auto col-md-6">
                            <button class="btn-modern btn-modern-primary w-100" id="applyFilter" style="padding: 0.75rem 1.5rem; font-weight: 600;">
                                <i class="bi bi-funnel-fill me-2"></i>
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tours Section -->
<section class="section-modern bg-white">
    <div class="container">
        <!-- Results Info -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="results-info">
                    <p style="color: #64748b; margin: 0; font-size: 14px;">Showing {{ $tours->count() }} of {{ $tours->total() }} tours</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="sort-options text-end">
                    <select class="form-select d-inline-block w-auto" id="sortBy" style="border: 1px solid #ddd; border-radius: 8px; padding: 8px 15px; font-size: 14px;">
                        <option value="newest">Newest First</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="popular">Most Popular</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row g-4" id="toursContainer">
            @include('pages.frontsite.tours.partials.tour-cards', ['tours' => $tours])
        </div>
        
        @if($tours->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Tours pagination" id="paginationContainer">
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
    </div>
</section>
@endsection

@push('after-style')
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
@endpush

@push('after-script')
<script>
$(document).ready(function() {
    // Function to load tours with AJAX
    function loadTours(params = {}) {
        // Show loading state
        $('#toursContainer').html(`
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="spinner-border" style="color: #667eea; width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3" style="color: #64748b;">Loading tours...</p>
                </div>
            </div>
        `);

        $.ajax({
            url: '{{ route("frontsite.tours.index") }}',
            type: 'GET',
            data: params,
            dataType: 'json',
            success: function(response) {
                // Update tours container
                $('#toursContainer').html(response.html);
                
                // Update pagination
                if (response.pagination) {
                    $('#paginationContainer').html(response.pagination);
                } else {
                    $('#paginationContainer').html('');
                }
                
                // Update results info
                $('.results-info p').text(`Showing ${response.count} of ${response.total} tours`);
                
                // Scroll to top of results
                $('html, body').animate({
                    scrollTop: $('#toursContainer').offset().top - 100
                }, 500);
            },
            error: function(xhr, status, error) {
                console.error('Error loading tours:', error);
                $('#toursContainer').html(`
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: #ef4444;"></i>
                            <h4 class="mt-3" style="color: #334155;">Error loading tours</h4>
                            <p style="color: #64748b;">Please try again later.</p>
                            <button class="btn-modern btn-modern-primary" onclick="location.reload()">
                                <i class="bi bi-arrow-clockwise me-2"></i>Reload Page
                            </button>
                        </div>
                    </div>
                `);
            }
        });
    }

    // Filter functionality
    $('#applyFilter').on('click', function() {
        const params = {
            destination: $('#destinationFilter').val(),
            departure: $('#departureFilter').val(),
            duration: $('#durationFilter').val(),
            price: $('#priceFilter').val(),
            sort: $('#sortBy').val()
        };
        
        loadTours(params);
    });
    
    // Sort functionality
    $('#sortBy').on('change', function() {
        const params = {
            destination: $('#destinationFilter').val(),
            departure: $('#departureFilter').val(),
            duration: $('#durationFilter').val(),
            price: $('#priceFilter').val(),
            sort: $(this).val()
        };
        
        loadTours(params);
    });
    
    // Reset filters
    $(document).on('click', '#resetFilters', function(e) {
        e.preventDefault();
        $('#destinationFilter').val('');
        $('#departureFilter').val('');
        $('#durationFilter').val('');
        $('#priceFilter').val('');
        $('#sortBy').val('newest');
        loadTours();
    });
    
    // Pagination click handler
    $(document).on('click', '#paginationContainer .page-link', function(e) {
        e.preventDefault();
        
        if ($(this).parent().hasClass('disabled') || $(this).parent().hasClass('active')) {
            return;
        }
        
        const url = $(this).attr('href');
        if (url) {
            const urlParams = new URLSearchParams(url.split('?')[1]);
            const params = {
                destination: $('#destinationFilter').val(),
                departure: $('#departureFilter').val(),
                duration: $('#durationFilter').val(),
                price: $('#priceFilter').val(),
                sort: $('#sortBy').val(),
                page: urlParams.get('page')
            };
            
            loadTours(params);
        }
    });
    
    // Add focus styles to select elements
    $('.form-select').on('focus', function() {
        $(this).css('border-color', '#667eea');
        $(this).css('box-shadow', '0 0 0 3px rgba(102, 126, 234, 0.1)');
    }).on('blur', function() {
        $(this).css('border-color', '#e2e8f0');
        $(this).css('box-shadow', 'none');
    });
});
</script>
@endpush