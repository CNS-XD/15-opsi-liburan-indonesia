@extends('layouts.frontsite')

@section('title', 'Booking Details | Opsi Liburan Indonesia')

@section('content')
<div class="booking-details-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="booking-details-card p-40" style="border: 1px solid #eee; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <div class="booking-header text-center mb-40">
                        <h1 class="mb-10">Booking Details</h1>
                        <p class="text-muted">Booking Code: <strong class="text-primary">{{ $booking->booking_code }}</strong></p>
                        
                        <!-- Status Badge -->
                        <div class="status-badge mt-20">
                            <span class="badge {{ str_replace('badge-', 'bg-', $booking->status_badge_class) }} px-3 py-2">
                                {{ $booking->status_label }}
                            </span>
                        </div>
                    </div>

                    <!-- Booking Information -->
                    <div class="booking-info mb-40">
                        <div class="row">
                            <!-- Tour Information -->
                            <div class="col-md-6 mb-30">
                                <div class="info-section p-20" style="background: #f8f9fa; border-radius: 10px; height: 100%;">
                                    <h4 class="mb-20">Tour Information</h4>
                                    <div class="info-item mb-15">
                                        <strong>Tour:</strong>
                                        <p class="mb-0">{{ $booking->tour->title }}</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Duration:</strong>
                                        <p class="mb-0">{{ $booking->tour->time_tour }}</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Type:</strong>
                                        <p class="mb-0">{{ $booking->tour->type_tour == 0 ? 'Private Tour' : 'Sharing Tour' }}</p>
                                    </div>
                                    <div class="info-item">
                                        <strong>Price per Person:</strong>
                                        <p class="mb-0 text-primary fw-bold">${{ number_format($booking->tour->price, 0) }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Customer Information -->
                            <div class="col-md-6 mb-30">
                                <div class="info-section p-20" style="background: #f8f9fa; border-radius: 10px; height: 100%;">
                                    <h4 class="mb-20">Customer Information</h4>
                                    <div class="info-item mb-15">
                                        <strong>Name:</strong>
                                        <p class="mb-0">{{ $booking->name }}</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Email:</strong>
                                        <p class="mb-0">{{ $booking->email }}</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Phone:</strong>
                                        <p class="mb-0">{{ $booking->phone }}</p>
                                    </div>
                                    <div class="info-item">
                                        <strong>Booking Date:</strong>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Trip Details -->
                            <div class="col-md-6 mb-30">
                                <div class="info-section p-20" style="background: #f8f9fa; border-radius: 10px; height: 100%;">
                                    <h4 class="mb-20">Trip Details</h4>
                                    <div class="info-item mb-15">
                                        <strong>Number of Travelers:</strong>
                                        <p class="mb-0">{{ $booking->travelers }} person(s)</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Preferred Date:</strong>
                                        <p class="mb-0">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}</p>
                                    </div>
                                    @if($booking->special_requests)
                                    <div class="info-item">
                                        <strong>Special Requests:</strong>
                                        <p class="mb-0">{{ $booking->special_requests }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Payment Summary -->
                            <div class="col-md-6 mb-30">
                                <div class="info-section p-20" style="background: #f8f9fa; border-radius: 10px; height: 100%;">
                                    <h4 class="mb-20">Payment Summary</h4>
                                    <div class="payment-breakdown">
                                        <div class="d-flex justify-content-between mb-10">
                                            <span>Price per person:</span>
                                            <span>${{ number_format($booking->tour->price, 0) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-10">
                                            <span>Number of travelers:</span>
                                            <span>{{ $booking->travelers }}</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <strong>Total Amount:</strong>
                                            <strong class="text-primary">${{ number_format($booking->total_price, 0) }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Information -->
                    <div class="status-info mb-40 p-20" style="border: 1px solid #dee2e6; border-radius: 10px;">
                        <h4 class="mb-20">Booking Status</h4>
                        @if($booking->status == \App\Models\Booking::STATUS_PENDING)
                            <div class="alert alert-warning">
                                <h6 class="alert-heading">{{ $booking->status_label }}</h6>
                                <p class="mb-0">Your booking is currently being processed. Our team will contact you within 24 hours to confirm the details and arrange payment.</p>
                            </div>
                        @elseif($booking->status == \App\Models\Booking::STATUS_CONFIRMED)
                            <div class="alert alert-success">
                                <h6 class="alert-heading">{{ $booking->status_label }}</h6>
                                <p class="mb-0">Great! Your booking has been confirmed. You will receive detailed itinerary and preparation instructions via email.</p>
                            </div>
                        @elseif($booking->status == \App\Models\Booking::STATUS_CANCELLED)
                            <div class="alert alert-danger">
                                <h6 class="alert-heading">{{ $booking->status_label }}</h6>
                                <p class="mb-0">This booking has been cancelled. If you have any questions, please contact our support team.</p>
                                @if($booking->cancellation_reason)
                                    <hr>
                                    <small><strong>Reason:</strong> {{ $booking->cancellation_reason }}</small>
                                @endif
                            </div>
                        @elseif($booking->status == \App\Models\Booking::STATUS_COMPLETED)
                            <div class="alert alert-info">
                                <h6 class="alert-heading">{{ $booking->status_label }}</h6>
                                <p class="mb-0">Your tour has been completed. We hope you had a wonderful experience! Please consider leaving a review.</p>
                            </div>
                        @endif
                        
                        <!-- Payment Status -->
                        @if($booking->latestPayment)
                            <div class="payment-status mt-20 p-15" style="background: #f8f9fa; border-radius: 8px;">
                                <h6 class="mb-10">Payment Status</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ $booking->latestPayment->payment_code }}</span>
                                    <span class="badge {{ str_replace('badge-', 'bg-', $booking->latestPayment->status_badge_class) }}">
                                        {{ $booking->latestPayment->status_label }}
                                    </span>
                                </div>
                                @if($booking->latestPayment->failure_reason)
                                    <small class="text-danger mt-5 d-block">{{ $booking->latestPayment->failure_reason }}</small>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons text-center">
                        @php
                            $latestPayment = $booking->latestPayment;
                        @endphp
                        
                        @if(!$latestPayment || $latestPayment->status === 'expired' || $latestPayment->status === 'failed')
                            <a href="{{ route('frontsite.payment.show', $booking->booking_code) }}" class="btn btn-primary me-15">
                                <i class="fas fa-credit-card me-5"></i>Bayar Sekarang
                            </a>
                        @elseif($latestPayment->status === 'pending')
                            <a href="{{ route('frontsite.payment.status', $latestPayment->payment_code) }}" class="btn btn-warning me-15">
                                <i class="fas fa-clock me-5"></i>Cek Status Pembayaran
                            </a>
                        @elseif($latestPayment->status === 'paid')
                            <span class="btn btn-success me-15" disabled>
                                <i class="fas fa-check me-5"></i>Sudah Dibayar
                            </span>
                        @endif
                        
                        <a href="{{ route('frontsite.tours.show', $booking->tour->slug) }}" class="btn btn-outline-primary me-15">View Tour Details</a>
                        <a href="{{ route('index') }}" class="btn btn-outline-secondary">Back to Home</a>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support mt-40 pt-30 text-center" style="border-top: 1px solid #eee;">
                        <h5 class="mb-20">Need Help?</h5>
                        <p class="mb-20">If you have any questions about your booking, please don't hesitate to contact us.</p>
                        <div class="contact-items d-flex justify-content-center gap-30 flex-wrap">
                            <div class="contact-item">
                                <i class="fas fa-phone text-primary me-5"></i>
                                <span>+62 123 456 789</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope text-primary me-5"></i>
                                <span>info@opsiliburan.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fab fa-whatsapp text-success me-5"></i>
                                <span>WhatsApp Support</span>
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
.booking-details-card {
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

.info-section {
    transition: transform 0.3s ease;
}

.info-section:hover {
    transform: translateY(-2px);
}

.payment-breakdown {
    font-size: 14px;
}

.payment-breakdown hr {
    margin: 10px 0;
}

@media (max-width: 768px) {
    .booking-details-card {
        padding: 20px;
    }
    
    .contact-items {
        flex-direction: column;
        gap: 15px !important;
    }
}
</style>
@endpush
@endsection