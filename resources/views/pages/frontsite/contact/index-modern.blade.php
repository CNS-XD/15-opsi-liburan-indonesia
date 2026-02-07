@extends('layouts.frontsite')

@section('title', 'Contact Us - Opsi Liburan Indonesia')
@section('activeMenuContact', 'active')

@section('meta_description', 'Get in touch with Opsi Liburan Indonesia. Contact us for inquiries about tour packages, bookings, or any travel-related questions.')

@section('content')

<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="hero-content animate-fade-in-up">
                    <h1 style="color: white; margin-bottom: 1rem;">Get In Touch</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section-modern bg-white" style="margin-top: -3rem; position: relative; z-index: 10;">
    <div class="container">
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card-modern" style="padding: 2.5rem;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--neutral-900); font-weight: 700;">Send Us a Message</h3>
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #065f46; border-radius: var(--radius-lg); padding: 1rem; margin-bottom: 1.5rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                            <path d="M22 11.08V12C21.9988 14.1564 21.3005 16.2547 20.0093 17.9818C18.7182 19.7088 16.9033 20.9725 14.8354 21.5839C12.7674 22.1953 10.5573 22.1219 8.53447 21.3746C6.51168 20.6273 4.78465 19.2461 3.61096 17.4371C2.43727 15.628 1.87979 13.4881 2.02168 11.3363C2.16356 9.18455 2.99721 7.13631 4.39828 5.49706C5.79935 3.85781 7.69279 2.71537 9.79619 2.24013C11.8996 1.76489 14.1003 1.98232 16.07 2.86" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22 4L12 14.01L9 11.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                    </div>
                    @endif
                    
                    <form action="{{ route('frontsite.contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="name">Full Name *</label>
                                    <input type="text" class="form-control-modern @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your full name">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="email">Email Address *</label>
                                    <input type="email" class="form-control-modern @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="your.email@example.com">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group-modern">
                                    <label for="subject">Subject *</label>
                                    <input type="text" class="form-control-modern @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required placeholder="What is this about?">
                                    @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group-modern">
                                    <label for="message">Message *</label>
                                    <textarea class="form-control-modern @error('message') is-invalid @enderror" id="message" name="message" rows="6" required placeholder="Tell us more about your inquiry...">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-modern btn-modern-primary" style="padding: 1rem 2.5rem;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="col-lg-4">
                <!-- Contact Information Card -->
                <div class="card-modern" style="padding: 2rem; margin-bottom: 1.5rem;">
                    <h4 style="margin-bottom: 1.5rem; color: var(--neutral-900); font-weight: 700;">Contact Information</h4>
                    
                    <div class="contact-info-item-modern">
                        <div class="contact-icon-modern" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="contact-content-modern">
                            <h6>Address</h6>
                            <p>{{ $contactGeneral->address ?? 'Jakarta, Indonesia' }}</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item-modern">
                        <div class="contact-icon-modern" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.18999 12.85C3.49997 10.2412 2.44824 7.27099 2.11999 4.18C2.095 3.90347 2.12787 3.62476 2.21649 3.36162C2.30512 3.09849 2.44756 2.85669 2.63476 2.65162C2.82196 2.44655 3.0498 2.28271 3.30379 2.17052C3.55777 2.05833 3.83233 2.00026 4.10999 2H7.10999C7.5953 1.99522 8.06579 2.16708 8.43376 2.48353C8.80173 2.79999 9.04207 3.23945 9.10999 3.72C9.23662 4.68007 9.47144 5.62273 9.80999 6.53C9.94454 6.88792 9.97366 7.27691 9.8939 7.65088C9.81415 8.02485 9.62886 8.36811 9.35999 8.64L8.08999 9.91C9.51355 12.4135 11.5864 14.4864 14.09 15.91L15.36 14.64C15.6319 14.3711 15.9751 14.1858 16.3491 14.1061C16.7231 14.0263 17.1121 14.0555 17.47 14.19C18.3773 14.5286 19.3199 14.7634 20.28 14.89C20.7658 14.9585 21.2094 15.2032 21.5265 15.5775C21.8437 15.9518 22.0122 16.4296 22 16.92Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="contact-content-modern">
                            <h6>Phone</h6>
                            <p>{{ $contactGeneral->phone ?? '+62 21 1234 5678' }}</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item-modern">
                        <div class="contact-icon-modern" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="#764ba2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 6L12 13L2 6" stroke="#764ba2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="contact-content-modern">
                            <h6>Email</h6>
                            <p>{{ $contactGeneral->email ?? 'info@opsiliburan.com' }}</p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item-modern" style="border-bottom: none;">
                        <div class="contact-icon-modern" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="contact-content-modern">
                            <h6>Working Hours</h6>
                            <p>Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 9:00 AM - 2:00 PM</p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Card -->
                <div class="card-modern" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1.5rem; color: var(--neutral-900); font-weight: 700;">Follow Us</h4>
                    
                    <div class="social-links-modern">
                        <a href="https://facebook.com" target="_blank" class="social-link-modern">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span>Facebook</span>
                        </a>
                        <a href="https://instagram.com" target="_blank" class="social-link-modern">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span>Instagram</span>
                        </a>
                        <a href="https://twitter.com" target="_blank" class="social-link-modern">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            <span>Twitter</span>
                        </a>
                        <a href="https://youtube.com" target="_blank" class="social-link-modern">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span>YouTube</span>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="social-link-modern" style="border-bottom: none;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            <span>LinkedIn</span>
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
/* Form Modern Styles */
.form-group-modern {
    margin-bottom: 1.5rem;
}

.form-group-modern label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--neutral-700);
    font-size: 0.95rem;
}

.form-control-modern {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid var(--neutral-200);
    border-radius: var(--radius-lg);
    font-size: 0.95rem;
    transition: all var(--transition-base);
    background: white;
}

.form-control-modern:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-control-modern.is-invalid {
    border-color: #ef4444;
}

.form-control-modern::placeholder {
    color: var(--neutral-400);
}

textarea.form-control-modern {
    resize: vertical;
    min-height: 150px;
}

/* Contact Info Modern */
.contact-info-item-modern {
    display: flex;
    align-items: flex-start;
    padding-bottom: 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid var(--neutral-200);
}

.contact-icon-modern {
    width: 50px;
    height: 50px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
    box-shadow: var(--shadow-md);
}

.contact-content-modern h6 {
    margin-bottom: 0.25rem;
    color: var(--neutral-900);
    font-weight: 700;
    font-size: 0.95rem;
}

.contact-content-modern p {
    margin: 0;
    color: var(--neutral-600);
    line-height: 1.6;
    font-size: 0.9rem;
}

/* Social Links Modern */
.social-links-modern {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.social-link-modern {
    display: flex;
    align-items: center;
    padding: 1rem 0;
    color: var(--neutral-700);
    text-decoration: none;
    border-bottom: 1px solid var(--neutral-200);
    transition: all var(--transition-base);
    font-weight: 500;
}

.social-link-modern svg {
    margin-right: 0.875rem;
    color: #667eea;
    transition: all var(--transition-base);
}

.social-link-modern:hover {
    color: #667eea;
    transform: translateX(5px);
}

.social-link-modern:hover svg {
    color: #764ba2;
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 991px) {
    .hero-section {
        min-height: 40vh !important;
    }
    
    .card-modern {
        padding: 1.5rem !important;
    }
}
</style>
@endpush
