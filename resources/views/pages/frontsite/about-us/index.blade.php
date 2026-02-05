@extends('layouts.frontsite')

@section('title', 'About Us - Travel Indonesia')

@section('meta_description', 'Learn more about Travel Indonesia. We are committed to providing the best travel experiences across Indonesia.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>About Us</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Hero Section -->
<div class="about-hero-section pt-120 pb-60">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-hero-content">
                    <div class="section-head">
                        <span class="section-subtitle">Welcome to Travel Indonesia</span>
                        <h2>{{ $about->title ?? 'Your Gateway to Amazing Indonesian Adventures' }}</h2>
                    </div>
                    <div class="about-text">
                        @if($about && $about->content)
                            {!! $about->content !!}
                        @else
                            <p>We are passionate about showcasing the incredible beauty and rich culture of Indonesia. From the majestic temples of Borobudur to the pristine beaches of Bali, we create unforgettable travel experiences that connect you with the heart and soul of this amazing archipelago.</p>
                            <p>Our team of experienced local guides and travel experts are dedicated to providing you with authentic, safe, and memorable journeys across Indonesia's diverse landscapes and vibrant communities.</p>
                        @endif
                    </div>
                    <div class="about-stats">
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="stat-item">
                                    <h3>500+</h3>
                                    <span>Happy Travelers</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <h3>50+</h3>
                                    <span>Destinations</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-hero-img">
                    @if($about && $about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" alt="About Us" class="main-img">
                    @else
                    <img src="{{ asset('frontsite-assets/img/packages/1.jpg') }}" alt="About Us" class="main-img">
                    @endif
                    <div class="floating-card">
                        <div class="card-content">
                            <div class="card-icon">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div class="card-text">
                                <h6>Best Travel Agency</h6>
                                <span>Indonesia 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission Vision Section -->
<div class="mission-vision-section pt-60 pb-120" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="mission-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h4>Our Mission</h4>
                    </div>
                    <div class="card-content">
                        <p>To provide exceptional travel experiences that showcase Indonesia's natural beauty, rich culture, and warm hospitality while promoting sustainable tourism practices that benefit local communities.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="vision-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <h4>Our Vision</h4>
                    </div>
                    <div class="card-content">
                        <p>To be Indonesia's leading travel company, recognized for creating transformative journeys that inspire travelers and contribute to the preservation of our nation's cultural and natural heritage.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us Section -->
@if($advantages->count() > 0)
<div class="advantages-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <span class="section-subtitle">Why Choose Us</span>
                    <h2>What Makes Us Special</h2>
                    <p>Discover what makes us the perfect choice for your Indonesian adventure</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach($advantages as $index => $advantage)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="advantage-card modern-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="advantage-icon">
                        @if($advantage->icon)
                        <img src="{{ asset('storage/' . $advantage->icon) }}" alt="{{ $advantage->title }}">
                        @else
                        <div class="default-icon">
                            @switch($index % 4)
                                @case(0)
                                    <i class="bi bi-shield-check"></i>
                                    @break
                                @case(1)
                                    <i class="bi bi-clock-history"></i>
                                    @break
                                @case(2)
                                    <i class="bi bi-people-fill"></i>
                                    @break
                                @default
                                    <i class="bi bi-geo-alt-fill"></i>
                            @endswitch
                        </div>
                        @endif
                    </div>
                    <div class="advantage-content">
                        <h5>{{ $advantage->title }}</h5>
                        <p>{{ $advantage->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@else
<!-- Default Advantages if none in database -->
<div class="advantages-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <span class="section-subtitle">Why Choose Us</span>
                    <h2>What Makes Us Special</h2>
                    <p>Discover what makes us the perfect choice for your Indonesian adventure</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="advantage-card modern-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="advantage-icon">
                        <div class="default-icon security">
                            <i class="bi bi-shield-check"></i>
                        </div>
                    </div>
                    <div class="advantage-content">
                        <h5>24/7 Customer Service</h5>
                        <p>Our dedicated customer service team is available 24/7 to assist you before, during, and after your trip, ensuring a smooth and worry-free travel experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="advantage-card modern-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="advantage-icon">
                        <div class="default-icon timing">
                            <i class="bi bi-clock-history"></i>
                        </div>
                    </div>
                    <div class="advantage-content">
                        <h5>Last Minute Booking</h5>
                        <p>Enjoy the flexibility to book your trip at the last minute with instant confirmation and reliable service, perfect for spontaneous travel plans.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="advantage-card modern-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="advantage-icon">
                        <div class="default-icon personal">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="advantage-content">
                        <h5>Personal Journey</h5>
                        <p>Every journey is personalized based on your preferences, interests, and travel style, creating a unique and memorable experience tailored just for you.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="advantage-card modern-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="advantage-icon">
                        <div class="default-icon guide">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                    </div>
                    <div class="advantage-content">
                        <h5>Expert Local Guides</h5>
                        <p>Travel confidently with experienced local guides who provide in-depth knowledge, cultural insights, and assistance throughout your journey.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Team Section -->
<div class="team-section pt-120 pb-120" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <span class="section-subtitle">Our Team</span>
                    <h2>Meet Our Travel Experts</h2>
                    <p>Passionate professionals dedicated to creating your perfect Indonesian adventure</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('frontsite-assets/img/home1/testimonial-author-img1.png') }}" alt="Team Member">
                        <div class="team-social">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="team-content">
                        <h5>Sarah Johnson</h5>
                        <span>Travel Consultant</span>
                        <p>Expert in cultural tours and adventure travel with 8+ years experience in Indonesian tourism.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('frontsite-assets/img/home1/testimonial-author-img2.png') }}" alt="Team Member">
                        <div class="team-social">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="team-content">
                        <h5>Ahmad Rizki</h5>
                        <span>Local Guide</span>
                        <p>Born and raised in Java, Ahmad specializes in historical sites and traditional culture experiences.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-card">
                    <div class="team-img">
                        <img src="{{ asset('frontsite-assets/img/home1/testimonial-author-img3.png') }}" alt="Team Member">
                        <div class="team-social">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="team-content">
                        <h5>Maya Sari</h5>
                        <span>Operations Manager</span>
                        <p>Ensures seamless travel operations and coordinates with local partners across Indonesia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
