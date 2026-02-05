@extends('layouts.frontsite')

@section('title', 'Custom Itinerary Request #' . str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) . ' - Opsi Liburan Indonesia')

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-section" style="height: 30px; background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/frontsite-assets/img/innerpages/breadcrumb-bg1.jpg);">  
    <div class="container">
        <div class="banner-content" style="margin-top: -60px;">
            <h1 class="text-white">Custom Itinerary Request</h1>
            <h3 class="text-white">Request #{{ str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) }}</h3>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Request Details Section Start -->
<div class="request-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="request-card">
                    <div class="request-header">
                        <div class="request-info">
                            <h2>Request #{{ str_pad($customItinerary->id, 6, '0', STR_PAD_LEFT) }}</h2>
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
                            <a href="{{ route('frontsite.home.index') }}" class="btn btn-primary">
                                <i class="bi bi-house"></i> Back to Home
                            </a>
                            <a href="{{ route('frontsite.custom-itinerary.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-plus-circle"></i> New Request
                            </a>
                        </div>
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
    background-color: #f8f9fa;
}

.request-card {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.request-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e9ecef;
}

.request-info h2 {
    color: #2c3e50;
    margin-bottom: 5px;
}

.request-date {
    color: #6c757d;
    margin-bottom: 0;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-pending {
    background-color: #ffc107;
    color: #212529;
}

.status-quoted {
    background-color: #17a2b8;
    color: white;
}

.status-confirmed {
    background-color: #28a745;
    color: white;
}

.status-cancelled {
    background-color: #dc3545;
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