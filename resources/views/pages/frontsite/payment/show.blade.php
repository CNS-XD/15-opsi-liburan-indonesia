@extends('layouts.frontsite')

@section('title', 'Pilih Metode Pembayaran | Opsi Liburan Indonesia')

@section('content')
<div class="payment-method-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="payment-card">
                    <!-- Header -->
                    <div class="payment-header text-center mb-5">
                        <div class="header-icon mb-3">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h1 class="payment-title mb-3">Pilih Metode Pembayaran</h1>
                        <div class="booking-code-display">
                            <span class="code-label">Booking Code:</span>
                            <span class="code-value">{{ $booking->booking_code }}</span>
                        </div>
                    </div>

                    <!-- Booking Summary -->
                    <div class="booking-summary-section mb-5">
                        <div class="summary-header">
                            <h4 class="summary-title">
                                <i class="fas fa-file-invoice me-2"></i>Ringkasan Pesanan
                            </h4>
                        </div>
                        <div class="summary-body">
                            <div class="row g-4">
                                <div class="col-lg-7">
                                    <div class="booking-details">
                                        <div class="detail-row">
                                            <div class="detail-icon">
                                                <i class="fas fa-map-marked-alt"></i>
                                            </div>
                                            <div class="detail-content">
                                                <label>Tour Package</label>
                                                <p>{{ $booking->tour->title }}</p>
                                            </div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="detail-content">
                                                <label>Jumlah Traveler</label>
                                                <p>{{ $booking->travelers }} orang</p>
                                            </div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-icon">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="detail-content">
                                                <label>Tanggal Keberangkatan</label>
                                                <p>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="detail-row mb-0">
                                            <div class="detail-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="detail-content">
                                                <label>Email</label>
                                                <p>{{ $booking->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="price-summary">
                                        <div class="price-item">
                                            <span class="price-label">Total (USD)</span>
                                            <span class="price-value">${{ number_format($booking->total_price, 0) }}</span>
                                        </div>
                                        <div class="price-divider"></div>
                                        <div class="price-item total">
                                            <span class="price-label">Total (IDR)</span>
                                            <span class="price-value">Rp {{ number_format($booking->total_price * 15000, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Payment Methods Form -->
                    <form action="{{ route('frontsite.payment.create', $booking->booking_code) }}" method="POST" id="paymentForm">
                        @csrf
                        
                        <!-- Virtual Account Section -->
                        <div class="payment-method-section-wrapper mb-4">
                            <div class="payment-section-header">
                                <div class="section-icon va-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <h5 class="section-title">Virtual Account</h5>
                            </div>
                            <div class="payment-options-grid">
                                <div class="row g-3">
                                    @foreach($paymentMethods['virtual_account'] as $code => $name)
                                    <div class="col-md-6">
                                        <div class="payment-option-wrapper">
                                            <input type="radio" name="payment_selection" value="virtual_account" data-channel="{{ $code }}" id="va_{{ $code }}" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                            <label for="va_{{ $code }}" class="payment-option-label" onclick="setTimeout(updatePaymentButton, 10)">
                                                <div class="payment-option-card">
                                                    <div class="option-icon va-color">
                                                        <i class="fas fa-university"></i>
                                                    </div>
                                                    <div class="option-content">
                                                        <h6 class="option-name">{{ $name }}</h6>
                                                        <p class="option-desc">Transfer bank virtual</p>
                                                    </div>
                                                    <div class="option-check">
                                                        <i class="fas fa-check-circle"></i>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- E-Wallet Section -->
                        <div class="payment-method-section-wrapper mb-4">
                            <div class="payment-section-header">
                                <div class="section-icon ew-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <h5 class="section-title">E-Wallet</h5>
                            </div>
                            <div class="payment-options-grid">
                                <div class="row g-3">
                                    @foreach($paymentMethods['ewallet'] as $code => $name)
                                    <div class="col-md-6">
                                        <div class="payment-option-wrapper">
                                            <input type="radio" name="payment_selection" value="ewallet" data-channel="{{ $code }}" id="ew_{{ $code }}" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                            <label for="ew_{{ $code }}" class="payment-option-label" onclick="setTimeout(updatePaymentButton, 10)">
                                                <div class="payment-option-card">
                                                    <div class="option-icon ew-color">
                                                        <i class="fas fa-mobile-alt"></i>
                                                    </div>
                                                    <div class="option-content">
                                                        <h6 class="option-name">{{ $name }}</h6>
                                                        <p class="option-desc">Dompet digital</p>
                                                    </div>
                                                    <div class="option-check">
                                                        <i class="fas fa-check-circle"></i>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- QR Code Section -->
                        <div class="payment-method-section-wrapper mb-4">
                            <div class="payment-section-header">
                                <div class="section-icon qr-icon">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <h5 class="section-title">QR Code</h5>
                            </div>
                            <div class="payment-options-grid">
                                <div class="row g-3">
                                    @foreach($paymentMethods['qr_code'] as $code => $name)
                                    <div class="col-md-6">
                                        <div class="payment-option-wrapper">
                                            <input type="radio" name="payment_selection" value="qr_code" data-channel="{{ $code }}" id="qr_{{ $code }}" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                            <label for="qr_{{ $code }}" class="payment-option-label" onclick="setTimeout(updatePaymentButton, 10)">
                                                <div class="payment-option-card">
                                                    <div class="option-icon qr-color">
                                                        <i class="fas fa-qrcode"></i>
                                                    </div>
                                                    <div class="option-content">
                                                        <h6 class="option-name">{{ $name }}</h6>
                                                        <p class="option-desc">Scan QR untuk bayar</p>
                                                    </div>
                                                    <div class="option-check">
                                                        <i class="fas fa-check-circle"></i>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Credit Card Section -->
                        <div class="payment-method-section-wrapper mb-5">
                            <div class="payment-section-header">
                                <div class="section-icon cc-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h5 class="section-title">Kartu Kredit</h5>
                            </div>
                            <div class="payment-options-grid">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="payment-option-wrapper">
                                            <input type="radio" name="payment_selection" value="credit_card" data-channel="credit_card" id="cc_all" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                            <label for="cc_all" class="payment-option-label" onclick="setTimeout(updatePaymentButton, 10)">
                                                <div class="payment-option-card">
                                                    <div class="option-icon cc-color">
                                                        <i class="fas fa-credit-card"></i>
                                                    </div>
                                                    <div class="option-content">
                                                        <h6 class="option-name">Kartu Kredit</h6>
                                                        <p class="option-desc">Visa, Mastercard, JCB, Amex</p>
                                                    </div>
                                                    <div class="option-check">
                                                        <i class="fas fa-check-circle"></i>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="payment_method" id="payment_method">
                        <input type="hidden" name="payment_channel" id="payment_channel">

                        <!-- Submit Button -->
                        <div class="payment-submit-section text-center mb-5">
                            <button type="submit" class="btn-payment-submit" id="payButton" disabled onclick="return checkPayment()">
                                <i class="fas fa-lock me-2"></i>Pilih Metode Pembayaran
                            </button>
                        </div>
                        
                        <!-- Inline JavaScript -->
                        <script>
                        function checkPayment() {
                            const checked = document.querySelector('input[name="payment_selection"]:checked');
                            if (!checked) {
                                alert('Silakan pilih metode pembayaran terlebih dahulu');
                                return false;
                            }
                            return true;
                        }
                        
                        function updatePaymentButton() {
                            const button = document.getElementById('payButton');
                            const methodInput = document.getElementById('payment_method');
                            const channelInput = document.getElementById('payment_channel');
                            
                            const checked = document.querySelector('input[name="payment_selection"]:checked');
                            
                            if (checked) {
                                methodInput.value = checked.value;
                                channelInput.value = checked.getAttribute('data-channel');
                                
                                button.disabled = false;
                                button.classList.remove('disabled');
                                button.classList.add('active');
                                button.innerHTML = '<i class="fas fa-check-circle me-2"></i>Bayar Sekarang - Rp {{ number_format($booking->total_price * 15000, 0, ",", ".") }}';
                            } else {
                                button.disabled = true;
                                button.classList.add('disabled');
                                button.classList.remove('active');
                                button.innerHTML = '<i class="fas fa-lock me-2"></i>Pilih Metode Pembayaran';
                            }
                        }
                        </script>
                    </form>

                    <!-- Security Info -->
                    <div class="security-info-section">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="security-card">
                                    <div class="security-icon secure">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h6 class="security-title">Aman & Terpercaya</h6>
                                    <p class="security-desc">Pembayaran diproses dengan teknologi enkripsi SSL</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="security-card">
                                    <div class="security-icon timer">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <h6 class="security-title">Berlaku 24 Jam</h6>
                                    <p class="security-desc">Selesaikan pembayaran dalam 24 jam</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="security-card">
                                    <div class="security-icon support">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <h6 class="security-title">Bantuan 24/7</h6>
                                    <p class="security-desc">Tim support siap membantu Anda</p>
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
/* Main Section */
.payment-method-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.payment-card {
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

/* Header */
.payment-header {
    padding-bottom: 30px;
    border-bottom: 3px solid #f0f0f0;
}

.header-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.header-icon i {
    font-size: 36px;
    color: #ffffff;
}

.payment-title {
    font-size: 32px;
    font-weight: 700;
    color: #212529;
}

.booking-code-display {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    padding: 12px 30px;
    border-radius: 50px;
    display: inline-block;
}

.code-label {
    font-size: 14px;
    color: #6c757d;
    font-weight: 600;
    margin-right: 8px;
}

.code-value {
    font-size: 16px;
    font-weight: 700;
    color: #667eea;
    letter-spacing: 1px;
}

/* Booking Summary */
.booking-summary-section {
    background: #f8f9fa;
    border-radius: 15px;
    overflow: hidden;
    border: 2px solid #e9ecef;
}

.summary-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 20px 25px;
}

.summary-title {
    color: #ffffff;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
}

.summary-body {
    padding: 30px 25px;
}

.booking-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.detail-row {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.detail-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.detail-icon i {
    color: #667eea;
    font-size: 20px;
}

.detail-content {
    flex: 1;
}

.detail-content label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}

.detail-content p {
    font-size: 15px;
    font-weight: 600;
    color: #212529;
    margin: 0;
    line-height: 1.5;
}

.price-summary {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    border: 2px solid #e9ecef;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.price-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
}

.price-label {
    font-size: 14px;
    color: #6c757d;
    font-weight: 600;
}

.price-value {
    font-size: 18px;
    font-weight: 700;
    color: #212529;
}

.price-divider {
    height: 2px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: 15px 0;
}

.price-item.total {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    padding: 15px;
    border-radius: 10px;
    margin-top: 10px;
}

.price-item.total .price-value {
    font-size: 24px;
    color: #667eea;
}

/* Payment Method Sections */
.payment-method-section-wrapper {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 15px;
    border: 2px solid #e9ecef;
}

.payment-section-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.section-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.section-icon i {
    font-size: 24px;
    color: #ffffff;
}

.va-icon {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.ew-icon {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
}

.qr-icon {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
}

.cc-icon {
    background: linear-gradient(135deg, #ffc107 0%, #d39e00 100%);
}

.section-title {
    font-size: 20px;
    font-weight: 700;
    color: #212529;
    margin: 0;
}

/* Payment Options */
.payment-options-grid {
    padding: 0;
}

.payment-option-wrapper {
    position: relative;
}

.payment-radio {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.payment-option-label {
    cursor: pointer;
    display: block;
    margin: 0;
}

.payment-option-card {
    background: #ffffff;
    border: 3px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s ease;
    position: relative;
}

.payment-option-card:hover {
    border-color: #667eea;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.option-icon {
    width: 55px;
    height: 55px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.option-icon i {
    font-size: 26px;
    color: #ffffff;
}

.va-color {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.ew-color {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
}

.qr-color {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
}

.cc-color {
    background: linear-gradient(135deg, #ffc107 0%, #d39e00 100%);
}

.option-content {
    flex: 1;
}

.option-name {
    font-size: 16px;
    font-weight: 700;
    color: #212529;
    margin-bottom: 3px;
}

.option-desc {
    font-size: 13px;
    color: #6c757d;
    margin: 0;
}

.option-check {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.option-check i {
    font-size: 16px;
    color: #ffffff;
    opacity: 0;
    transition: all 0.3s ease;
}

/* Selected State */
.payment-radio:checked + .payment-option-label .payment-option-card {
    border-color: #667eea;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.payment-radio:checked + .payment-option-label .option-check {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.payment-radio:checked + .payment-option-label .option-check i {
    opacity: 1;
}

/* Payment Submit Button */
.payment-submit-section {
    padding: 30px 0;
}

.btn-payment-submit {
    background: #6c757d;
    color: #ffffff;
    border: none;
    padding: 18px 50px;
    font-size: 18px;
    font-weight: 700;
    border-radius: 12px;
    cursor: not-allowed;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.btn-payment-submit.disabled {
    background: #6c757d;
    opacity: 0.6;
}

.btn-payment-submit.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    cursor: pointer;
    opacity: 1;
}

.btn-payment-submit.active:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

/* Security Info */
.security-info-section {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 15px;
    border-top: 3px solid #e9ecef;
}

.security-card {
    text-align: center;
    padding: 25px 15px;
    background: #ffffff;
    border-radius: 12px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.security-card:hover {
    border-color: #667eea;
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.security-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.security-icon i {
    font-size: 32px;
    color: #ffffff;
}

.security-icon.secure {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
}

.security-icon.timer {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.security-icon.support {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
}

.security-title {
    font-size: 16px;
    font-weight: 700;
    color: #212529;
    margin-bottom: 10px;
}

.security-desc {
    font-size: 13px;
    color: #6c757d;
    line-height: 1.6;
    margin: 0;
}

/* Alerts */
.alert {
    border-radius: 12px;
    border: none;
    padding: 15px 20px;
}

/* Responsive */
@media (max-width: 992px) {
    .payment-card {
        padding: 40px 30px;
    }
    
    .payment-title {
        font-size: 28px;
    }
    
    .price-summary {
        margin-top: 20px;
    }
}

@media (max-width: 768px) {
    .payment-method-section {
        padding-top: 40px;
        padding-bottom: 40px;
    }
    
    .payment-card {
        padding: 30px 20px;
        border-radius: 15px;
    }
    
    .header-icon {
        width: 70px;
        height: 70px;
    }
    
    .header-icon i {
        font-size: 32px;
    }
    
    .payment-title {
        font-size: 24px;
    }
    
    .summary-body {
        padding: 20px;
    }
    
    .payment-method-section-wrapper {
        padding: 20px;
    }
    
    .payment-option-card {
        padding: 15px;
    }
    
    .option-icon {
        width: 50px;
        height: 50px;
    }
    
    .option-icon i {
        font-size: 22px;
    }
    
    .btn-payment-submit {
        padding: 16px 30px;
        font-size: 16px;
        width: 100%;
    }
    
    .security-card {
        margin-bottom: 15px;
    }
}

@media (max-width: 576px) {
    .booking-code-display {
        padding: 10px 20px;
    }
    
    .code-value {
        font-size: 14px;
    }
    
    .detail-icon {
        width: 40px;
        height: 40px;
    }
    
    .detail-icon i {
        font-size: 18px;
    }
    
    .price-value {
        font-size: 16px;
    }
    
    .price-item.total .price-value {
        font-size: 20px;
    }
    
    .section-icon {
        width: 45px;
        height: 45px;
    }
    
    .section-icon i {
        font-size: 20px;
    }
    
    .section-title {
        font-size: 18px;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Initialize on page load
window.onload = function() {
    updatePaymentButton();
};
</script>
@endpush
@endsection