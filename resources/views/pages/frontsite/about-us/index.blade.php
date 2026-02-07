@extends('layouts.frontsite')

@section('title', 'About Us - Travel Indonesia')

@section('meta_description', 'Learn more about Travel Indonesia. We are committed to providing the best travel experiences across Indonesia.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <h1 style="color: white; margin-bottom: 1rem;">About Us</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>
                            Discover who we are and what makes us your perfect travel partner in Indonesia
                        </center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Hero Section -->
<section class="section-modern bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-hero-content">
                    <div class="section-head">
                        <span class="section-subtitle" style="color: #667eea; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: block;">Welcome to Travel Indonesia</span>
                        <h2 style="font-size: 2.5rem; font-weight: 700; color: #0f172a; margin-bottom: 25px; line-height: 1.2;">{{ $about->title ?? 'Your Gateway to Amazing Indonesian Adventures' }}</h2>
                    </div>
                    <div class="about-text">
                        @if($about && $about->content)
                            {!! $about->content !!}
                        @else
                            <p style="font-size: 16px; line-height: 1.7; color: #64748b; margin-bottom: 20px;">We are passionate about showcasing the incredible beauty and rich culture of Indonesia. From the majestic temples of Borobudur to the pristine beaches of Bali, we create unforgettable travel experiences that connect you with the heart and soul of this amazing archipelago.</p>
                            <p style="font-size: 16px; line-height: 1.7; color: #64748b; margin-bottom: 20px;">Our team of experienced local guides and travel experts are dedicated to providing you with authentic, safe, and memorable journeys across Indonesia's diverse landscapes and vibrant communities.</p>
                        @endif
                    </div>
                    <div class="about-stats" style="margin-top: 40px;">
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="stat-item" style="text-align: center; padding: 25px; background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border-radius: 15px; border: 2px solid rgba(102, 126, 234, 0.2);">
                                    <h3 style="font-size: 2.5rem; font-weight: 700; color: #667eea; margin-bottom: 5px;">500+</h3>
                                    <span style="color: #64748b; font-weight: 500;">Happy Travelers</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item" style="text-align: center; padding: 25px; background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, rgba(219, 39, 119, 0.1) 100%); border-radius: 15px; border: 2px solid rgba(236, 72, 153, 0.2);">
                                    <h3 style="font-size: 2.5rem; font-weight: 700; color: #ec4899; margin-bottom: 5px;">50+</h3>
                                    <span style="color: #64748b; font-weight: 500;">Destinations</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-hero-img" style="position: relative;">
                    @if($about && $about->image && file_exists(public_path('storage/' . $about->image)))
                    <img src="{{ asset('storage/' . $about->image) }}" alt="About Us" class="main-img" style="width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                    @else
                    <img src="{{ asset('frontsite-assets/img/packages/1.jpg') }}" alt="About Us" class="main-img" style="width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                    @endif
                    <div class="floating-card" style="position: absolute; bottom: 30px; left: 30px; background: #fff; padding: 20px 25px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); z-index: 2;">
                        <div class="card-content" style="display: flex; align-items: center; gap: 15px;">
                            <div class="card-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px;">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div class="card-text">
                                <h6 style="margin: 0; font-weight: 600; color: #0f172a; font-size: 1rem;">Best Travel Agency</h6>
                                <span style="color: #64748b; font-size: 14px;">Indonesia 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission Vision Section -->
<section class="section-modern" style="background: #f8fafc;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card-modern" style="height: 100%;">
                    <div class="card-modern-content">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 28px;">
                                <i class="bi bi-bullseye"></i>
                            </div>
                            <h4 style="margin: 0; font-weight: 700; color: #0f172a; font-size: 1.5rem;">Our Mission</h4>
                        </div>
                        <p style="font-size: 16px; line-height: 1.7; color: #64748b; margin: 0;">To provide exceptional travel experiences that showcase Indonesia's natural beauty, rich culture, and warm hospitality while promoting sustainable tourism practices that benefit local communities.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card-modern" style="height: 100%;">
                    <div class="card-modern-content">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #ec4899, #db2777); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 28px;">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                            <h4 style="margin: 0; font-weight: 700; color: #0f172a; font-size: 1.5rem;">Our Vision</h4>
                        </div>
                        <p style="font-size: 16px; line-height: 1.7; color: #64748b; margin: 0;">To be Indonesia's leading travel company, recognized for creating transformative journeys that inspire travelers and contribute to the preservation of our nation's cultural and natural heritage.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
