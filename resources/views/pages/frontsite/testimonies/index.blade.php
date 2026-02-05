@extends('layouts.frontsite')

@section('title', 'Customer Reviews & Testimonials - Travel Indonesia')

@section('meta_description', 'Read what our customers say about their travel experiences with Travel Indonesia. Genuine reviews and testimonials from satisfied travelers.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Customer Reviews</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Reviews</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="testimonials-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <h2>What Our Customers Say</h2>
                    <p>Read genuine reviews and testimonials from our satisfied travelers</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @forelse($testimonies as $testimony)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-author">
                            <div class="author-img">
                                @if($testimony->image)
                                <img src="{{ asset('storage/' . $testimony->image) }}" alt="{{ $testimony->name }}">
                                @else
                                <img src="{{ asset('frontsite-assets/img/home1/testimonial-0' . (($loop->index % 3) + 1) . '.png') }}" alt="{{ $testimony->name }}">
                                @endif
                            </div>
                            <div class="author-info">
                                <h6>{!! $testimony->name !!}</h6>
                                <span>Customer</span>
                            </div>
                        </div>
                        <div class="testimonial-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= ($testimony->rating ?? 5))
                                <i class="bi bi-star-fill"></i>
                                @else
                                <i class="bi bi-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="testimonial-content">
                        <p>"{{ $testimony->description }}"</p>
                    </div>
                    <div class="testimonial-footer">
                        <span class="testimonial-date">
                            {{ \Carbon\Carbon::parse($testimony->created_at)->format('M d, Y') }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h4>No testimonials found</h4>
                    <p>Be the first to share your travel experience with us!</p>
                    <a href="{{ route('frontsite.contact.index') }}" class="btn btn-primary">Contact Us</a>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($testimonies->hasPages())
        <div class="row">
            <div class="col-lg-12">
                <div class="pagination-area">
                    {{ $testimonies->links() }}
                </div>
            </div>
        </div>
        @endif
        
        <!-- CTA Section -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="testimonial-cta text-center">
                    <h4>Share Your Experience</h4>
                    <p>Have you traveled with us? We'd love to hear about your experience!</p>
                    <a href="{{ route('frontsite.contact.index') }}" class="btn btn-primary">Write a Review</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
.testimonial-card {
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.testimonial-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.testimonial-author {
    display: flex;
    align-items: center;
}

.author-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 15px;
    flex-shrink: 0;
}

.author-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info h6 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #333;
}

.author-info span {
    color: #666;
    font-size: 14px;
}

.testimonial-rating {
    display: flex;
    gap: 2px;
}

.testimonial-rating i {
    color: #ffc107;
    font-size: 16px;
}

.testimonial-content {
    flex-grow: 1;
    margin-bottom: 20px;
}

.testimonial-content p {
    color: #555;
    line-height: 1.6;
    font-style: italic;
    margin: 0;
}

.testimonial-footer {
    border-top: 1px solid #eee;
    padding-top: 15px;
}

.testimonial-date {
    color: #999;
    font-size: 14px;
}

.testimonial-cta {
    background-color: #f8f9fa;
    padding: 50px 30px;
    border-radius: 10px;
}

.testimonial-cta h4 {
    margin-bottom: 15px;
    color: #333;
}

.testimonial-cta p {
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
</style>
@endpush