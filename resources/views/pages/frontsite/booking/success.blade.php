@extends('layouts.frontsite')

@section('title', 'Booking Confirmation | Opsi Liburan Indonesia')

@section('content')
<div class="booking-success-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="booking-success-card">
                    <!-- Success Icon & Message -->
                    <div class="success-header text-center mb-5">
                        <div class="success-icon-wrapper mb-4">
                            <div class="success-icon-circle">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <h1 class="success-title mb-3">Booking Confirmed!</h1>
                        <p class="success-subtitle">Thank you for choosing Opsi Liburan Indonesia.<br>Your booking has been successfully submitted.</p>
                    </div>

                    <!-- Booking Code Highlight -->
                    <div class="booking-code-highlight text-center mb-5">
                        <p class="code-label">Your Booking Code</p>
                        <h2 class="code-value">{{ $booking->booking_code }}</h2>
                        <p class="code-note">Please save this code for your reference</p>
                    </div>

                    <!-- Booking Details -->
                    <div class="booking-details-section mb-5">
                        <h3 class="section-title text-center mb-4">
                            <i class="fas fa-file-alt me-2"></i>Booking Summary
                        </h3>
                        
                        <div class="details-grid">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Tour Package</label>
                                            <p>{{ $booking->tour->title }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Full Name</label>
                                            <p>{{ $booking->name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Email Address</label>
                                            <p>{{ $booking->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Phone Number</label>
                                            <p>{{ $booking->phone }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Number of Travelers</label>
                                            <p>{{ $booking->travelers }} person(s)</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Preferred Date</label>
                                            <p>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($booking->special_requests)
                                <div class="col-12">
                                    <div class="detail-card">
                                        <div class="detail-icon">
                                            <i class="fas fa-comment-alt"></i>
                                        </div>
                                        <div class="detail-content">
                                            <label>Special Requests</label>
                                            <p>{{ $booking->special_requests }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-12">
                                    <div class="total-price-card">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="total-label">Total Amount</span>
                                            <span class="total-amount">${{ number_format($booking->total_price, 0) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="next-steps-section mb-5">
                        <h3 class="section-title text-center mb-4">
                            <i class="fas fa-route me-2"></i>What's Next?
                        </h3>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="step-card">
                                    <div class="step-number">1</div>
                                    <div class="step-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h5 class="step-title">Confirmation Email</h5>
                                    <p class="step-description">You'll receive a confirmation email with detailed information within 24 hours.</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="step-card">
                                    <div class="step-number">2</div>
                                    <div class="step-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h5 class="step-title">Personal Contact</h5>
                                    <p class="step-description">Our team will contact you to finalize the details and payment.</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="step-card">
                                    <div class="step-number">3</div>
                                    <div class="step-icon">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <h5 class="step-title">Trip Preparation</h5>
                                    <p class="step-description">We'll provide you with a complete itinerary and preparation guide.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons-section text-center mb-5">
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ route('frontsite.payment.show', $booking->booking_code) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Lanjutkan Pembayaran
                            </a>
                            <a href="{{ route('frontsite.booking.show', $booking->booking_code) }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-file-alt me-2"></i>View Booking Details
                            </a>
                            <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-home me-2"></i>Back to Home
                            </a>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-section">
                        <h4 class="contact-title text-center mb-4">Need Help?</h4>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="contact-card text-center">
                                    <i class="fas fa-phone contact-icon"></i>
                                    <p class="contact-label">Phone</p>
                                    <p class="contact-value">+62 123 456 789</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contact-card text-center">
                                    <i class="fas fa-envelope contact-icon"></i>
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

@push('after-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
/* Main Container */
.booking-success-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    min-height: 100vh;
    padding: 60px 0;
}

.booking-success-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    padding: 50px 40px;
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

/* Success Header */
.success-icon-wrapper {
    animation: scaleIn 0.6s ease-out 0.3s both;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.success-icon-circle {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
    position: relative;
}

.success-icon-circle::before {
    content: '';
    position: absolute;
    width: 140px;
    height: 140px;
    border: 3px solid rgba(16, 185, 129, 0.3);
    border-radius: 50%;
    animation: pulse 2s ease-out infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    100% {
        transform: scale(1.2);
        opacity: 0;
    }
}

.success-icon-circle i {
    font-size: 60px;
    color: #ffffff;
}

.success-title {
    font-size: 42px;
    font-weight: 700;
    color: #10b981;
    margin-bottom: 15px;
}

.success-subtitle {
    font-size: 18px;
    color: #6c757d;
    line-height: 1.8;
}

/* Booking Code Highlight */
.booking-code-highlight {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.code-label {
    color: rgba(255, 255, 255, 0.9);
    font-size: 14px;
    margin-bottom: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.code-value {
    color: #ffffff;
    font-size: 36px;
    font-weight: 700;
    letter-spacing: 3px;
    margin-bottom: 10px;
}

.code-note {
    color: rgba(255, 255, 255, 0.8);
    font-size: 13px;
    margin: 0;
}

/* Section Title */
.section-title {
    font-size: 28px;
    font-weight: 700;
    color: #212529;
    position: relative;
    display: inline-block;
    padding-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

/* Detail Cards */
.detail-card {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    height: 100%;
}

.detail-card:hover {
    background: #ffffff;
    border-color: #667eea;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.detail-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.detail-icon i {
    font-size: 22px;
    color: #ffffff;
}

.detail-content {
    flex: 1;
}

.detail-content label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.detail-content p {
    font-size: 16px;
    color: #212529;
    margin: 0;
    font-weight: 500;
    line-height: 1.6;
}

/* Total Price Card */
.total-price-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.total-label {
    font-size: 18px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.total-amount {
    font-size: 32px;
    font-weight: 700;
    color: #ffffff;
}

/* Step Cards */
.step-card {
    background: #ffffff;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 30px 25px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.step-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.step-card:hover {
    transform: translateY(-10px);
    border-color: #667eea;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.step-card:hover::before {
    transform: scaleX(1);
}

.step-number {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
}

.step-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.step-card:hover .step-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.step-icon i {
    font-size: 30px;
    color: #667eea;
    transition: all 0.3s ease;
}

.step-card:hover .step-icon i {
    color: #ffffff;
}

.step-title {
    font-size: 18px;
    font-weight: 700;
    color: #212529;
    margin-bottom: 12px;
}

.step-description {
    font-size: 14px;
    color: #6c757d;
    line-height: 1.7;
    margin: 0;
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

/* Contact Section */
.contact-section {
    padding-top: 30px;
}

.contact-title {
    font-size: 24px;
    font-weight: 700;
    color: #212529;
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
    color: #667eea;
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
@media (max-width: 992px) {
    .success-title {
        font-size: 36px;
    }
    
    .code-value {
        font-size: 28px;
    }
    
    .section-title {
        font-size: 24px;
    }
}

@media (max-width: 768px) {
    .booking-success-card {
        padding: 35px 25px;
    }
    
    .success-icon-circle {
        width: 100px;
        height: 100px;
    }
    
    .success-icon-circle i {
        font-size: 50px;
    }
    
    .success-title {
        font-size: 32px;
    }
    
    .success-subtitle {
        font-size: 16px;
    }
    
    .booking-code-highlight {
        padding: 25px 20px;
    }
    
    .code-value {
        font-size: 24px;
        letter-spacing: 2px;
    }
    
    .detail-card {
        padding: 15px;
    }
    
    .detail-icon {
        width: 45px;
        height: 45px;
        margin-right: 12px;
    }
    
    .detail-icon i {
        font-size: 20px;
    }
    
    .total-price-card {
        padding: 20px 25px;
    }
    
    .total-label {
        font-size: 16px;
    }
    
    .total-amount {
        font-size: 28px;
    }
    
    .step-card {
        padding: 25px 20px;
        margin-bottom: 15px;
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
    .booking-success-section {
        padding: 40px 0;
    }
    
    .booking-success-card {
        border-radius: 15px;
        padding: 30px 20px;
    }
    
    .success-icon-circle {
        width: 90px;
        height: 90px;
    }
    
    .success-icon-circle::before {
        width: 110px;
        height: 110px;
    }
    
    .success-icon-circle i {
        font-size: 45px;
    }
    
    .success-title {
        font-size: 28px;
    }
    
    .code-value {
        font-size: 20px;
    }
}

/* Smooth Transitions */
* {
    transition: all 0.3s ease;
}
</style>
@endpush
@endsection