@if($testimonies->count() > 0)
<div class="testimonial-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <span class="section-subtitle">Testimonials</span>
                    <h2>What Our Customers Say</h2>
                    <p>Read testimonials from our satisfied customers</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider modern-slider">
                    @foreach($testimonies as $testimony)
                    <div class="testimonial-card modern-testimonial">
                        <div class="testimonial-content">
                            <div class="quote-icon">
                                <i class="bi bi-quote"></i>
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
                            <p>{!! $testimony->description !!}</p>
                            <div class="testimonial-author">
                                <div class="author-img">
                                    @if($testimony->image)
                                    <img src="{{ asset('storage/' . $testimony->image) }}" alt="{{ $testimony->name }}">
                                    @else
                                    <img src="{{ asset('frontsite-assets/img/home1/testimonial-0' . (($loop->index % 3) + 1) . '.png') }}" alt="{{ $testimony->name }}">
                                    @endif
                                </div>
                                <div class="author-info">
                                    <h6>{{ $testimony->name }}</h6>
                                    <span>Satisfied Customer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- CTA Section -->
<div class="cta-section pt-120 pb-120" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cta-content text-center">
                    <h2>Ready to Start Your Indonesian Adventure?</h2>
                    <p>Let us help you create unforgettable memories in the beautiful archipelago of Indonesia</p>
                    <div class="cta-buttons">
                        <a href="{{ route('frontsite.tours.index') }}" class="btn btn-light btn-lg me-3">
                            <i class="bi bi-compass"></i>
                            Explore Tours
                        </a>
                        <a href="{{ route('frontsite.contact.index') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-telephone"></i>
                            Contact Us
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
/* About Hero Section */
.about-hero-section {
    position: relative;
    overflow: hidden;
}

.section-subtitle {
    color: #007bff;
    font-weight: 600;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    display: block;
}

.about-hero-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 25px;
    line-height: 1.2;
}

.about-text p {
    font-size: 16px;
    line-height: 1.7;
    color: #666;
    margin-bottom: 20px;
}

.about-stats {
    margin-top: 40px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.stat-item h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #007bff;
    margin-bottom: 5px;
}

.stat-item span {
    color: #666;
    font-weight: 500;
}

