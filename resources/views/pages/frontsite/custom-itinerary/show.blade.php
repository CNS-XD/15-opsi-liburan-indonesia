@extends('layouts.frontsite')

@section('title', 'Custom Itinerary Request ' . $customItinerary->request_code . ' - Opsi Liburan Indonesia')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 40vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-file-text" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Custom Itinerary Request</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Request {{ $customItinerary->request_code }}</center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Request Details Section Start -->
<div class="request-details-section" style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="request-card">
                    <div class="request-header">
                        <div class="request-info">
                            <h2>Request {{ $customItinerary->request_code }}</h2>
                            <p class="request-date">Submitted on {{ $customItinerary->created_at->format('M d, Y \a\t H:i') }}</p>
                        </div>
                        <div class="request-status">
                            <span class="status-badge status-{{ $customItinerary->status }}">
                                {{ $customItinerary->status_label }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="request-content">
                        <!-- Contact Information -->
                        <div class="info-section">
                            <h3><i class="bi bi-person-circle"></i> Contact Information</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="label">Name:</span>
                                    <span class="value">{{ $customItinerary->customer_name }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Email:</span>
                                    <span class="value">{{ $customItinerary->email }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Phone:</span>
                                    <span class="value">{{ $customItinerary->phone }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Participants:</span>
                                    <span class="value">{{ $customItinerary->total_participants }} People ({{ $customItinerary->participants_adult }} Adults, {{ $customItinerary->participants_child }} Children)</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Trip Details -->
                        <div class="info-section">
                            <h3><i class="bi bi-calendar-event"></i> Trip Details</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="label">Duration:</span>
                                    <span class="value">{{ $customItinerary->duration_days }} Days</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Travel Dates:</span>
                                    <span class="value">{{ $customItinerary->travel_dates }}</span>
                                </div>
                                @if($customItinerary->budget_min || $customItinerary->budget_max)
                                <div class="info-item">
                                    <span class="label">Budget Range:</span>
                                    <span class="value">${{ $customItinerary->budget_range }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Destinations -->
                        <div class="info-section">
                            <h3><i class="bi bi-geo-alt"></i> Selected Destinations</h3>
                            <div class="destinations-list">
                                @foreach($customItinerary->destinations as $destination)
                                    <div class="destination-card">
                                        <div class="destination-info">
                                            <h4>{{ $destination->destination->title }}</h4>
                                            <p>{{ $destination->destination->subtitle ?? 'Beautiful destination in Indonesia' }}</p>
                                        </div>
                                        <div class="destination-order">
                                            <span class="order-number">{{ $destination->sequence_order }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Travel Preferences -->
                        <div class="info-section">
                            <h3><i class="bi bi-gear"></i> Travel Preferences</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="label">Tour Type:</span>
                                    <span class="value">{{ $customItinerary->tour_type_label }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Accommodation:</span>
                                    <span class="value">{{ $customItinerary->accommodation_level_label }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="label">Transportation:</span>
                                    <span class="value">{{ $customItinerary->transportation_type_label }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Activities -->
                        @if($customItinerary->activities->count() > 0)
                        <div class="info-section">
                            <h3><i class="bi bi-activity"></i> Preferred Activities</h3>
                            <div class="activities-list">
                                @foreach($customItinerary->activities as $activity)
                                    <span class="activity-tag">{{ $activity->activity_name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Special Requirements -->
                        @if($customItinerary->special_requirements)
                        <div class="info-section">
                            <h3><i class="bi bi-info-circle"></i> Special Requirements</h3>
                            <div class="special-requirements">
                                <p>{{ $customItinerary->special_requirements }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Status Card -->
                    <div class="status-card">
                        <h4>Request Status</h4>
                        <div class="status-info">
                            <div class="current-status">
                                <span class="status-badge status-{{ $customItinerary->status }}">
                                    {{ $customItinerary->status_label }}
                                </span>
                            </div>
                            <div class="status-description">
                                @switch($customItinerary->status)
                                    @case('pending')
                                        <p>Your request is being reviewed by our travel experts. We'll contact you within 24 hours with a personalized quote.</p>
                                        @break
                                    @case('review')
                                        <p>Our travel experts are currently reviewing your requirements and creating a personalized itinerary for you.</p>
                                        @break
                                    @case('quoted')
                                        <p>We've prepared a custom quote for your trip. Please check your email for details.</p>
                                        @break
                                    @case('confirmed')
                                        <p>Your custom itinerary has been confirmed! We're excited to help you create amazing memories.</p>
                                        @break
                                    @case('cancelled')
                                        <p>This request has been cancelled. If you have any questions, please contact us.</p>
                                        @break
                                    @default
                                        <p>Your request is being processed.</p>
                                @endswitch
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Card -->
                    <div class="contact-card">
                        <h4>Need Help?</h4>
                        <p>Have questions about your request? Our travel experts are here to help!</p>
                        <div class="contact-methods">
                            <a href="mailto:info@opsiliburan.com" class="contact-method">
                                <i class="bi bi-envelope"></i>
                                <span>Send Email</span>
                            </a>
                            <a href="tel:+62123456789" class="contact-method">
                                <i class="bi bi-telephone"></i>
                                <span>Call Us</span>
                            </a>
                            <a href="https://wa.me/62123456789" class="contact-method" target="_blank">
                                <i class="bi bi-whatsapp"></i>
                                <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Actions Card -->
                    <div class="actions-card">
                        <h4>Actions</h4>
                        <div class="action-buttons">
                            <a href="{{ route('frontsite.home.index') }}" class="btn-modern btn-modern-primary">
                                <i class="bi bi-house me-2"></i> Back to Home
                            </a>
                            <a href="{{ route('frontsite.custom-itinerary.index') }}" class="btn-modern btn-modern-secondary">
                                <i class="bi bi-plus-circle me-2"></i> New Request
                            </a>
                        </div>
                    </div>
                    
                    <!-- What Happens Next -->
                    <div class="next-steps-card">
                        <h4><i class="bi bi-list-check"></i> What Happens Next?</h4>
                        
                        @if($customItinerary->status == 'cancelled')
                            <!-- Cancelled Status Message -->
                            <div class="alert alert-danger" style="border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: center; gap: 15px;">
                                    <i class="bi bi-x-circle-fill" style="font-size: 2rem; color: #dc2626;"></i>
                                    <div>
                                        <h5 style="margin: 0 0 5px 0; color: #dc2626; font-weight: 700;">Request Cancelled</h5>
                                        <p style="margin: 0; color: #991b1b;">This custom itinerary request has been cancelled. If you have any questions, please contact our support team.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Show only first step as completed for cancelled -->
                            <div class="steps-timeline">
                                <div class="timeline-step completed">
                                    <div class="step-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Request Received</h5>
                                        <p>Your custom itinerary request was received and logged in our system.</p>
                                    </div>
                                </div>
                                <div class="timeline-step cancelled">
                                    <div class="step-icon">
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Request Cancelled</h5>
                                        <p>This request has been cancelled and will not proceed further.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Normal Timeline -->
                            <div class="steps-timeline">
                                <div class="timeline-step {{ in_array($customItinerary->status, ['pending', 'review', 'quoted', 'confirmed']) ? 'completed' : '' }}">
                                    <div class="step-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Request Received</h5>
                                        <p>Your custom itinerary request has been received and logged in our system.</p>
                                    </div>
                                </div>
                                <div class="timeline-step {{ in_array($customItinerary->status, ['review', 'quoted', 'confirmed']) ? 'completed' : '' }}">
                                    <div class="step-icon">
                                        <i class="bi bi-search"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Expert Review</h5>
                                        <p>Our travel experts will review your requirements and create a personalized itinerary.</p>
                                    </div>
                                </div>
                                <div class="timeline-step {{ in_array($customItinerary->status, ['quoted', 'confirmed']) ? 'completed' : '' }}">
                                    <div class="step-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Quote Preparation</h5>
                                        <p>We'll prepare a detailed quote with pricing and send it to your email.</p>
                                    </div>
                                </div>
                                <div class="timeline-step {{ $customItinerary->status == 'confirmed' ? 'completed' : '' }}">
                                    <div class="step-icon">
                                        <i class="bi bi-check2-square"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Confirmation</h5>
                                        <p>Once you approve the quote, we'll confirm your booking and start planning your dream trip.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Request Details Section End -->

<style>
.request-details-section {
    padding: 80px 0;
    background-color: #f8fafc;
}

.request-card {
    background: white;
    border-radius: 1.5rem;
    padding: 3rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

.request-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 3rem;
    padding-bottom: 1.5rem;
    border-bottom: 3px solid #e2e8f0;
}

.request-info h2 {
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.request-date {
    color: #64748b;
    margin-bottom: 0;
    font-size: 0.95rem;
}

.status-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.status-pending {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
}

.status-review {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
}

.status-quoted {
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    color: white;
}

.status-confirmed {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.status-cancelled {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}

.info-section {
    margin-bottom: 40px;
}

.info-section:last-child {
    margin-bottom: 0;
}

.info-section h3 {
    color: #2c3e50;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-section h3 i {
    color: #007bff;
}

.info-grid {
    display: grid;
    gap: 15px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item .label {
    font-weight: 600;
    color: #495057;
    flex: 0 0 150px;
}

.info-item .value {
    color: #2c3e50;
    flex: 1;
    text-align: right;
}

.destinations-list {
    display: grid;
    gap: 15px;
}

.destination-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #007bff;
}

.destination-info h4 {
    color: #2c3e50;
    margin-bottom: 5px;
}

.destination-info p {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 14px;
}

.order-number {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.activities-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.activity-tag {
    background-color: #e9ecef;
    color: #495057;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
}

.special-requirements {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #ffc107;
}

.special-requirements p {
    margin-bottom: 0;
    color: #2c3e50;
}

.sidebar {
    display: grid;
    gap: 30px;
}

.status-card, .contact-card, .actions-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.status-card h4, .contact-card h4, .actions-card h4 {
    color: #2c3e50;
    margin-bottom: 20px;
}

.current-status {
    text-align: center;
    margin-bottom: 15px;
}

.status-description p {
    color: #6c757d;
    font-size: 14px;
    text-align: center;
    margin-bottom: 0;
}

.contact-card p {
    color: #6c757d;
    margin-bottom: 20px;
}

.contact-methods {
    display: grid;
    gap: 10px;
}

.contact-method {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    color: #2c3e50;
    text-decoration: none;
    transition: all 0.3s ease;
}

.contact-method:hover {
    border-color: #007bff;
    background-color: #f8f9ff;
    color: #007bff;
}

.contact-method i {
    color: #007bff;
    font-size: 18px;
}

.action-buttons {
    display: grid;
    gap: 15px;
}

.btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #007bff;
    border: 2px solid #007bff;
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

.btn-outline-primary:hover {
    background-color: #007bff;
    color: white;
}

.next-steps-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.next-steps-card h4 {
    color: #2c3e50;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.next-steps-card h4 i {
    color: #007bff;
}

.steps-timeline {
    position: relative;
}

.steps-timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 10px;
    bottom: 10px;
    width: 2px;
    background: linear-gradient(180deg, #10b981 0%, #e9ecef 100%);
}

.timeline-step {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
    position: relative;
}

.timeline-step:last-child {
    margin-bottom: 0;
}

.step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #adb5bd;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-right: 15px;
    position: relative;
    z-index: 2;
    flex-shrink: 0;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.timeline-step.completed .step-icon {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.step-content h5 {
    color: #2c3e50;
    margin-bottom: 5px;
    font-size: 15px;
    font-weight: 600;
}

.step-content p {
    color: #6c757d;
    margin-bottom: 0;
    font-size: 13px;
    line-height: 1.5;
}

.timeline-step.completed .step-content h5 {
    color: #10b981;
    font-weight: 700;
}

.timeline-step.cancelled .step-icon {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

.timeline-step.cancelled .step-content h5 {
    color: #dc2626;
    font-weight: 700;
}

.timeline-step.cancelled .step-content p {
    color: #991b1b;
}

@media (max-width: 768px) {
    .request-card {
        padding: 20px;
    }
    
    .request-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .info-item .value {
        text-align: left;
    }
    
    .destination-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .status-card, .contact-card, .actions-card {
        padding: 20px;
    }
}
</style>
@endsection