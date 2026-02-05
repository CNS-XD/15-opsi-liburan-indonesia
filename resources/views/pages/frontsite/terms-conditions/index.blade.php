@extends('layouts.frontsite')

@section('title', 'Terms & Conditions - Travel Indonesia')

@section('meta_description', 'Read our terms and conditions for booking tour packages with Travel Indonesia. Important information about our services and policies.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Terms & Conditions</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>Terms & Conditions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Terms & Conditions Section -->
<div class="terms-section pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="terms-content">
                    <div class="section-head">
                        <h2>Terms & Conditions</h2>
                        <p class="last-updated">Last updated: {{ date('F d, Y') }}</p>
                    </div>
                    
                    <div class="terms-text">
                        <h3>1. Acceptance of Terms</h3>
                        <p>By accessing and using Travel Indonesia's services, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
                        
                        <h3>2. Booking and Payment</h3>
                        <p>All bookings are subject to availability and confirmation. Payment must be made in full at the time of booking unless otherwise specified. We accept various payment methods including credit cards, bank transfers, and digital payments.</p>
                        
                        <h3>3. Cancellation Policy</h3>
                        <p>Cancellation policies vary depending on the tour package and timing of cancellation:</p>
                        <ul>
                            <li>Cancellations made 30+ days before departure: 10% cancellation fee</li>
                            <li>Cancellations made 15-29 days before departure: 25% cancellation fee</li>
                            <li>Cancellations made 7-14 days before departure: 50% cancellation fee</li>
                            <li>Cancellations made less than 7 days before departure: 100% cancellation fee</li>
                        </ul>
                        
                        <h3>4. Travel Documents</h3>
                        <p>It is the responsibility of the traveler to ensure they have valid travel documents including passport, visa (if required), and any necessary health certificates. Travel Indonesia is not responsible for any issues arising from invalid or missing travel documents.</p>
                        
                        <h3>5. Health and Safety</h3>
                        <p>Travelers are responsible for ensuring they are physically fit for the activities included in their chosen tour. We recommend consulting with a healthcare provider before traveling, especially for adventure tours or travel to remote areas.</p>
                        
                        <h3>6. Travel Insurance</h3>
                        <p>We strongly recommend that all travelers purchase comprehensive travel insurance to cover medical expenses, trip cancellation, lost luggage, and other unforeseen circumstances.</p>
                        
                        <h3>7. Liability</h3>
                        <p>Travel Indonesia acts as an agent for various service providers including hotels, transportation companies, and activity operators. We are not liable for any loss, damage, injury, or inconvenience caused by these third-party providers.</p>
                        
                        <h3>8. Force Majeure</h3>
                        <p>Travel Indonesia is not liable for any failure to perform its obligations due to circumstances beyond our reasonable control, including but not limited to natural disasters, government actions, strikes, or other force majeure events.</p>
                        
                        <h3>9. Modifications to Tours</h3>
                        <p>We reserve the right to modify tour itineraries due to weather conditions, safety concerns, or other circumstances beyond our control. We will make every effort to provide suitable alternatives.</p>
                        
                        <h3>10. Complaints and Disputes</h3>
                        <p>Any complaints should be reported to our customer service team as soon as possible. We are committed to resolving issues fairly and promptly. Any disputes will be governed by Indonesian law.</p>
                        
                        <h3>11. Privacy Policy</h3>
                        <p>Your privacy is important to us. Please review our Privacy Policy to understand how we collect, use, and protect your personal information.</p>
                        
                        <h3>12. Changes to Terms</h3>
                        <p>We reserve the right to modify these terms and conditions at any time. Changes will be posted on our website and will be effective immediately upon posting.</p>
                        
                        <h3>13. Contact Information</h3>
                        <p>If you have any questions about these Terms & Conditions, please contact us:</p>
                        <ul>
                            <li>Email: info@travelindonesia.com</li>
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
.terms-content {
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

.terms-text h3 {
    color: #333;
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 600;
}

.terms-text p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 15px;
}

.terms-text ul {
    margin: 15px 0;
    padding-left: 20px;
}

.terms-text li {
    color: #555;
    line-height: 1.6;
    margin-bottom: 8px;
}

@media (max-width: 768px) {
    .terms-content {
        padding: 30px 20px;
    }
}
</style>
@endpush