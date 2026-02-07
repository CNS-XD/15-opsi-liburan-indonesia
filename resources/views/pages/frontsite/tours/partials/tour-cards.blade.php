@forelse($tours as $tour)
<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="card-modern">
        <div class="card-modern-image">
            <a href="{{ route('frontsite.tours.show', $tour->slug) }}">
                @if($tour->image && file_exists(public_path('storage/' . $tour->image)))
                <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->title }}" loading="lazy">
                @elseif($tour->tour_photos->count() > 0 && $tour->tour_photos->first()->image)
                <img src="{{ asset('storage/' . $tour->tour_photos->first()->image) }}" alt="{{ $tour->title }}" onerror="this.src='{{ asset('frontsite-assets/img/packages/1.jpg') }}'" loading="lazy">
                @else
                <img src="{{ asset('frontsite-assets/img/packages/' . (($loop->index % 13) + 1) . '.jpg') }}" alt="{{ $tour->title }}" loading="lazy">
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
                <a href="{{ route('frontsite.tours.show', $tour->slug) }}">{{ $tour->title }}</a>
            </h3>
            
            <div class="mb-3">
                <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 0.9rem;">
                    <i class="bi bi-geo-alt-fill" style="color: #667eea;"></i>
                    <span>
                        @if($tour->tour_departures->count() > 0)
                        from {{ $tour->tour_departures->first()->departure->title }}
                        @else
                        from Multiple Cities
                        @endif
                    </span>
                </div>
            </div>

            <p class="card-modern-text" style="color: #64748b; line-height: 1.6; margin-bottom: 1rem;">{{ Str::limit(strip_tags($tour->description), 100) }}</p>

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
                            @if($tour->price && $tour->price > 0)
                            ${{ number_format($tour->price, 0) }}
                            @else
                            <span style="font-size: 0.9rem; color: #64748b;">Contact for Price</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('frontsite.tours.show', $tour->slug) }}" 
                       class="btn-modern btn-modern-primary" 
                       style="padding: 0.75rem 1.5rem;">
                        Book Now
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="bi bi-inbox" style="font-size: 5rem; color: #cbd5e1;"></i>
        </div>
        <h4 style="color: #334155; font-weight: 700; margin-bottom: 15px;">No tour packages found</h4>
        <p style="color: #64748b; margin-bottom: 25px;">Try adjusting your filters or check back later for more amazing tour packages.</p>
        <button class="btn-modern btn-modern-primary" id="resetFilters">
            <i class="bi bi-arrow-clockwise me-2"></i>
            Reset Filters
        </button>
    </div>
</div>
@endforelse
