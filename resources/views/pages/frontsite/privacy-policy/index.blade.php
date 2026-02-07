@extends('layouts.frontsite')

@section('title', 'Privacy Policy - Travel Indonesia')

@section('meta_description', 'Learn how Travel Indonesia collects, uses, and protects your personal information. Our commitment to your privacy and data security.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-shield-lock" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Privacy Policy</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Your privacy and data security are our top priorities</center>
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
                                    <i class="bi bi-shield-lock"></i> Privacy Policy
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Privacy Policy Section -->
<div class="privacy-section" style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="privacy-content">
                    <div class="section-head text-center mb-5">
                        <h2 style="color: #1e293b; font-weight: 700; margin-bottom: 1rem;">Privacy Policy</h2>
                        <p class="last-updated" style="color: #64748b; font-style: italic; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <i class="bi bi-calendar-check"></i> Last updated: {{ date('F d, Y') }}
                        </p>
                    </div>
                    
                    <div class="privacy-text">
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>1. Introduction</h3>
                                <p>Travel Indonesia ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-collection"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>2. Information We Collect</h3>
                                <p>We may collect information about you in a variety of ways:</p>
                                
                                <h4><i class="bi bi-person-badge"></i> 2.1 Personal Data</h4>
                                <p>We may collect personally identifiable information, such as:</p>
                                <ul>
                                    <li><i class="bi bi-arrow-right-short"></i> Name and contact information (email, phone number, address)</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Passport and travel document information</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Payment and billing information</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Emergency contact information</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Dietary restrictions and special requirements</li>
                                </ul>
                                
                                <h4><i class="bi bi-graph-up"></i> 2.2 Usage Data</h4>
                                <p>We may collect information about how you access and use our website, including:</p>
                                <ul>
                                    <li><i class="bi bi-arrow-right-short"></i> IP address and browser information</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Pages visited and time spent on our website</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Search queries and booking preferences</li>
                                    <li><i class="bi bi-arrow-right-short"></i> Device information and operating system</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-gear"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>3. How We Use Your Information</h3>
                                <p>We use the information we collect to:</p>
                                <ul>
                                    <li><i class="bi bi-check-circle"></i> Process and manage your bookings</li>
                                    <li><i class="bi bi-check-circle"></i> Provide customer support and respond to inquiries</li>
                                    <li><i class="bi bi-check-circle"></i> Send booking confirmations and travel information</li>
                                    <li><i class="bi bi-check-circle"></i> Improve our website and services</li>
                                    <li><i class="bi bi-check-circle"></i> Send marketing communications (with your consent)</li>
                                    <li><i class="bi bi-check-circle"></i> Comply with legal obligations</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-share"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>4. Information Sharing and Disclosure</h3>
                                <p>We may share your information in the following situations:</p>
                                <ul>
                                    <li><i class="bi bi-people"></i> <strong>Service Providers:</strong> With third-party vendors who provide services on our behalf (hotels, transportation, activities)</li>
                                    <li><i class="bi bi-file-earmark-text"></i> <strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li>
                                    <li><i class="bi bi-building"></i> <strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
                                    <li><i class="bi bi-hand-thumbs-up"></i> <strong>Consent:</strong> With your explicit consent for specific purposes</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>5. Data Security</h3>
                                <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>6. Data Retention</h3>
                                <p>We retain your personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>7. Your Rights</h3>
                                <p>Depending on your location, you may have the following rights regarding your personal information:</p>
                                <ul>
                                    <li><i class="bi bi-eye"></i> Access to your personal data</li>
                                    <li><i class="bi bi-pencil"></i> Correction of inaccurate data</li>
                                    <li><i class="bi bi-trash"></i> Deletion of your data</li>
                                    <li><i class="bi bi-pause-circle"></i> Restriction of processing</li>
                                    <li><i class="bi bi-arrow-left-right"></i> Data portability</li>
                                    <li><i class="bi bi-x-circle"></i> Objection to processing</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-cookie"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>8. Cookies and Tracking Technologies</h3>
                                <p>We use cookies and similar tracking technologies to enhance your browsing experience, analyze website traffic, and personalize content. You can control cookie settings through your browser preferences.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-link-45deg"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>9. Third-Party Links</h3>
                                <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites. We encourage you to review their privacy policies.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-emoji-smile"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>10. Children's Privacy</h3>
                                <p>Our services are not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If you believe we have collected information from a child under 13, please contact us immediately.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-globe"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>11. International Data Transfers</h3>
                                <p>Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place to protect your data during international transfers.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>12. Changes to This Privacy Policy</h3>
                                <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date.</p>
                            </div>
                        </div>
                        
                        <div class="privacy-item">
                            <div class="privacy-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="privacy-body">
                                <h3>13. Contact Us</h3>
                                <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                                <ul>
                                    <li><i class="bi bi-envelope-fill"></i> Email: privacy@travelindonesia.com</li>
                                    <li><i class="bi bi-telephone-fill"></i> Phone: +62 21 1234 5678</li>
                                    <li><i class="bi bi-geo-alt-fill"></i> Address: Jakarta, Indonesia</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CTA Section -->
                    <div class="privacy-cta text-center mt-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem 2rem; border-radius: 1rem; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);">
                        <div style="max-width: 600px; margin: 0 auto;">
                            <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-question-circle" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h4 style="color: white; font-weight: 700; margin-bottom: 1rem; font-size: 1.8rem;">Questions About Your Privacy?</h4>
                            <p style="color: rgba(255, 255, 255, 0.95); margin-bottom: 2rem; font-size: 1.1rem;">If you have concerns about how we handle your data or want to exercise your privacy rights, we're here to help!</p>
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

/* Privacy Content */
.privacy-content {
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

/* Privacy Items */
.privacy-item {
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

.privacy-item:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.15);
    background: #f1f5f9;
}

.privacy-icon {
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

.privacy-icon i {
    font-size: 1.8rem;
    color: white;
}

.privacy-body {
    flex: 1;
}

.privacy-body h3 {
    color: #1e293b;
    margin-bottom: 1rem;
    font-weight: 700;
    font-size: 1.4rem;
}

.privacy-body h4 {
    color: #334155;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    font-weight: 600;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.privacy-body h4 i {
    color: #667eea;
    font-size: 1.2rem;
}

.privacy-body p {
    color: #475569;
    line-height: 1.8;
    margin-bottom: 1rem;
    font-size: 1rem;
}

.privacy-body ul {
    margin: 1rem 0 0 0;
    padding-left: 0;
    list-style: none;
}

.privacy-body li {
    color: #475569;
    line-height: 1.8;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.privacy-body li i {
    color: #667eea;
    font-size: 1.2rem;
    margin-top: 0.2rem;
    flex-shrink: 0;
}

.privacy-body strong {
    color: #1e293b;
    font-weight: 600;
}

/* CTA Section */
.privacy-cta .btn-modern:hover {
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

/* Stagger animation for privacy items */
.privacy-item:nth-child(1) { animation-delay: 0.1s; }
.privacy-item:nth-child(2) { animation-delay: 0.15s; }
.privacy-item:nth-child(3) { animation-delay: 0.2s; }
.privacy-item:nth-child(4) { animation-delay: 0.25s; }
.privacy-item:nth-child(5) { animation-delay: 0.3s; }
.privacy-item:nth-child(6) { animation-delay: 0.35s; }
.privacy-item:nth-child(7) { animation-delay: 0.4s; }
.privacy-item:nth-child(8) { animation-delay: 0.45s; }
.privacy-item:nth-child(9) { animation-delay: 0.5s; }
.privacy-item:nth-child(10) { animation-delay: 0.55s; }
.privacy-item:nth-child(11) { animation-delay: 0.6s; }
.privacy-item:nth-child(12) { animation-delay: 0.65s; }
.privacy-item:nth-child(13) { animation-delay: 0.7s; }

/* Responsive */
@media (max-width: 768px) {
    .hero-section {
        min-height: 40vh !important;
    }
    
    .privacy-content {
        padding: 2rem 1.5rem;
    }
    
    .section-head h2 {
        font-size: 2rem;
    }
    
    .privacy-item {
        flex-direction: column;
        gap: 1rem;
        padding: 1.5rem;
    }
    
    .privacy-icon {
        width: 50px;
        height: 50px;
    }
    
    .privacy-icon i {
        font-size: 1.5rem;
    }
    
    .privacy-body h3 {
        font-size: 1.2rem;
    }
    
    .privacy-body h4 {
        font-size: 1rem;
    }
    
    .privacy-cta {
        padding: 2rem 1.5rem !important;
    }
    
    .privacy-cta h4 {
        font-size: 1.5rem !important;
    }
}
</style>
@endpush