@if($advantages->count() > 0)
<section class="section-modern bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center mb-5">
                    <span style="color: #667eea; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: block;">Why Choose Us</span>
                    <h2 style="font-size: 2.5rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">What Makes Us Special</h2>
                    <p style="color: #64748b; font-size: 1.1rem;">Discover what makes us the perfect choice for your Indonesian adventure</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach($advantages as $index => $advantage)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card-modern" style="text-align: center; height: 100%;" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="card-modern-content">
                        <div class="advantage-icon mb-4">
                            @if($advantage->icon && file_exists(public_path('storage/' . $advantage->icon)))
                            <img src="{{ asset('storage/' . $advantage->icon) }}" alt="{{ $advantage->title }}" style="width: 80px; height: 80px; object-fit: contain; margin: 0 auto;">
                            @else
                            <div class="default-icon" style="width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 32px; color: #fff; 
                                @switch($index % 4)
                                    @case(0) background: linear-gradient(135deg, #10b981, #059669); @break
                                    @case(1) background: linear-gradient(135deg, #f59e0b, #d97706); @break
                                    @case(2) background: linear-gradient(135deg, #8b5cf6, #7c3aed); @break
                                    @default background: linear-gradient(135deg, #667eea, #764ba2);
                                @endswitch
                            ">
                                @switch($index % 4)
                                    @case(0) <i class="bi bi-shield-check"></i> @break
                                    @case(1) <i class="bi bi-clock-history"></i> @break
                                    @case(2) <i class="bi bi-people-fill"></i> @break
                                    @default <i class="bi bi-geo-alt-fill"></i>
                                @endswitch
                            </div>
                            @endif
                        </div>
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">{{ $advantage->title }}</h5>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">{{ $advantage->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<!-- Default Advantages if none in database -->
<section class="section-modern bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center mb-5">
                    <span style="color: #667eea; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: block;">Why Choose Us</span>
                    <h2 style="font-size: 2.5rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">What Makes Us Special</h2>
                    <p style="color: #64748b; font-size: 1.1rem;">Discover what makes us the perfect choice for your Indonesian adventure</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card-modern" style="text-align: center; height: 100%;" data-aos="fade-up" data-aos-delay="0">
                    <div class="card-modern-content">
                        <div class="advantage-icon mb-4">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 32px; color: #fff;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">24/7 Customer Service</h5>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">Our dedicated customer service team is available 24/7 to assist you before, during, and after your trip, ensuring a smooth and worry-free travel experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card-modern" style="text-align: center; height: 100%;" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-modern-content">
                        <div class="advantage-icon mb-4">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 32px; color: #fff;">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">Last Minute Booking</h5>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">Enjoy the flexibility to book your trip at the last minute with instant confirmation and reliable service, perfect for spontaneous travel plans.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card-modern" style="text-align: center; height: 100%;" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-modern-content">
                        <div class="advantage-icon mb-4">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 32px; color: #fff;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">Personal Journey</h5>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">Every journey is personalized based on your preferences, interests, and travel style, creating a unique and memorable experience tailored just for you.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card-modern" style="text-align: center; height: 100%;" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-modern-content">
                        <div class="advantage-icon mb-4">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 32px; color: #fff;">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                        </div>
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">Expert Local Guides</h5>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">Travel confidently with experienced local guides who provide in-depth knowledge, cultural insights, and assistance throughout your journey.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Team Section -->
<section class="section-modern" style="background: #f8fafc;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center mb-5">
                    <span style="color: #667eea; font-weight: 600; font-size: 16px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: block;">Our Team</span>
                    <h2 style="font-size: 2.5rem; font-weight: 700; color: #0f172a; margin-bottom: 15px;">Meet Our Travel Experts</h2>
                    <p style="color: #64748b; font-size: 1.1rem;">Passionate professionals dedicated to creating your perfect Indonesian adventure</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card-modern team-card-modern">
                    <div class="team-img-modern" style="position: relative; overflow: hidden; border-radius: 20px 20px 0 0;">
                        <img src="{{ asset('frontsite-assets/img/home1/testimonial-author-img1.png') }}" alt="Team Member" style="width: 100%; height: 300px; object-fit: cover; transition: transform 0.3s ease;">
                        <div class="team-social-modern" style="position: absolute; top: 20px; right: 20px; display: flex; flex-direction: column; gap: 10px; opacity: 0; transition: opacity 0.3s ease;">
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-modern-content" style="text-align: center;">
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 5px;">Sarah Johnson</h5>
                        <span style="color: #667eea; font-weight: 600; margin-bottom: 15px; display: block;">Travel Consultant</span>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">Expert in cultural tours and adventure travel with 8+ years experience in Indonesian tourism.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-modern team-card-modern">
                    <div class="team-img-modern" style="position: relative; overflow: hidden; border-radius: 20px 20px 0 0;">
                        <img src="{{ asset('frontsite-assets/img/home1/testimonial-author-img2.png') }}" alt="Team Member" style="width: 100%; height: 300px; object-fit: cover; transition: transform 0.3s ease;">
                        <div class="team-social-modern" style="position: absolute; top: 20px; right: 20px; display: flex; flex-direction: column; gap: 10px; opacity: 0; transition: opacity 0.3s ease;">
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-modern-content" style="text-align: center;">
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 5px;">Ahmad Rizki</h5>
                        <span style="color: #667eea; font-weight: 600; margin-bottom: 15px; display: block;">Local Guide</span>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">Born and raised in Java, Ahmad specializes in historical sites and traditional culture experiences.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card-modern team-card-modern">
                    <div class="team-img-modern" style="position: relative; overflow: hidden; border-radius: 20px 20px 0 0;">
                        <img src="{{ asset('frontsite-assets/img/home1/testimonial-author-img3.png') }}" alt="Team Member" style="width: 100%; height: 300px; object-fit: cover; transition: transform 0.3s ease;">
                        <div class="team-social-modern" style="position: absolute; top: 20px; right: 20px; display: flex; flex-direction: column; gap: 10px; opacity: 0; transition: opacity 0.3s ease;">
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" style="width: 40px; height: 40px; background: rgba(255,255,255,0.95); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea; text-decoration: none; transition: all 0.3s ease;">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-modern-content" style="text-align: center;">
                        <h5 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 5px;">Maya Sari</h5>
                        <span style="color: #667eea; font-weight: 600; margin-bottom: 15px; display: block;">Operations Manager</span>
                        <p style="color: #64748b; line-height: 1.6; margin: 0;">Ensures seamless travel operations and coordinates with local partners across Indonesia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-modern" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 20px; color: #fff;">Ready to Start Your Indonesian Adventure?</h2>
                    <p style="font-size: 1.1rem; margin-bottom: 40px; opacity: 0.95;">Let us help you create unforgettable memories in the beautiful archipelago of Indonesia</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('frontsite.tours.index') }}" class="btn-modern" style="background: #fff; color: #667eea !important; padding: 15px 35px; font-weight: 600; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                            <i class="bi bi-compass me-2"></i>
                            Explore Tours
                        </a>
                        <a href="{{ route('frontsite.contact.index') }}" class="btn-modern" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.4); color: white !important; padding: 15px 35px; font-weight: 600;">
                            <i class="bi bi-telephone me-2"></i>
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-style')
<style>
/* Team Card Hover Effects */
.team-card-modern:hover .team-img-modern img {
    transform: scale(1.1);
}

.team-card-modern:hover .team-social-modern {
    opacity: 1 !important;
}

.team-social-modern a:hover {
    background: #667eea !important;
    color: #fff !important;
}

/* Responsive */
@media (max-width: 768px) {
    .floating-card {
        position: static !important;
        margin-top: 30px;
    }
    
    h2 {
        font-size: 2rem !important;
    }
}
</style>
@endpush

@push('after-script')
<script>
$(document).ready(function() {    
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