@extends('layouts.frontsite')

@section('title', $tour->title . ' | Opsi Liburan Indonesia')

@section('content')
<!-- Tour Detail Section Start -->
<div class="tour-detail-section pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Tour Images -->
                <div class="tour-images mb-40">
                    @if($tour->tour_photos->count() > 1)
                        <div class="swiper tour-detail-slider">
                            <div class="swiper-wrapper">
                                @foreach($tour->tour_photos as $photo)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $tour->title }}" style="width:100%; height:400px; object-fit:cover; border-radius:10px;">
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    @else
                        <img src="{{ $tour->tour_photos->first() ? asset('storage/' . $tour->tour_photos->first()->image) : asset('frontsite-assets/img/packages/default.jpg') }}" 
                             alt="{{ $tour->title }}" 
                             style="width:100%; height:400px; object-fit:cover; border-radius:10px;">
                    @endif
                </div>

                <!-- Tour Info -->
                <div class="tour-info mb-40">
                    <div class="d-flex justify-content-between align-items-start mb-20">
                        <div>
                            <h1 class="mb-10">{{ $tour->title }}</h1>
                            <div class="tour-meta d-flex align-items-center gap-20 mb-20">
                                <div class="rating d-flex align-items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $averageRating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-2">{{ number_format($averageRating, 1) }} ({{ $totalReviews }} reviews)</span>
                                </div>
                                <div class="tour-type">
                                    <span class="badge bg-primary">{{ $tour->type_tour == 0 ? 'Private Tour' : 'Sharing Tour' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="price-info text-end">
                            <div class="price">
                                <span class="text-muted">From</span>
                                <h3 class="text-primary mb-0">${{ number_format($tour->price, 0) }}</h3>
                                <small class="text-muted">per person</small>
                            </div>
                        </div>
                    </div>

                    <!-- Tour Quick Info -->
                    <div class="tour-quick-info row mb-30">
                        <div class="col-md-3 col-6 mb-20">
                            <div class="info-item">
                                <i class="fas fa-clock text-primary mb-10"></i>
                                <h6>Duration</h6>
                                <p>{{ $tour->time_tour }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-20">
                            <div class="info-item">
                                <i class="fas fa-users text-primary mb-10"></i>
                                <h6>Group Size</h6>
                                <p>{{ $tour->group_size ?? 'Flexible' }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-20">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt text-primary mb-10"></i>
                                <h6>Departure</h6>
                                <p>
                                    @if($tour->tour_departures->first())
                                        {{ $tour->tour_departures->first()->departure->name }}
                                    @else
                                        Various Cities
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-20">
                            <div class="info-item">
                                <i class="fas fa-mountain text-primary mb-10"></i>
                                <h6>Difficulty</h6>
                                <p>{{ $tour->level_tour ?? 'Moderate' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tour Description -->
                <div class="tour-description mb-40">
                    <h3 class="mb-20">About This Tour</h3>
                    <div class="description-content">
                        {!! $tour->description !!}
                    </div>
                </div>

                <!-- Tour Details -->
                @if($tour->tour_details->count() > 0)
                <div class="tour-details mb-40">
                    <h3 class="mb-20">Tour Details</h3>
                    <div class="details-content">
                        @foreach($tour->tour_details as $detail)
                        <div class="detail-item mb-20">
                            <h5>{{ $detail->title ?? 'Detail' }}</h5>
                            <p>{{ $detail->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tour Reviews -->
                <div class="tour-reviews mb-40">
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <h3 class="mb-0">Reviews ({{ $totalReviews }})</h3>
                        <a href="{{ route('frontsite.tours.reviews', $tour->slug) }}" class="btn btn-outline-primary btn-sm">View All Reviews</a>
                    </div>
                    
                    @if($tour->tour_reviews->count() > 0)
                        @foreach($tour->tour_reviews->take(3) as $review)
                        <div class="review-item mb-30 p-20" style="border: 1px solid #eee; border-radius: 10px;">
                            <div class="d-flex justify-content-between align-items-start mb-10">
                                <div>
                                    <h6 class="mb-5">{{ $review->name }}</h6>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <small class="text-muted">
                                    {{ $review->created_at ? \Carbon\Carbon::parse($review->created_at)->format('M d, Y') : 'Recently' }}
                                </small>
                            </div>
                            <p class="mb-0">{{ $review->description }}</p>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted">No reviews yet. Be the first to review this tour!</p>
                    @endif

                    <!-- Add Review Form -->
                    <div class="add-review-form mt-40">
                        <h4 class="mb-20">Write a Review</h4>
                        <form action="{{ route('frontsite.reviews.store') }}" method="POST" id="reviewForm">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            
                            <div class="row">
                                <div class="col-md-12 mb-20">
                                    <label class="form-label">Name *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="mb-20">
                                <label class="form-label">Rating *</label>
                                <div class="rating-input">
                                    <input type="hidden" name="rating" id="rating" required>
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star" data-rating="{{ $i }}" style="font-size: 24px; color: #ddd; cursor: pointer; margin-right: 5px;"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-20">
                                <label class="form-label">Your Review *</label>
                                <textarea name="review" class="form-control" rows="4" placeholder="Share your experience with this tour..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="tour-sidebar">
                    <!-- Booking Form -->
                    <div class="booking-form mb-30 p-30" style="border: 1px solid #eee; border-radius: 10px;">
                        <h4 class="mb-20">Book This Tour</h4>
                        
                        @if(session('error'))
                            <div class="alert alert-danger mb-20">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        @if(session('success'))
                            <div class="alert alert-success mb-20">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('frontsite.booking.store') }}" method="POST" id="bookingForm">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            
                            <div class="mb-20">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-20">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-20">
                                <label class="form-label">Phone *</label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-20">
                                <label class="form-label">Number of Travelers *</label>
                                <input type="number" name="travelers" class="form-control @error('travelers') is-invalid @enderror" min="1" value="{{ old('travelers', 1) }}" required>
                                @error('travelers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-20">
                                <label class="form-label">Preferred Date *</label>
                                <input type="date" name="preferred_date" class="form-control @error('preferred_date') is-invalid @enderror" value="{{ old('preferred_date') }}" min="{{ date('Y-m-d') }}" required>
                                @error('preferred_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-20">
                                <label class="form-label">Special Requests</label>
                                <textarea name="special_requests" class="form-control @error('special_requests') is-invalid @enderror" rows="3" placeholder="Any special requirements or requests...">{{ old('special_requests') }}</textarea>
                                @error('special_requests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Book Now</button>
                        </form>
                    </div>

                    <!-- Tour Highlights -->
                    @if($tour->tour_destinations->count() > 0)
                    <div class="tour-highlights mb-30 p-30" style="border: 1px solid #eee; border-radius: 10px;">
                        <h4 class="mb-20">Tour Highlights</h4>
                        <ul class="list-unstyled">
                            @foreach($tour->tour_destinations as $destination)
                            <li class="mb-10">
                                <i class="fas fa-check text-success me-10"></i>
                                {{ $destination->destination->name ?? $destination->name }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Contact Info -->
                    <div class="contact-info p-30" style="border: 1px solid #eee; border-radius: 10px;">
                        <h4 class="mb-20">Need Help?</h4>
                        <div class="contact-item mb-15">
                            <i class="fas fa-phone text-primary me-10"></i>
                            <span>+62 123 456 789</span>
                        </div>
                        <div class="contact-item mb-15">
                            <i class="fas fa-envelope text-primary me-10"></i>
                            <span>info@opsiliburan.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fab fa-whatsapp text-success me-10"></i>
                            <span>WhatsApp Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Tours -->
        @if($relatedTours->count() > 0)
        <div class="related-tours mt-60">
            <h3 class="mb-40 text-center">You Might Also Like</h3>
            <div class="row">
                @foreach($relatedTours as $relatedTour)
                <div class="col-lg-3 col-md-6 mb-30">
                    <div class="package-card">
                        <div class="package-img-wrap">
                            <a href="{{ route('frontsite.tours.show', $relatedTour->slug) }}" class="package-img">
                                <img src="{{ $relatedTour->tour_photos->first() ? asset('storage/' . $relatedTour->tour_photos->first()->image) : asset('frontsite-assets/img/packages/default.jpg') }}" 
                                     alt="{{ $relatedTour->title }}" 
                                     style="height:200px; width:100%; object-fit:cover;">
                            </a>
                        </div>
                        <div class="package-content p-20">
                            <h6><a href="{{ route('frontsite.tours.show', $relatedTour->slug) }}">{{ Str::limit($relatedTour->title, 50) }}</a></h6>
                            <div class="price-area mt-15">
                                <span class="text-primary fw-bold">${{ number_format($relatedTour->price, 0) }}</span>
                                <small class="text-muted">per person</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Tour Detail Section End -->

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.tour-quick-info .info-item {
    text-align: center;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 10px;
    height: 100%;
}
.tour-quick-info .info-item i {
    font-size: 24px;
    display: block;
}
.tour-quick-info .info-item h6 {
    margin-bottom: 5px;
    font-weight: 600;
}
.tour-quick-info .info-item p {
    margin-bottom: 0;
    color: #666;
}
</style>
@endpush

@push('scripts')
<script>
// Initialize Swiper for tour images
if (document.querySelector('.tour-detail-slider')) {
    new Swiper('.tour-detail-slider', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
}

// Rating stars functionality
document.querySelectorAll('.stars i').forEach(star => {
    star.addEventListener('click', function() {
        const rating = this.getAttribute('data-rating');
        document.getElementById('rating').value = rating;
        
        // Update star display
        document.querySelectorAll('.stars i').forEach((s, index) => {
            if (index < rating) {
                s.classList.remove('far');
                s.classList.add('fas');
                s.style.color = '#ffc107';
            } else {
                s.classList.remove('fas');
                s.classList.add('far');
                s.style.color = '#ddd';
            }
        });
    });
    
    // Hover effect
    star.addEventListener('mouseenter', function() {
        const rating = this.getAttribute('data-rating');
        document.querySelectorAll('.stars i').forEach((s, index) => {
            if (index < rating) {
                s.style.color = '#ffc107';
            } else {
                s.style.color = '#ddd';
            }
        });
    });
});

// Reset hover effect
document.querySelector('.stars').addEventListener('mouseleave', function() {
    const currentRating = document.getElementById('rating').value;
    document.querySelectorAll('.stars i').forEach((s, index) => {
        if (index < currentRating) {
            s.style.color = '#ffc107';
        } else {
            s.style.color = '#ddd';
        }
    });
});

// Booking form validation
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    // Simple validation
    const requiredFields = this.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Please fill in all required fields.');
        return false;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Processing...';
    submitBtn.disabled = true;
    
    // Allow form to submit naturally
    return true;
});

// Review form validation
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    const rating = document.getElementById('rating').value;
    if (!rating) {
        e.preventDefault();
        alert('Please select a rating.');
        return false;
    }
});
</script>
@endpush
@endsection