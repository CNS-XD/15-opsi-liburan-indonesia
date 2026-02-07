@extends('layouts.frontsite')

@section('title', 'Terms & Conditions - Travel Indonesia')

@section('meta_description', 'Read our terms and conditions for booking tour packages with Travel Indonesia. Important information about our services and policies.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-file-text" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Terms & Conditions</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Important information about our services and policies</center>
                    </p>
                    <div style="margin-top: 2rem;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center" style="background: transparent; margin: 0; padding: 0;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('frontsite.home.index') }}" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                                        <i class="bi bi-house-door"></i> Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" style="color: white; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="bi bi-file-text"></i> Terms & Conditions
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Terms & Conditions Section -->
<div class="terms-section" style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="terms-content">
                    <div class="section-head text-center mb-5">
                        <h2 style="color: #1e293b; font-weight: 700; margin-bottom: 1rem;">Terms & Conditions</h2>
                        <p class="last-updated" style="color: #64748b; font-style: italic; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <i class="bi bi-calendar-check"></i> Last updated: {{ date('F d, Y') }}
                        </p>
                    </div>
                    
                    <div class="terms-text">
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="terms-body">
                                <h3>1. Acceptance of Terms</h3>
                                <p>By accessing and using Travel Indonesia's services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <div class="terms-body">
                                <h3>2. Booking and Payment</h3>
                                <p>All bookings are subject to availability and confirmation. Payment must be made in full at the time of booking unless otherwise specified. We accept various payment methods including credit cards, bank transfers, and digital payments.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="terms-body">
                                <h3>3. Cancellation Policy</h3>
                                <p>Cancellation policies vary depending on the tour package and timing of cancellation:</p>
                                <ul>
                                    <li><i class="bi bi-arrow-right-short"></i> Cancellations made 30+ days before departure: 10% cancellation fee</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Cancellations made 15-29 days before departure: 25% cancellation fee</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Cancellations made 7-14 days before departure: 50% cancellation fee</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Cancellations made less than 7 days before departure: 100% cancellation fee</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-passport"></i>
                            </div>
                            <div class="terms-body">
                                <h3>4. Travel Documents</h3>
                                <p>It is the responsibility of the traveler to ensure they have valid travel documents including passport, visa (if required), and any necessary health certificates. Travel Indonesia is not responsible for any issues arising from invalid or missing travel documents.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <div class="terms-body">
                                <h3>5. Health and Safety</h3>
                                <p>Travelers are responsible for ensuring they are physically fit for the activities included in their chosen tour. We recommend consulting with a healthcare provider before traveling, especially for adventure tours or travel to remote areas.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="terms-body">
                                <h3>6. Travel Insurance</h3>
                                <p>We strongly recommend that all travelers purchase comprehensive travel insurance to cover medical expenses, trip cancellation, lost luggage, and other unforeseen circumstances.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="terms-body">
                                <h3>7. Liability</h3>
                                <p>Travel Indonesia acts as an agent for various service providers including hotels, transportation companies, and activity operators. We are not liable for any loss, damage, injury, or inconvenience caused by these third-party providers.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-cloud-lightning"></i>
                            </div>
                            <div class="terms-body">
                                <h3>8. Force Majeure</h3>
                                <p>Travel Indonesia is not liable for any failure to perform its obligations due to circumstances beyond our reasonable control, including but not limited to natural disasters, government actions, strikes, or other force majeure events.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <div class="terms-body">
                                <h3>9. Modifications to Tours</h3>
                                <p>We reserve the right to modify tour itineraries due to weather conditions, safety concerns, or other circumstances beyond our control. We will make every effort to provide suitable alternatives.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <div class="terms-body">
                                <h3>10. Complaints and Disputes</h3>
                                <p>Any complaints should be reported to our customer service team as soon as possible. We are committed to resolving issues fairly and promptly. Any disputes will be governed by Indonesian law.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-lock"></i>
                            </div>
                            <div class="terms-body">
                                <h3>11. Privacy Policy</h3>
                                <p>Your privacy is important to us. Please review our Privacy Policy to understand how we collect, use, and protect your personal information.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <div class="terms-body">
                                <h3>12. Changes to Terms</h3>
                                <p>We reserve the right to modify these terms and conditions at any time. Changes will be posted on our website and will be effective immediately upon posting.</p>
                            </div>
                        </div>
                        
                        <div class="terms-item">
                            <div class="terms-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="terms-body">
                                <h3>13. Contact Information</h3>
                                <p>If you have any questions about these Terms & Conditions, please contact us:</p>
                                <ul>
                                    <li><i class="bi bi-envelope-fill"></i> Email: info@travelindonesia.com</li>
                                    <li><i class="bi bi-telephone-fill"></i> Phone: +62 21 1234 5678</li>
                                    <li><i class="bi bi-geo-alt-fill"></i> Address: Jakarta, Indonesia</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CTA Section -->
                    <div class="terms-cta text-center mt-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem 2rem; border-radius: 1rem; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);">
                        <div style="max-width: 600px; margin: 0 auto;">
                            <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-question-circle" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h4 style="color: white; font-weight: 700; margin-bottom: 1rem; font-size: 1.8rem;">Have Questions?</h4>
                            <p style="color: rgba(255, 255, 255, 0.95); margin-bottom: 2rem; font-size: 1.1rem;">If you need clarification on any of our terms and conditions, our team is here to help!</p>
                            <a href="{{ route('frontsite.contact.index') }}" class="btn-modern" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 2.5rem; text-decoration: none; background: white; color: #667eea; border-radius: 50px; font-weight: 600; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">
                                <i class="bi bi-chat-dots"></i> Contact Us
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

/* Breadcrumb Styling */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.2rem;
    padding: 0 0.5rem;
}

