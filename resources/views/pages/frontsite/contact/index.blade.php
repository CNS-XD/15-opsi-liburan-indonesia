@extends('layouts.frontsite')

@section('title', 'Contact Us - Opsi Liburan Indonesia')
@section('activeMenuContact', 'active')

@section('content')

<!-- Hero Section -->
<section class="hero-section" style="min-height: 60vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <h1 style="color: white; margin-bottom: 1.5rem; font-size: clamp(2.5rem, 5vw, 3.5rem);">
                        Let's Connect
                    </h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.3rem; margin-bottom: 2rem;">
                        <center>We're here to help you plan your perfect Indonesian adventure</center>
                    </p>
                    
                    <!-- Quick Contact Buttons -->
                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="https://wa.me/6281234698453" target="_blank" class="btn-hero-primary">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            WhatsApp Us
                        </a>
                        <a href="mailto:info@opsiliburan.com" class="btn-hero-secondary">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M22 6L12 13L2 6" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            Send Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Cards Section -->
<section class="section-modern" style="margin-top: -4rem; position: relative; z-index: 10;">
    <div class="container">
        <div class="row g-4">
            <!-- Address Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card-modern text-center" style="padding: 2.5rem 1.5rem; height: 100%;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="white" stroke-width="2"/>
                            <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="white" stroke-width="2"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 1rem; color: var(--neutral-900); font-weight: 700; font-size: 1.25rem;">Visit Us</h4>
                    <p style="color: var(--neutral-600); line-height: 1.6; margin: 0;">{{ $contactGeneral->address ?? 'Jakarta, Indonesia' }}</p>
                </div>
            </div>
            
            <!-- Phone Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card-modern text-center" style="padding: 2.5rem 1.5rem; height: 100%;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(240, 147, 251, 0.3);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 16.92V19.92C22 21.1 21.1 22 19.92 22C9.39 21.48 1.52 13.61 1 3.08C1 1.9 1.9 1 3.08 1H6.08C6.6 1 7.04 1.38 7.1 1.9L7.8 6.53C7.85 6.96 7.67 7.38 7.33 7.64L5.43 9.16C6.86 12.2 9.8 15.14 12.84 16.57L14.36 14.67C14.62 14.33 15.04 14.15 15.47 14.2L20.1 14.9C20.62 14.96 21 15.4 21 15.92V19.92H22Z" stroke="white" stroke-width="2"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 1rem; color: var(--neutral-900); font-weight: 700; font-size: 1.25rem;">Call Us</h4>
                    <p style="color: var(--neutral-600); line-height: 1.6; margin: 0;">{{ $contactGeneral->phone ?? '+62 21 1234 5678' }}</p>
                    <a href="tel:{{ $contactGeneral->phone ?? '+622112345678' }}" class="btn-modern btn-modern-secondary" style="margin-top: 1rem; padding: 0.5rem 1.5rem; font-size: 0.875rem;">Call Now</a>
                </div>
            </div>

            <!-- Email Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card-modern text-center" style="padding: 2.5rem 1.5rem; height: 100%;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="#764ba2" stroke-width="2"/>
                            <path d="M22 6L12 13L2 6" stroke="#764ba2" stroke-width="2"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 1rem; color: var(--neutral-900); font-weight: 700; font-size: 1.25rem;">Email Us</h4>
                    <p style="color: var(--neutral-600); line-height: 1.6; margin: 0; word-break: break-all;">{{ $contactGeneral->email ?? 'info@opsiliburan.com' }}</p>
                    <a href="mailto:{{ $contactGeneral->email ?? 'info@opsiliburan.com' }}" class="btn-modern btn-modern-secondary" style="margin-top: 1rem; padding: 0.5rem 1.5rem; font-size: 0.875rem;">Send Email</a>
                </div>
            </div>
            
            <!-- Working Hours Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card-modern text-center" style="padding: 2.5rem 1.5rem; height: 100%;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2"/>
                            <path d="M12 6V12L16 14" stroke="white" stroke-width="2"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 1rem; color: var(--neutral-900); font-weight: 700; font-size: 1.25rem;">Working Hours</h4>
                    <p style="color: var(--neutral-600); line-height: 1.8; margin: 0;">
                        <strong>Mon - Fri</strong><br>9:00 AM - 6:00 PM<br><br>
                        <strong>Saturday</strong><br>9:00 AM - 2:00 PM
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="section-modern" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
    <div class="container">
        <div class="section-title-modern">
            <h2>Follow Our Journey</h2>
            <p>Stay connected with us on social media for travel inspiration and updates</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-2 col-md-4 col-6">
                <a href="https://facebook.com" target="_blank" class="social-card-modern">
                    <div class="social-icon-modern" style="background: linear-gradient(135deg, #1877f2 0%, #0c63d4 100%);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </div>
                    <span>Facebook</span>
                </a>
            </div>
            
            <div class="col-lg-2 col-md-4 col-6">
                <a href="https://instagram.com" target="_blank" class="social-card-modern">
                    <div class="social-icon-modern" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                    <span>Instagram</span>
                </a>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <a href="https://twitter.com" target="_blank" class="social-card-modern">
                    <div class="social-icon-modern" style="background: linear-gradient(135deg, #1da1f2 0%, #0c85d0 100%);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </div>
                    <span>Twitter</span>
                </a>
            </div>
            
            <div class="col-lg-2 col-md-4 col-6">
                <a href="https://youtube.com" target="_blank" class="social-card-modern">
                    <div class="social-icon-modern" style="background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </div>
                    <span>YouTube</span>
                </a>
            </div>
            
            <div class="col-lg-2 col-md-4 col-6">
                <a href="https://linkedin.com" target="_blank" class="social-card-modern">
                    <div class="social-icon-modern" style="background: linear-gradient(135deg, #0077b5 0%, #005885 100%);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </div>
                    <span>LinkedIn</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('after-style')
<style>
.social-card-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    transition: all var(--transition-base);
}

.social-icon-modern {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-lg);
    transition: all var(--transition-base);
}

.social-card-modern span {
    color: var(--neutral-700);
    font-weight: 600;
    font-size: 0.95rem;
}

.social-card-modern:hover .social-icon-modern {
    transform: translateY(-10px) scale(1.1);
    box-shadow: var(--shadow-xl);
}

.social-card-modern:hover span {
    color: var(--neutral-900);
}
</style>
@endpush
