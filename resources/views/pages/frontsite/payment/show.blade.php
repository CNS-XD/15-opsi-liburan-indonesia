@extends('layouts.frontsite')

@section('title', 'Pilih Metode Pembayaran | Opsi Liburan Indonesia')

@section('content')
<div class="payment-method-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-card p-40" style="border: 1px solid #eee; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <div class="payment-header text-center mb-40">
                        <h1 class="mb-10">Pilih Metode Pembayaran</h1>
                        <p class="text-muted">Booking Code: <strong class="text-primary">{{ $booking->booking_code }}</strong></p>
                    </div>

                    <!-- Booking Summary -->
                    <div class="booking-summary mb-40 p-20" style="background: #f8f9fa; border-radius: 10px;">
                        <h4 class="mb-20">Ringkasan Pesanan</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <h6>{{ $booking->tour->title }}</h6>
                                <p class="mb-5"><i class="fas fa-user me-2"></i>{{ $booking->travelers }} orang</p>
                                <p class="mb-5"><i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($booking->preferred_date)->format('d M Y') }}</p>
                                <p class="mb-0"><i class="fas fa-envelope me-2"></i>{{ $booking->email }}</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="price-info">
                                    <p class="mb-5">Total (USD): <strong>${{ number_format($booking->total_price, 0) }}</strong></p>
                                    <p class="mb-0 text-primary">Total (IDR): <strong>Rp {{ number_format($booking->total_price * 15000, 0, ',', '.') }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger mb-30">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Payment Methods -->
                    <form action="{{ route('frontsite.payment.create', $booking->booking_code) }}" method="POST" id="paymentForm">
                        @csrf
                        
                        <!-- Virtual Account -->
                        <div class="payment-method-group mb-30">
                            <h5 class="mb-20"><i class="fas fa-university text-primary me-10"></i>Virtual Account</h5>
                            <div class="row">
                                @foreach($paymentMethods['virtual_account'] as $code => $name)
                                <div class="col-md-6 mb-15">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_selection" value="virtual_account" data-channel="{{ $code }}" id="va_{{ $code }}" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                        <label for="va_{{ $code }}" class="payment-label" onclick="setTimeout(updatePaymentButton, 10)">
                                            <div class="payment-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="payment-icon me-3">
                                                        <i class="fas fa-university" style="font-size: 24px; color: #007bff;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $name }}</h6>
                                                        <small class="text-muted">Transfer bank virtual</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- E-Wallet -->
                        <div class="payment-method-group mb-30">
                            <h5 class="mb-20"><i class="fas fa-mobile-alt text-success me-10"></i>E-Wallet</h5>
                            <div class="row">
                                @foreach($paymentMethods['ewallet'] as $code => $name)
                                <div class="col-md-6 mb-15">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_selection" value="ewallet" data-channel="{{ $code }}" id="ew_{{ $code }}" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                        <label for="ew_{{ $code }}" class="payment-label" onclick="setTimeout(updatePaymentButton, 10)">
                                            <div class="payment-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="payment-icon me-3">
                                                        <i class="fas fa-mobile-alt" style="font-size: 24px; color: #28a745;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $name }}</h6>
                                                        <small class="text-muted">Dompet digital</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- QR Code -->
                        <div class="payment-method-group mb-30">
                            <h5 class="mb-20"><i class="fas fa-qrcode text-info me-10"></i>QR Code</h5>
                            <div class="row">
                                @foreach($paymentMethods['qr_code'] as $code => $name)
                                <div class="col-md-6 mb-15">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_selection" value="qr_code" data-channel="{{ $code }}" id="qr_{{ $code }}" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                        <label for="qr_{{ $code }}" class="payment-label" onclick="setTimeout(updatePaymentButton, 10)">
                                            <div class="payment-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="payment-icon me-3">
                                                        <i class="fas fa-qrcode" style="font-size: 24px; color: #17a2b8;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $name }}</h6>
                                                        <small class="text-muted">Scan QR untuk bayar</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Credit Card -->
                        <div class="payment-method-group mb-40">
                            <h5 class="mb-20"><i class="fas fa-credit-card text-warning me-10"></i>Kartu Kredit</h5>
                            <div class="row">
                                <div class="col-md-12 mb-15">
                                    <div class="payment-option">
                                        <input type="radio" name="payment_selection" value="credit_card" data-channel="credit_card" id="cc_all" class="payment-radio" onclick="updatePaymentButton()" onchange="updatePaymentButton()">
                                        <label for="cc_all" class="payment-label" onclick="setTimeout(updatePaymentButton, 10)">
                                            <div class="payment-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="payment-icon me-3">
                                                        <i class="fas fa-credit-card" style="font-size: 24px; color: #ffc107;"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Kartu Kredit</h6>
                                                        <small class="text-muted">Visa, Mastercard, JCB, Amex</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="payment_method" id="payment_method">
                        <input type="hidden" name="payment_channel" id="payment_channel">

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-secondary btn-lg px-50" id="payButton" disabled onclick="return checkPayment()">
                                <i class="fas fa-lock me-10"></i>Pilih Metode Pembayaran
                            </button>
                        </div>
                        
                        <!-- Inline JavaScript for immediate testing -->
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
                                button.className = 'btn btn-primary btn-lg px-50';
                                button.innerHTML = '💳 Bayar Sekarang - Rp {{ number_format($booking->total_price * 15000, 0, ",", ".") }}';
                            } else {
                                button.disabled = true;
                                button.className = 'btn btn-secondary btn-lg px-50';
                                button.innerHTML = '🔒 Pilih Metode Pembayaran';
                            }
                        }
                        </script>
                    </form>

                    <!-- Security Info -->
                    <div class="security-info mt-40 pt-30 text-center" style="border-top: 1px solid #eee;">
                        <div class="row">
                            <div class="col-md-4 mb-20">
                                <i class="fas fa-shield-alt text-success mb-10" style="font-size: 24px;"></i>
                                <h6>Aman & Terpercaya</h6>
                                <small class="text-muted">Pembayaran diproses dengan teknologi enkripsi SSL</small>
                            </div>
                            <div class="col-md-4 mb-20">
                                <i class="fas fa-clock text-primary mb-10" style="font-size: 24px;"></i>
                                <h6>Berlaku 24 Jam</h6>
                                <small class="text-muted">Selesaikan pembayaran dalam 24 jam</small>
                            </div>
                            <div class="col-md-4 mb-20">
                                <i class="fas fa-headset text-info mb-10" style="font-size: 24px;"></i>
                                <h6>Bantuan 24/7</h6>
                                <small class="text-muted">Tim support siap membantu Anda</small>
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
/* Hide radio buttons */
.payment-radio {
    display: none !important;
}

/* Payment item styling */
.payment-item {
    border: 2px solid #eee !important;
    border-radius: 10px;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.payment-item:hover {
    border-color: #007bff !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.1);
}

/* Selected state */
input[name="payment_selection"]:checked + .payment-label .payment-item {
    border-color: #007bff !important;
    background-color: #f8f9ff !important;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

/* Checkmark for selected */
.payment-option {
    position: relative;
}

input[name="payment_selection"]:checked + .payment-label::after {
    content: '✓';
    position: absolute;
    top: 10px;
    right: 15px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: bold;
    z-index: 10;
}

/* Button states */
#payButton {
    transition: all 0.3s ease;
}

#payButton:disabled {
    opacity: 0.6;
    cursor: not-allowed !important;
}

#payButton:not(:disabled) {
    opacity: 1;
    cursor: pointer;
}

/* Animation */
.payment-card {
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

@media (max-width: 768px) {
    .payment-card {
        padding: 20px;
    }
    
    .px-50 {
        padding-left: 30px !important;
        padding-right: 30px !important;
    }
}
</style>
@endpush

@push('after-script')
<script>
// Simple approach - just call updatePaymentButton when page loads
window.onload = function() {
    updatePaymentButton(); // Initial call
};
</script>
@endpush
@endsection