.about-hero-img {
    position: relative;
}

.about-hero-img .main-img {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.floating-card {
    position: absolute;
    bottom: 30px;
    left: 30px;
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    z-index: 2;
}

.floating-card .card-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.floating-card .card-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
}

.floating-card .card-text h6 {
    margin: 0;
    font-weight: 600;
    color: #333;
}

.floating-card .card-text span {
    color: #666;
    font-size: 14px;
}

/* Mission Vision Section */
.mission-card, .vision-card {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    height: 100%;
    transition: transform 0.3s ease;
}

.mission-card:hover, .vision-card:hover {
    transform: translateY(-10px);
}

.mission-card .card-header, .vision-card .card-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.mission-card .card-icon, .vision-card .card-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
}

.mission-card h4, .vision-card h4 {
    margin: 0;
    font-weight: 700;
    color: #333;
}

.mission-card .card-content p, .vision-card .card-content p {
    font-size: 16px;
    line-height: 1.7;
    color: #666;
    margin: 0;
}

/* Modern Advantage Cards */
.advantage-card.modern-card {
    background: #fff;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
    border: 1px solid #f0f0f0;
}

.advantage-card.modern-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.advantage-card .advantage-icon {
    margin-bottom: 25px;
}

.advantage-card .default-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 32px;
    color: #fff;
}

.default-icon.security {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.default-icon.timing {
    background: linear-gradient(135deg, #fd7e14, #e63946);
}

.default-icon.personal {
    background: linear-gradient(135deg, #6f42c1, #e83e8c);
}

.default-icon.guide {
    background: linear-gradient(135deg, #007bff, #0056b3);
}

.advantage-card h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

.advantage-card p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

/* Team Section */
.team-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
}

.team-img {
    position: relative;
    overflow: hidden;
}

.team-img img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.team-card:hover .team-img img {
    transform: scale(1.1);
}

.team-social {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.team-card:hover .team-social {
    opacity: 1;
}

.team-social a {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #007bff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.team-social a:hover {
    background: #007bff;
    color: #fff;
}

.team-content {
    padding: 30px;
    text-align: center;
}

.team-content h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 5px;
}

.team-content span {
    color: #007bff;
    font-weight: 600;
    margin-bottom: 15px;
    display: block;
}

.team-content p {
    color: #666;
    line-height: 1.6;
    margin: 0;
}

/* Modern Testimonial */
.testimonial-card.modern-testimonial {
    background: #fff;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin: 0 15px;
    position: relative;
}

.quote-icon {
    position: absolute;
    top: -20px;
    left: 40px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
}

.testimonial-rating {
    margin: 20px 0;
}

.testimonial-rating i {
    color: #ffc107;
    font-size: 18px;
    margin-right: 2px;
}

.modern-testimonial p {
    font-size: 16px;
    line-height: 1.7;
    color: #555;
    font-style: italic;
    margin-bottom: 30px;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.testimonial-author .author-img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
}

.testimonial-author .author-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.testimonial-author .author-info h6 {
    margin: 0;
    font-weight: 700;
    color: #333;
}

.testimonial-author .author-info span {
    color: #666;
    font-size: 14px;
}

/* CTA Section */
.cta-section {
    color: #fff;
}

.cta-content h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.cta-content p {
    font-size: 1.1rem;
    margin-bottom: 40px;
    opacity: 0.9;
}

.cta-buttons .btn {
    padding: 15px 30px;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.cta-buttons .btn i {
    margin-right: 8px;
}

.btn-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.btn-outline-light:hover {
    background: #fff;
    color: #007bff;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .about-hero-content h2 {
        font-size: 2rem;
    }
    
    .floating-card {
        position: static;
        margin-top: 30px;
    }
    
    .mission-card, .vision-card {
        padding: 30px 20px;
    }
    
    .advantage-card.modern-card {
        padding: 30px 20px;
    }
    
    .cta-content h2 {
        font-size: 2rem;
    }
    
    .cta-buttons .btn {
        display: block;
        margin: 10px 0;
    }
}
</style>
@endpush

@push('after-script')
<script>
$(document).ready(function() {
    // Initialize testimonial slider
    $('.testimonial-slider.modern-slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
        arrows: false,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    
    // Add AOS animation if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }
});
</script>
@endpush