.breadcrumb-item a:hover {
    color: white !important;
    text-decoration: underline;
}

/* Terms Content */
.terms-content {
    background-color: #fff;
    padding: 3rem;
    border-radius: 1.5rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

.section-head h2 {
    font-size: 2.5rem;
}

.last-updated {
    font-size: 1rem;
}

/* Terms Items */
.terms-item {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
    padding: 2rem;
    background: #f8fafc;
    border-radius: 1rem;
    border-left: 4px solid #667eea;
    transition: all 0.3s ease;
    animation: fadeIn 0.5s ease-out;
}

.terms-item:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.15);
    background: #f1f5f9;
}

.terms-icon {
    flex-shrink: 0;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.terms-icon i {
    font-size: 1.8rem;
    color: white;
}

.terms-body {
    flex: 1;
}

.terms-body h3 {
    color: #1e293b;
    margin-bottom: 1rem;
    font-weight: 700;
    font-size: 1.4rem;
}

.terms-body p {
    color: #475569;
    line-height: 1.8;
    margin-bottom: 0;
    font-size: 1rem;
}

.terms-body ul {
    margin: 1rem 0 0 0;
    padding-left: 0;
    list-style: none;
}

.terms-body li {
    color: #475569;
    line-height: 1.8;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.terms-body li i {
    color: #667eea;
    font-size: 1.2rem;
    margin-top: 0.2rem;
    flex-shrink: 0;
}

/* CTA Section */
.terms-cta .btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    background: #f8fafc;
}

/* Animations */
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

/* Stagger animation for terms items */
.terms-item:nth-child(1) { animation-delay: 0.1s; }
.terms-item:nth-child(2) { animation-delay: 0.15s; }
.terms-item:nth-child(3) { animation-delay: 0.2s; }
.terms-item:nth-child(4) { animation-delay: 0.25s; }
.terms-item:nth-child(5) { animation-delay: 0.3s; }
.terms-item:nth-child(6) { animation-delay: 0.35s; }
.terms-item:nth-child(7) { animation-delay: 0.4s; }
.terms-item:nth-child(8) { animation-delay: 0.45s; }
.terms-item:nth-child(9) { animation-delay: 0.5s; }
.terms-item:nth-child(10) { animation-delay: 0.55s; }
.terms-item:nth-child(11) { animation-delay: 0.6s; }
.terms-item:nth-child(12) { animation-delay: 0.65s; }
.terms-item:nth-child(13) { animation-delay: 0.7s; }

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        min-height: 40vh !important;
    }
    
    .terms-content {
        padding: 2rem 1.5rem;
    }
    
    .section-head h2 {
        font-size: 2rem;
    }
    
    .terms-item {
        flex-direction: column;
        gap: 1rem;
        padding: 1.5rem;
    }
    
    .terms-icon {
        width: 50px;
        height: 50px;
    }
    
    .terms-icon i {
        font-size: 1.5rem;
    }
    
    .terms-body h3 {
        font-size: 1.2rem;
    }
    
    .terms-cta {
        padding: 2rem 1.5rem !important;
    }
    
    .terms-cta h4 {
        font-size: 1.5rem !important;
    }
}
</style>
@endpush