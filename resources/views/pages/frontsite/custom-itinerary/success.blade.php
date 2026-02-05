@extends('layouts.frontsite')

@section('title', 'Request Submitted Successfully - Opsi Liburan Indonesia')

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-section" style="height: 30px; background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/frontsite-assets/img/innerpages/breadcrumb-bg1.jpg);">  
    <div class="container">
        <div class="banner-content" style="margin-top: -60px;">
            <h1 class="text-white">Request Submitted Successfully</h1>
            <h3 class="text-white">Thank you for choosing Opsi Liburan Indonesia</h3>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Success Section Start -->
<div class="success-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="success-wrapper">
                    <div class="success-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    
                    <div class="success-content">
                        <h2>Your Custom Itinerary Request Has Been Submitted!</h2>
                        <p class="lead">We've received your custom itinerary request and our travel experts will review it shortly.</p>
                        
                        <div class="request-details">
                            <h4>Request Details</h4>
                            <div class="detail-item">
                                <span class="label">Request ID:</span>
                                <span class="value">#{{ str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Customer Name:</span>
                                <span class="value">{{ $customItinerary->customer_name }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Email:</span>
                                <span class="value">{{ $customItinerary->email }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Duration:</span>
                                <span class="value">{{ $customItinerary->duration_days }} Days</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Participants:</span>
                                <span class="value">{{ $customItinerary->participants_adult }} Adults, {{ $customItinerary->participants_child }} Children</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Destinations:</span>
                                <span class="value">
                                    @foreach($customItinerary->destinations as $destination)
                                        {{ $destination->destination->title }}@if(!$loop->last), @endif
                                    @endforeach
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Status:</span>
                                <span class="value status-pending">{{ $customItinerary->status_label }}</span>
                            </div>
                        </div>
                        
                        <div class="next-steps">
                            <h4>What Happens Next?</h4>
                            <div class="steps-timeline">
                                <div class="timeline-item active">
                                    <div class="timeline-icon">1</div>
                                    <div class="timeline-content">
                                        <h5>Request Received</h5>
                                        <p>Your custom itinerary request has been received and logged in our system.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon">2</div>
                                    <div class="timeline-content">
                                        <h5>Expert Review</h5>
                                        <p>Our travel experts will review your requirements and create a personalized itinerary.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon">3</div>
                                    <div class="timeline-content">
                                        <h5>Quote Preparation</h5>
                                        <p>We'll prepare a detailed quote with pricing and send it to your email.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon">4</div>
                                    <div class="timeline-content">
                                        <h5>Confirmation</h5>
                                        <p>Once you approve the quote, we'll confirm your booking and start planning your dream trip.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-info">
                            <h4>Need Help?</h4>
                            <p>If you have any questions about your request, please don't hesitate to contact us:</p>
                            <div class="contact-methods">
                                <div class="contact-method">
                                    <i class="bi bi-envelope"></i>
                                    <span>info@opsiliburan.com</span>
                                </div>
                                <div class="contact-method">
                                    <i class="bi bi-telephone"></i>
                                    <span>+62 123 456 789</span>
                                </div>
                                <div class="contact-method">
                                    <i class="bi bi-whatsapp"></i>
                                    <span>+62 123 456 789</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <a href="{{ route('frontsite.home.index') }}" class="btn btn-primary">Back to Home</a>
                            <a href="{{ route('frontsite.custom-itinerary.show', $customItinerary->id) }}" class="btn btn-outline-primary">View Request Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Success Section End -->

<style>
.success-section {
    padding: 80px 0;
    background-color: #f8f9fa;
}

.success-wrapper {
    background: white;
    border-radius: 15px;
    padding: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    text-align: center;
}

.success-icon {
    margin-bottom: 30px;
}

.success-icon i {
    font-size: 80px;
    color: #28a745;
}

.success-content h2 {
    color: #2c3e50;
    margin-bottom: 20px;
}

.success-content .lead {
    color: #6c757d;
    margin-bottom: 40px;
}

.request-details {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 40px;
    text-align: left;
}

.request-details h4 {
    color: #2c3e50;
    margin-bottom: 20px;
    text-align: center;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #e9ecef;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item .label {
    font-weight: 600;
    color: #495057;
}

.detail-item .value {
    color: #2c3e50;
}

.status-pending {
    background-color: #ffc107;
    color: #212529;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.next-steps {
    margin-bottom: 40px;
    text-align: left;
}

.next-steps h4 {
    color: #2c3e50;
    margin-bottom: 30px;
    text-align: center;
}

.steps-timeline {
    position: relative;
}

.steps-timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #e9ecef;
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 30px;
    position: relative;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 20px;
    position: relative;
    z-index: 2;
}

.timeline-item.active .timeline-icon {
    background-color: #28a745;
    color: white;
}

.timeline-content h5 {
    color: #2c3e50;
    margin-bottom: 8px;
}

.timeline-content p {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 14px;
}

.contact-info {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 40px;
    text-align: left;
}

.contact-info h4 {
    color: #2c3e50;
    margin-bottom: 15px;
    text-align: center;
}

.contact-info p {
    color: #6c757d;
    text-align: center;
    margin-bottom: 20px;
}

.contact-methods {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.contact-method {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #2c3e50;
}

.contact-method i {
    color: #007bff;
    font-size: 18px;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.btn-outline-primary {
    border: 2px solid #007bff;
    color: #007bff;
    background-color: transparent;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
}

@media (max-width: 768px) {
    .success-wrapper {
        padding: 30px 20px;
    }
    
    .success-icon i {
        font-size: 60px;
    }
    
    .request-details, .contact-info {
        padding: 20px;
    }
    
    .detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .contact-methods {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 250px;
    }
}
</style>
@endsection