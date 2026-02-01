@extends('layouts.frontsite')

@section('title', 'Booking Confirmation | Opsi Liburan Indonesia')

@section('content')
<div class="booking-success-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="booking-success-card text-center p-50" style="border: 1px solid #eee; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <!-- Success Icon -->
                    <div class="success-icon mb-30">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>

                    <!-- Success Message -->
                    <h1 class="text-success mb-20">Booking Confirmed!</h1>
                    <p class="lead mb-30">Thank you for choosing Opsi Liburan Indonesia. Your booking has been successfully submitted.</p>

                    <!-- Booking Details -->
                    <div class="booking-details mb-40 p-30" style="background: #f8f9fa; border-radius: 10px; text-align: left;">
                        <h4 class="mb-20 text-center">Booking Details</h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-15">
                                <strong>Booking Code:</strong>
                                <span class="text-primary">{{ $booking->booking_code }}</span>
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Tour:</strong>
                                {{ $booking->tour->title }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Name:</strong>
                                {{ $booking->name }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Email:</strong>
                                {{ $booking->email }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Phone:</strong>
                                {{ $booking->phone }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Travelers:</strong>
                                {{ $booking->travelers }} person(s)
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Preferred Date:</strong>
                                {{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Total Price:</strong>
                                <span class="text-primary fw-bold">${{ number_format($booking->total_price, 0) }}</span>
                            </div>
                            @if($booking->special_requests)
                            <div class="col-12 mb-15">
                                <strong>Special Requests:</strong>
                                <p class="mb-0 mt-5">{{ $booking->special_requests }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="next-steps mb-40">
                        <h4 class="mb-20">What's Next?</h4>
                        <div class="row text-start">
                            <div class="col-md-4 mb-20">
                                <div class="step-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="step-icon mb-15">
                                        <i class="fas fa-envelope text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>1. Confirmation Email</h6>
                                    <p class="mb-0 small">You'll receive a confirmation email with detailed information within 24 hours.</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-20">
                                <div class="step-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="step-icon mb-15">
                                        <i class="fas fa-phone text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>2. Personal Contact</h6>
                                    <p class="mb-0 small">Our team will contact you to finalize the details and payment.</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-20">
                                <div class="step-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="step-icon mb-15">
                                        <i class="fas fa-map-marked-alt text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>3. Trip Preparation</h6>
                                    <p class="mb-0 small">We'll provide you with a complete itinerary and preparation guide.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="{{ route('frontsite.payment.show', $booking->booking_code) }}" class="btn btn-primary me-15">Lanjutkan Pembayaran</a>
                        <a href="{{ route('frontsite.booking.show', $booking->booking_code) }}" class="btn btn-outline-primary me-15">View Booking Details</a>
                        <a href="{{ route('index') }}" class="btn btn-outline-secondary">Back to Home</a>
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-info mt-40 pt-30" style="border-top: 1px solid #eee;">
                        <h5 class="mb-20">Need Help?</h5>
                        <div class="contact-items d-flex justify-content-center gap-30">
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
.booking-success-card {
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

.step-item {
    transition: transform 0.3s ease;
}

.step-item:hover {
    transform: translateY(-5px);
}

@media (max-width: 768px) {
    .booking-success-card {
        padding: 30px 20px;
    }
    
    .contact-items {
        flex-direction: column;
        gap: 15px !important;
    }
}
</style>
@endpush
@endsection