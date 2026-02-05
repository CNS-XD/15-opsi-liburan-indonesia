@extends('layouts.frontsite')

@section('title', 'Contact Us - Travel Indonesia')

@section('meta_description', 'Get in touch with Travel Indonesia. Contact us for inquiries about tour packages, bookings, or any travel-related questions.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Contact Us</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <h2>Get In Touch</h2>
                    <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="contact-form">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <form action="{{ route('frontsite.contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subject">Subject *</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message">Message *</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <div class="contact-info-card">
                        <h4>Contact Information</h4>
                        <div class="contact-info-list">
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="contact-content">
                                    <h6>Address</h6>
                                    <p>{{ $contactGeneral->address ?? 'Jakarta, Indonesia' }}</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="contact-content">
                                    <h6>Phone</h6>
                                    <p>{{ $contactGeneral->phone ?? '+62 21 1234 5678' }}</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="contact-content">
                                    <h6>Email</h6>
                                    <p>{{ $contactGeneral->email ?? 'info@travelindonesia.com' }}</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="contact-content">
                                    <h6>Working Hours</h6>
                                    <p>Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 9:00 AM - 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-media-card" style="background: #f8f9fa !important; min-height: 200px !important;">
                        <h4 style="color: #007bff !important; font-size: 18px !important;">Follow Us</h4>
                        <div class="social-media-links" style="display: block !important;">
                            <a href="https://facebook.com" target="_blank" class="social-link" style="display: flex !important; padding: 10px 0 !important; color: #333 !important; text-decoration: none !important;">
                                <i class="bi bi-facebook" style="margin-right: 10px !important; color: #007bff !important;"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="https://instagram.com" target="_blank" class="social-link" style="display: flex !important; padding: 10px 0 !important; color: #333 !important; text-decoration: none !important;">
                                <i class="bi bi-instagram" style="margin-right: 10px !important; color: #007bff !important;"></i>
                                <span>Instagram</span>
                            </a>
                            <a href="https://twitter.com" target="_blank" class="social-link" style="display: flex !important; padding: 10px 0 !important; color: #333 !important; text-decoration: none !important;">
                                <i class="bi bi-twitter" style="margin-right: 10px !important; color: #007bff !important;"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="https://youtube.com" target="_blank" class="social-link" style="display: flex !important; padding: 10px 0 !important; color: #333 !important; text-decoration: none !important;">
                                <i class="bi bi-youtube" style="margin-right: 10px !important; color: #007bff !important;"></i>
                                <span>YouTube</span>
                            </a>
                            <a href="https://linkedin.com" target="_blank" class="social-link" style="display: flex !important; padding: 10px 0 !important; color: #333 !important; text-decoration: none !important;">
                                <i class="bi bi-linkedin" style="margin-right: 10px !important; color: #007bff !important;"></i>
                                <span>LinkedIn</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
.contact-form {
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.contact-info-card, .social-media-card {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.contact-info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
}

.contact-icon {
    width: 50px;
    height: 50px;
    background-color: #007bff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.contact-icon i {
    color: #fff;
    font-size: 18px;
}

.contact-content h6 {
    margin-bottom: 5px;
    color: #333;
    font-weight: 600;
}

.contact-content p {
    margin: 0;
    color: #666;
    line-height: 1.6;
}

.social-link {
    display: flex;
    align-items: center;
    padding: 12px 0;
    color: #333;
    text-decoration: none;
    border-bottom: 1px solid #eee;
    transition: all 0.3s ease;
}

.social-link:last-child {
    border-bottom: none;
}

.social-link i {
    margin-right: 12px;
    font-size: 18px;
    color: #007bff;
    width: 20px;
    text-align: center;
}

.social-link:hover {
    color: #007bff;
    transform: translateX(5px);
}

.social-link:hover i {
    color: #0056b3;
}

.social-media-card {
    background-color: #fff !important;
    padding: 30px !important;
    border-radius: 10px !important;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
    margin-bottom: 30px !important;
}

.social-media-card h4 {
    margin-bottom: 20px !important;
    color: #333 !important;
    font-weight: 600 !important;
}

.social-media-links {
    display: block !important;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 12px 15px;
    font-size: 14px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
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