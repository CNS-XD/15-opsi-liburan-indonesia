@extends('layouts.frontsite')

@section('title', 'Privacy Policy - Travel Indonesia')

@section('meta_description', 'Learn how Travel Indonesia collects, uses, and protects your personal information. Our commitment to your privacy and data security.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Privacy Policy</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Policy Section -->
<div class="privacy-section pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="privacy-content">
                    <div class="section-head">
                        <h2>Privacy Policy</h2>
                        <p class="last-updated">Last updated: {{ date('F d, Y') }}</p>
                    </div>
                    
                    <div class="privacy-text">
                        <h3>1. Introduction</h3>
                        <p>Travel Indonesia ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
                        
                        <h3>2. Information We Collect</h3>
                        <p>We may collect information about you in a variety of ways:</p>
                        
                        <h4>2.1 Personal Data</h4>
                        <p>We may collect personally identifiable information, such as:</p>
                        <ul>
                            <li>Name and contact information (email, phone number, address)</li>
                            <li>Passport and travel document information</li>
                            <li>Payment and billing information</li>
                            <li>Emergency contact information</li>
                            <li>Dietary restrictions and special requirements</li>
                        </ul>
                        
                        <h4>2.2 Usage Data</h4>
                        <p>We may collect information about how you access and use our website, including:</p>
                        <ul>
                            <li>IP address and browser information</li>
                            <li>Pages visited and time spent on our website</li>
                            <li>Search queries and booking preferences</li>
                            <li>Device information and operating system</li>
                        </ul>
                        
                        <h3>3. How We Use Your Information</h3>
                        <p>We use the information we collect to:</p>
                        <ul>
                            <li>Process and manage your bookings</li>
                            <li>Provide customer support and respond to inquiries</li>
                            <li>Send booking confirmations and travel information</li>
                            <li>Improve our website and services</li>
                            <li>Send marketing communications (with your consent)</li>
                            <li>Comply with legal obligations</li>
                        </ul>
                        
                        <h3>4. Information Sharing and Disclosure</h3>
                        <p>We may share your information in the following situations:</p>
                        <ul>
                            <li><strong>Service Providers:</strong> With third-party vendors who provide services on our behalf (hotels, transportation, activities)</li>
                            <li><strong>Legal Requirements:</strong> When required by law or to protect our rights and safety</li>
                            <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
                            <li><strong>Consent:</strong> With your explicit consent for specific purposes</li>
                        </ul>
                        
                        <h3>5. Data Security</h3>
                        <p>We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.</p>
                        
                        <h3>6. Data Retention</h3>
                        <p>We retain your personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law.</p>
                        
                        <h3>7. Your Rights</h3>
                        <p>Depending on your location, you may have the following rights regarding your personal information:</p>
                        <ul>
                            <li>Access to your personal data</li>
                            <li>Correction of inaccurate data</li>
                            <li>Deletion of your data</li>
                            <li>Restriction of processing</li>
                            <li>Data portability</li>
                            <li>Objection to processing</li>
                        </ul>
                        
                        <h3>8. Cookies and Tracking Technologies</h3>
                        <p>We use cookies and similar tracking technologies to enhance your browsing experience, analyze website traffic, and personalize content. You can control cookie settings through your browser preferences.</p>
                        
                        <h3>9. Third-Party Links</h3>
                        <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites. We encourage you to review their privacy policies.</p>
                        
                        <h3>10. Children's Privacy</h3>
                        <p>Our services are not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If you believe we have collected information from a child under 13, please contact us immediately.</p>
                        
                        <h3>11. International Data Transfers</h3>
                        <p>Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place to protect your data during international transfers.</p>
                        
                        <h3>12. Changes to This Privacy Policy</h3>
                        <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date.</p>
                        
                        <h3>13. Contact Us</h3>
                        <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                        <ul>
                            <li>Email: privacy@travelindonesia.com</li>
                            <li>Phone: +62 21 1234 5678</li>
                            <li>Address: Jakarta, Indonesia</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
.privacy-content {
    background-color: #fff;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.last-updated {
    color: #666;
    font-style: italic;
    margin-bottom: 30px;
}

.privacy-text h3 {
    color: #333;
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 600;
}

.privacy-text h4 {
    color: #444;
    margin-top: 20px;
    margin-bottom: 10px;
    font-weight: 600;
    font-size: 1.1rem;
}

.privacy-text p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 15px;
}

.privacy-text ul {
    margin: 15px 0;
    padding-left: 20px;
}

.privacy-text li {
    color: #555;
    line-height: 1.6;
    margin-bottom: 8px;
}

.privacy-text strong {
    color: #333;
    font-weight: 600;
}

@media (max-width: 768px) {
    .privacy-content {
        padding: 30px 20px;
    }
}
</style>
@endpush