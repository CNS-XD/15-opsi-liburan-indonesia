@extends('layouts.frontsite')

@section('title', 'Customer Reviews & Testimonials - Travel Indonesia')

@section('meta_description', 'Read what our customers say about their travel experiences with Travel Indonesia. Genuine reviews and testimonials from satisfied travelers.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-chat-quote" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Customer Reviews</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Read genuine reviews and testimonials from our satisfied travelers</center>
                    </p>
                    <div style="margin-top: 2rem; display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
                        <div style="text-align: center;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: white;">{{ $testimonies->total() }}+</div>
                            <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem;">Happy Travelers</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: white;">
                                <i class="bi bi-star-fill" style="font-size: 2rem; color: #ffc107;"></i> 4.9
                            </div>
                            <div style="color: rgba(255, 255, 255, 0.9); font-size: 0.9rem;">Average Rating</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<div class="testimonials-section" style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <h2 style="color: #1e293b; font-weight: 700; margin-bottom: 1rem;">What Our Customers Say</h2>
                    <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Discover why travelers choose us for their Indonesian adventures</p>
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
                        <p>{!! $testimony->description !!}"</p>
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
                <div class="text-center py-5" style="background: white; padding: 4rem 2rem !important; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);">
                    <div style="width: 120px; height: 120px; margin: 0 auto 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-chat-quote" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <h4 style="color: #1e293b; font-weight: 700; margin-bottom: 1rem;">No testimonials yet</h4>
                    <p style="color: #64748b; margin-bottom: 2rem;">Be the first to share your travel experience with us!</p>
                    <a href="{{ route('frontsite.contact.index') }}" class="btn-modern btn-modern-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 2rem; text-decoration: none; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50px; font-weight: 600;">
                        <i class="bi bi-pencil-square"></i> Write a Review
                    </a>
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
                <div class="testimonial-cta text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 4rem 2rem; border-radius: 1.5rem; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);">
                    <div style="max-width: 600px; margin: 0 auto;">
                        <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-star-fill" style="font-size: 2rem; color: #ffc107;"></i>
                        </div>
                        <h4 style="color: white; font-weight: 700; margin-bottom: 1rem; font-size: 1.8rem;">Share Your Experience</h4>
                        <p style="color: rgba(255, 255, 255, 0.95); margin-bottom: 2rem; font-size: 1.1rem;">Have you traveled with us? We'd love to hear about your experience and share it with future travelers!</p>
                        <a href="{{ route('frontsite.contact.index') }}" class="btn-modern" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 2.5rem; text-decoration: none; background: white; color: #667eea; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">
                            <i class="bi bi-pencil-square"></i> Write a Review
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

/* Testimonial Cards */
.testimonial-card {
    background: white;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.testimonial-card::before {
    content: '"';
    position: absolute;
    top: -20px;
    left: 20px;
    font-size: 120px;
    color: rgba(102, 126, 234, 0.05);
    font-family: Georgia, serif;
    line-height: 1;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.testimonial-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 3px solid #667eea;
    box-shadow: 0 4px 10px rgba(102, 126, 234, 0.2);
}

.author-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info h6 {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #1e293b;
    font-size: 1.1rem;
}

.author-info span {
    color: #64748b;
    font-size: 0.875rem;
    font-weight: 500;
}

.testimonial-rating {
    display: flex;
    gap: 3px;
}

.testimonial-rating i {
    color: #ffc107;
    font-size: 1rem;
}

.testimonial-content {
    flex-grow: 1;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 1;
}

.testimonial-content p {
    color: #475569;
    line-height: 1.8;
    font-style: italic;
    margin: 0;
    font-size: 0.95rem;
}

.testimonial-footer {
    border-top: 2px solid #f1f5f9;
    padding-top: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.testimonial-date {
    color: #94a3b8;
    font-size: 0.875rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.testimonial-date::before {
    content: '📅';
    font-size: 1rem;
}

/* CTA Section */
.testimonial-cta .btn-modern:hover {
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

/* Button Hover Effects */
.btn-modern {
    transition: all 0.3s ease;
}

.btn-modern:hover {
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        min-height: 40vh !important;
    }
    
    .hero-content > div:last-child {
        flex-direction: column !important;
        gap: 1rem !important;
    }
    
    .testimonial-card {
        padding: 1.5rem;
    }
    
    .testimonial-card::before {
        font-size: 80px;
        top: -10px;
        left: 10px;
    }
    
    .author-img {
        width: 50px;
        height: 50px;
    }
    
    .testimonial-cta {
        padding: 3rem 1.5rem !important;
    }
}

/* Loading Animation */
.testimonial-card {
    animation: fadeIn 0.5s ease-out;
}

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

/* Stagger animation for cards */
.testimonial-card:nth-child(1) { animation-delay: 0.1s; }
.testimonial-card:nth-child(2) { animation-delay: 0.2s; }
.testimonial-card:nth-child(3) { animation-delay: 0.3s; }
.testimonial-card:nth-child(4) { animation-delay: 0.4s; }
.testimonial-card:nth-child(5) { animation-delay: 0.5s; }
.testimonial-card:nth-child(6) { animation-delay: 0.6s; }
</style>
@endpush