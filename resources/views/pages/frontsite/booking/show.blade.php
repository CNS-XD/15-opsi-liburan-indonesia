@extends('layouts.frontsite')

@section('title', 'Booking Details | Opsi Liburan Indonesia')

@section('content')
<div class="booking-details-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="booking-details-card">
                    <!-- Header -->
                    <div class="booking-header text-center mb-4">
                        <h1 class="display-5 fw-bold mb-3">Booking Details</h1>
                        <div class="booking-code-wrapper">
                            <p class="text-muted mb-2">Booking Code</p>
                            <h4 class="text-primary fw-bold">{{ $booking->booking_code }}</h4>
                        </div>
                        
                        <!-- Status Badge -->
                        <div class="status-badge mt-3">
                            <span class="badge {{ str_replace('badge-', 'bg-', $booking->status_badge_class) }} px-4 py-2 fs-6">
                                {{ $booking->status_label }}
                            </span>
                        </div>
                    </div>

                    <!-- Booking Information -->
                    <div class="booking-info my-5">
                        <div class="row g-4">
                            <!-- Tour Information -->
                            <div class="col-lg-6">
                                <div class="info-card h-100">
                                    <div class="info-card-header">
                                        <i class="fas fa-map-marked-alt me-2"></i>
                                        <h5 class="mb-0">Tour Information</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <div class="info-item">
                                            <label>Tour Name</label>
                                            <p>{{ $booking->tour->title }}</p>
                                        </div>
                                        <div class="info-item">
                                            <label>Duration</label>
                                            <p>{{ $booking->tour->time_tour }}</p>
                                        </div>
                                        <div class="info-item">
                                            <label>Tour Type</label>
                                            <p>{{ $booking->tour->type_tour == 0 ? 'Private Tour' : 'Sharing Tour' }}</p>
                                        </div>
                                        <div class="info-item mb-0">
                                            <label>Price per Person</label>
                                            <p class="price-highlight">${{ number_format($booking->tour->price, 0) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Information -->
                            <div class="col-lg-6">
                                <div class="info-card h-100">
                                    <div class="info-card-header">
                                        <i class="fas fa-user me-2"></i>
                                        <h5 class="mb-0">Customer Information</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <div class="info-item">
                                            <label>Full Name</label>
                                            <p>{{ $booking->name }}</p>
                                        </div>
                                        <div class="info-item">
                                            <label>Email Address</label>
                                            <p>{{ $booking->email }}</p>
                                        </div>
                                        <div class="info-item">
                                            <label>Phone Number</label>
                                            <p>{{ $booking->phone }}</p>
                                        </div>
                                        <div class="info-item mb-0">
                                            <label>Booking Date</label>
                                            <p>{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Trip Details -->
                            <div class="col-lg-6">
                                <div class="info-card h-100">
                                    <div class="info-card-header">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        <h5 class="mb-0">Trip Details</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <div class="info-item">
                                            <label>Number of Travelers</label>
                                            <p>{{ $booking->travelers }} person(s)</p>
                                        </div>
                                        <div class="info-item">
                                            <label>Preferred Date</label>
                                            <p>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}</p>
                                        </div>
                                        @if($booking->special_requests)
                                        <div class="info-item mb-0">
                                            <label>Special Requests</label>
                                            <p>{{ $booking->special_requests }}</p>
                                        </div>
                                        @else
                                        <div class="info-item mb-0">
                                            <label>Special Requests</label>
                                            <p class="text-muted">No special requests</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Summary -->
                            <div class="col-lg-6">
                                <div class="info-card h-100 payment-summary-card">
                                    <div class="info-card-header">
                                        <i class="fas fa-receipt me-2"></i>
                                        <h5 class="mb-0">Payment Summary</h5>
                                    </div>
                                    <div class="info-card-body">
                                        <div class="payment-breakdown">
                                            <div class="breakdown-item">
                                                <span>Price per person</span>
                                                <span>${{ number_format($booking->tour->price, 0) }}</span>
                                            </div>
                                            <div class="breakdown-item">
                                                <span>Number of travelers</span>
                                                <span>× {{ $booking->travelers }}</span>
                                            </div>
                                            <div class="breakdown-divider"></div>
                                            <div class="breakdown-total">
                                                <span>Total Amount</span>
                                                <span>${{ number_format($booking->total_price, 0) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Information -->
                    <div class="status-info-section mb-4">
                        <div class="info-card">
                            <div class="info-card-header">
                                <i class="fas fa-info-circle me-2"></i>
                                <h5 class="mb-0">Booking Status</h5>
                            </div>
                            <div class="info-card-body">
                                @if($booking->status == \App\Models\Booking::STATUS_PENDING)
                                    <div class="alert alert-warning mb-0">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-clock fs-4 me-3 mt-1"></i>
                                            <div>
                                                <h6 class="alert-heading fw-bold mb-2">{{ $booking->status_label }}</h6>
                                                <p class="mb-0">Your booking is currently being processed. Our team will contact you within 24 hours to confirm the details and arrange payment.</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($booking->status == \App\Models\Booking::STATUS_CONFIRMED)
                                    <div class="alert alert-success mb-0">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-check-circle fs-4 me-3 mt-1"></i>
                                            <div>
                                                <h6 class="alert-heading fw-bold mb-2">{{ $booking->status_label }}</h6>
                                                <p class="mb-0">Great! Your booking has been confirmed. You will receive detailed itinerary and preparation instructions via email.</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($booking->status == \App\Models\Booking::STATUS_CANCELLED)
                                    <div class="alert alert-danger mb-0">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-times-circle fs-4 me-3 mt-1"></i>
                                            <div>
                                                <h6 class="alert-heading fw-bold mb-2">{{ $booking->status_label }}</h6>
                                                <p class="mb-0">This booking has been cancelled. If you have any questions, please contact our support team.</p>
                                                @if($booking->cancellation_reason)
                                                    <hr class="my-2">
                                                    <small><strong>Reason:</strong> {{ $booking->cancellation_reason }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif($booking->status == \App\Models\Booking::STATUS_COMPLETED)
                                    <div class="alert alert-info mb-0">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-star fs-4 me-3 mt-1"></i>
                                            <div>
                                                <h6 class="alert-heading fw-bold mb-2">{{ $booking->status_label }}</h6>
                                                <p class="mb-0">Your tour has been completed. We hope you had a wonderful experience! Please consider leaving a review.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Payment Status -->
                                @if($booking->latestPayment)
                                    <div class="payment-status-wrapper mt-3 p-3">
                                        <h6 class="fw-bold mb-3">Payment Status</h6>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-muted">Payment Code:</span>
                                            <span class="fw-bold">{{ $booking->latestPayment->payment_code }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Status:</span>
                                            <span class="badge {{ str_replace('badge-', 'bg-', $booking->latestPayment->status_badge_class) }}">
                                                {{ $booking->latestPayment->status_label }}
                                            </span>
                                        </div>
                                        @if($booking->latestPayment->failure_reason)
                                            <div class="alert alert-danger mt-3 mb-0 py-2">
                                                <small><i class="fas fa-exclamation-triangle me-2"></i>{{ $booking->latestPayment->failure_reason }}</small>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons-section text-center mb-5">
                        @php
                            $latestPayment = $booking->latestPayment;
                        @endphp
                        
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            @if(!$latestPayment || $latestPayment->status === 'expired' || $latestPayment->status === 'failed')
                                <a href="{{ route('frontsite.payment.show', $booking->booking_code) }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                                </a>
                            @elseif($latestPayment->status === 'pending')
                                <a href="{{ route('frontsite.payment.status', $latestPayment->payment_code) }}" class="btn btn-warning btn-lg">
                                    <i class="fas fa-clock me-2"></i>Cek Status Pembayaran
                                </a>
                            @elseif($latestPayment->status === 'paid')
                                <button class="btn btn-success btn-lg" disabled>
                                    <i class="fas fa-check me-2"></i>Sudah Dibayar
                                </button>
                            @endif
                            
                            <a href="{{ route('frontsite.tours.show', $booking->tour->slug) }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-eye me-2"></i>View Tour Details
                            </a>
                            <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-home me-2"></i>Back to Home
                            </a>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support-section">
                        <div class="text-center mb-4">
                            <h4 class="fw-bold mb-2">Need Help?</h4>
                            <p class="text-muted">If you have any questions about your booking, please don't hesitate to contact us.</p>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="contact-card text-center">
                                    <i class="fas fa-phone contact-icon text-primary"></i>
                                    <p class="contact-label">Phone</p>
                                    <p class="contact-value">+62 123 456 789</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-card text-center">
                                    <i class="fas fa-envelope contact-icon text-primary"></i>
                                    <p class="contact-label">Email</p>
                                    <p class="contact-value">info@opsiliburan.com</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-card text-center">
                                    <i class="fab fa-whatsapp contact-icon text-success"></i>
                                    <p class="contact-label">WhatsApp</p>
                                    <p class="contact-value">Support Available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
/* Main Container */
.booking-details-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    min-height: 100vh;
    padding: 60px 0;
}

.booking-details-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    padding: 40px;
    animation: fadeInUp 0.6s ease-out;
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

/* Header Section */
.booking-header {
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 30px;
}

.booking-code-wrapper {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 30px;
    border-radius: 15px;
    display: inline-block;
    margin: 20px 0;
}

.booking-code-wrapper p {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 5px;
    font-size: 14px;
}

.booking-code-wrapper h4 {
    color: #ffffff;
    margin: 0;
    font-size: 24px;
    letter-spacing: 2px;
}

/* Info Cards */
.info-card {
    background: #ffffff;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.info-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    padding: 20px 25px;
    display: flex;
    align-items: center;
    font-weight: 600;
}

.info-card-header i {
    font-size: 20px;
}

.info-card-body {
    padding: 25px;
}

.info-item {
    margin-bottom: 20px;
}

.info-item label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.info-item p {
    font-size: 16px;
    color: #212529;
    margin: 0;
    font-weight: 500;
}

.price-highlight {
    color: #667eea !important;
    font-size: 24px !important;
    font-weight: 700 !important;
}

/* Payment Summary Card */
.payment-summary-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.payment-summary-card .info-card-header {
    background: rgba(255, 255, 255, 0.2);
}

.payment-summary-card .info-card-body {
    background: #ffffff;
}

.payment-breakdown {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.breakdown-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    font-size: 15px;
    color: #495057;
}

.breakdown-divider {
    border-top: 2px dashed #dee2e6;
    margin: 15px 0;
}

.breakdown-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    font-size: 20px;
    font-weight: 700;
    color: #667eea;
}

/* Status Section */
.status-info-section .info-card {
    border: 2px solid #e9ecef;
}

.alert {
    border-radius: 12px;
    border: none;
}

.payment-status-wrapper {
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

/* Action Buttons */
.action-buttons-section {
    padding: 30px 0;
    border-top: 2px solid #f0f0f0;
    border-bottom: 2px solid #f0f0f0;
}

.btn-lg {
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.btn-outline-primary {
    border: 2px solid #667eea;
    color: #667eea;
}

.btn-outline-primary:hover {
    background: #667eea;
    color: #ffffff;
    transform: translateY(-2px);
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: #ffffff;
    transform: translateY(-2px);
}

/* Contact Support Section */
.contact-support-section {
    padding: 40px 0 20px;
}

.contact-card {
    background: #f8f9fa;
    padding: 30px 20px;
    border-radius: 15px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.contact-card:hover {
    background: #ffffff;
    border-color: #667eea;
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.contact-icon {
    font-size: 40px;
    margin-bottom: 15px;
}

.contact-label {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 8px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-value {
    font-size: 16px;
    color: #212529;
    font-weight: 600;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .booking-details-card {
        padding: 25px 20px;
    }
    
    .booking-code-wrapper h4 {
        font-size: 18px;
    }
    
    .info-card-header {
        padding: 15px 20px;
    }
    
    .info-card-body {
        padding: 20px;
    }
    
    .breakdown-total {
        font-size: 18px;
    }
    
    .btn-lg {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .contact-card {
        margin-bottom: 15px;
    }
}

@media (max-width: 576px) {
    .booking-details-section {
        padding: 30px 0;
    }
    
    .booking-details-card {
        border-radius: 15px;
    }
    
    .price-highlight {
        font-size: 20px !important;
    }
}

/* Badge Styling */
.badge {
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Smooth Transitions */
* {
    transition: all 0.3s ease;
}
</style>
@endpush
@endsection