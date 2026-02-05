@extends('layouts.frontsite')

@section('title', 'Status Pembayaran | Opsi Liburan Indonesia')

@section('content')
<div class="payment-status-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="status-card">
                    
                    <!-- Header with Status -->
                    <div class="status-header text-center mb-4">
                        <!-- Status Icon -->
                        <div class="status-icon mb-3">
                            @if($payment->status === 'paid')
                                <i class="fas fa-check-circle text-success"></i>
                            @elseif($payment->status === 'pending')
                                <i class="fas fa-clock text-warning"></i>
                            @elseif($payment->status === 'expired')
                                <i class="fas fa-times-circle text-secondary"></i>
                            @elseif($payment->status === 'cancelled')
                                <i class="fas fa-ban text-dark"></i>
                            @else
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                            @endif
                        </div>
                        
                        <h1 class="mb-2">Status Pembayaran</h1>
                        <p class="text-muted mb-3">Kode Pembayaran: <strong class="text-primary">{{ $payment->payment_code }}</strong></p>
                        
                        <!-- Status Badge -->
                        <div class="status-badge-wrapper">
                            <span class="status-badge status-{{ $payment->status }}" id="statusBadge">
                                {{ $payment->status_label }}
                            </span>
                        </div>
                    </div>

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Alert Messages -->
                    <div id="paymentStatusContent" class="mb-4">
                        @if($payment->status === 'pending')
                            <div class="alert-card alert-warning">
                                <div class="alert-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="alert-content">
                                    <h5 class="alert-title">Menunggu Pembayaran</h5>
                                    <p class="alert-text">Silakan selesaikan pembayaran Anda. Halaman ini akan otomatis diperbarui ketika pembayaran berhasil.</p>
                                </div>
                            </div>
                            
                            @if($payment->payment_details && isset($payment->payment_details['invoice_url']))
                            <div class="payment-action text-center mb-4">
                                <a href="{{ $payment->payment_details['invoice_url'] }}" class="btn btn-primary btn-lg mb-2" target="_blank">
                                    <i class="fas fa-external-link-alt me-2"></i>Lanjutkan Pembayaran di Xendit
                                </a>
                                <p class="text-muted mb-0">
                                    <small><i class="fas fa-info-circle me-1"></i>Anda akan diarahkan ke halaman pembayaran Xendit yang aman</small>
                                </p>
                            </div>
                            @elseif($payment->xendit_response && isset($payment->xendit_response['invoice_url']))
                            <div class="payment-action text-center mb-4">
                                <a href="{{ $payment->xendit_response['invoice_url'] }}" class="btn btn-primary btn-lg mb-2" target="_blank">
                                    <i class="fas fa-external-link-alt me-2"></i>Lanjutkan Pembayaran di Xendit
                                </a>
                                <p class="text-muted mb-0">
                                    <small><i class="fas fa-info-circle me-1"></i>Anda akan diarahkan ke halaman pembayaran Xendit yang aman</small>
                                </p>
                            </div>
                            @endif

                            <!-- Auto refresh countdown -->
                            <div class="auto-refresh-card">
                                <i class="fas fa-sync-alt me-2"></i>
                                <span>Halaman akan diperbarui otomatis dalam <strong id="countdown">30</strong> detik</span>
                            </div>
                        @elseif($payment->status === 'paid')
                            <div class="alert-card alert-success">
                                <div class="alert-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="alert-content">
                                    <h5 class="alert-title">Pembayaran Berhasil!</h5>
                                    <p class="alert-text">Terima kasih! Pembayaran Anda telah berhasil diproses pada {{ $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : 'N/A' }}.</p>
                                </div>
                            </div>
                        @elseif($payment->status === 'expired')
                            <div class="alert-card alert-secondary">
                                <div class="alert-icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="alert-content">
                                    <h5 class="alert-title">Pembayaran Kadaluarsa</h5>
                                    <p class="alert-text">Waktu pembayaran telah habis. Silakan buat pesanan baru atau hubungi customer service.</p>
                                </div>
                            </div>
                        @elseif($payment->status === 'failed')
                            <div class="alert-card alert-danger">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="alert-content">
                                    <h5 class="alert-title">Pembayaran Gagal</h5>
                                    <p class="alert-text">{{ $payment->failure_reason ?? 'Pembayaran tidak dapat diproses. Silakan coba lagi atau hubungi customer service.' }}</p>
                                </div>
                            </div>
                        @elseif($payment->status === 'cancelled')
                            <div class="alert-card alert-dark">
                                <div class="alert-icon">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <div class="alert-content">
                                    <h5 class="alert-title">Pembayaran Dibatalkan</h5>
                                    <p class="alert-text">{{ $payment->failure_reason ?? 'Pembayaran telah dibatalkan. Anda dapat membuat pesanan baru jika diperlukan.' }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Payment Information -->
                    <div class="row g-4 mb-4">
                        <!-- Booking Details -->
                        <div class="col-md-6">
                            <div class="detail-card">
                                <div class="card-header header-primary">
                                    <i class="fas fa-ticket-alt me-2"></i>
                                    <h3 class="text-white">Detail Pesanan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="info-group mb-3">
                                        <label>Nama Tour</label>
                                        <p>{{ $payment->booking->tour->title }}</p>
                                    </div>
                                    <div class="info-group mb-3">
                                        <label>Kode Booking</label>
                                        <p class="code-text">{{ $payment->booking->booking_code }}</p>
                                    </div>
                                    <div class="info-group mb-3">
                                        <label>Nama Pemesan</label>
                                        <p>{{ $payment->booking->name }}</p>
                                    </div>
                                    <div class="info-group mb-0">
                                        <label>Jumlah Peserta</label>
                                        <p><span class="badge bg-info">{{ $payment->booking->travelers }} orang</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="col-md-6">
                            <div class="detail-card">
                                <div class="card-header header-success">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    <h3 class="text-white">Detail Pembayaran</h3>
                                </div>
                                <div class="card-body">
                                    <div class="info-group mb-3">
                                        <label>Total Pembayaran</label>
                                        <p class="amount-text">{{ $payment->formatted_amount }}</p>
                                    </div>
                                    <div class="info-group mb-3">
                                        <label>Status Pembayaran</label>
                                        <p>
                                            <span class="badge status-badge-sm status-{{ $payment->status }}">
                                                {{ $payment->status_label }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="info-group mb-3">
                                        <label>Berlaku Hingga</label>
                                        <p>{{ $payment->expired_at ? $payment->expired_at->format('d M Y H:i') : 'N/A' }}</p>
                                    </div>
                                    @if($payment->paid_at)
                                    <div class="info-group mb-0">
                                        <label>Dibayar Pada</label>
                                        <p class="text-success fw-bold">{{ $payment->paid_at->format('d M Y H:i') }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons-wrapper">
                        <div class="action-buttons">
                            @if($payment->status === 'pending')
                                <form action="{{ route('frontsite.payment.cancel', $payment->payment_code) }}" method="POST" class="d-inline" id="cancelPaymentForm" onsubmit="return confirmCancel(event)">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" id="cancelButton">
                                        <i class="fas fa-times me-2"></i>Batalkan Pembayaran
                                    </button>
                                </form>
                            @endif
                            
                            @if($payment->status === 'paid')
                                <a href="{{ route('frontsite.booking.show', $payment->booking->booking_code) }}" class="btn btn-success">
                                    <i class="fas fa-eye me-2"></i>Lihat Detail Booking
                                </a>
                            @endif
                            
                            @if(in_array($payment->status, ['expired', 'failed', 'cancelled']))
                                <a href="{{ route('frontsite.payment.show', $payment->booking->booking_code) }}" class="btn btn-primary">
                                    <i class="fas fa-redo me-2"></i>Coba Lagi
                                </a>
                            @endif
                            
                            <a href="{{ route('frontsite.home.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support text-center mt-5">
                        <h5 class="mb-3">Butuh Bantuan?</h5>
                        <p class="text-muted mb-3">Jika Anda mengalami masalah dengan pembayaran, jangan ragu untuk menghubungi kami.</p>
                        <div class="contact-items">
                            <a href="tel:+62123456789" class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+62 123 456 789</span>
                            </a>
                            <a href="mailto:support@opsiliburan.com" class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>support@opsiliburan.com</span>
                            </a>
                            <a href="https://wa.me/62123456789" class="contact-item" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span>WhatsApp Support</span>
                            </a>
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
/* Variables */
:root {
    --primary-color: #007bff;
    --success-color: #28a745;
    --info-color: #17a2b8;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --secondary-color: #6c757d;
    --light-bg: #f8f9fa;
    --border-color: #dee2e6;
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
    --border-radius: 12px;
    --transition: all 0.3s ease;
}

/* Main Container */
.payment-status-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 60px 0;
}

.status-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 40px;
    box-shadow: var(--shadow-lg);
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

/* Header */
.status-header .status-icon {
    font-size: 80px;
    animation: scaleIn 0.5s ease-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}

.status-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
}

/* Status Badge */
.status-badge-wrapper {
    display: inline-block;
}

.status-badge {
    display: inline-block;
    padding: 12px 32px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: var(--shadow-md);
    animation: pulse 2s infinite;
}

.status-badge.status-paid {
    background: linear-gradient(135deg, var(--success-color), #1e7e34);
    color: white;
}

.status-badge.status-pending {
    background: linear-gradient(135deg, var(--warning-color), #e0a800);
    color: #856404;
}

.status-badge.status-expired {
    background: linear-gradient(135deg, var(--secondary-color), #545b62);
    color: white;
}

.status-badge.status-failed {
    background: linear-gradient(135deg, var(--danger-color), #c82333);
    color: white;
}

.status-badge.status-cancelled {
    background: linear-gradient(135deg, #343a40, #23272b);
    color: white;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

/* Alert Cards */
.alert-card {
    display: flex;
    gap: 20px;
    padding: 24px;
    border-radius: var(--border-radius);
    margin-bottom: 24px;
    animation: slideInDown 0.5s ease-out;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-card.alert-warning {
    background: linear-gradient(135deg, #fff3cd 0%, #fff9e6 100%);
    border-left: 4px solid var(--warning-color);
}

.alert-card.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #e8f5e9 100%);
    border-left: 4px solid var(--success-color);
}

.alert-card.alert-secondary {
    background: linear-gradient(135deg, #e2e3e5 0%, #f0f0f0 100%);
    border-left: 4px solid var(--secondary-color);
}

.alert-card.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #ffe0e0 100%);
    border-left: 4px solid var(--danger-color);
}

.alert-card.alert-dark {
    background: linear-gradient(135deg, #d6d8db 0%, #e2e3e5 100%);
    border-left: 4px solid #343a40;
}

.alert-icon {
    font-size: 48px;
    flex-shrink: 0;
}

.alert-card.alert-warning .alert-icon {
    color: var(--warning-color);
}

.alert-card.alert-success .alert-icon {
    color: var(--success-color);
}

.alert-card.alert-secondary .alert-icon {
    color: var(--secondary-color);
}

.alert-card.alert-danger .alert-icon {
    color: var(--danger-color);
}

.alert-card.alert-dark .alert-icon {
    color: #343a40;
}

.alert-content {
    flex: 1;
}

.alert-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #2c3e50;
}

.alert-text {
    margin: 0;
    color: #495057;
    line-height: 1.6;
}

/* Auto Refresh Card */
.auto-refresh-card {
    text-align: center;
    padding: 16px;
    background: var(--light-bg);
    border-radius: 8px;
    border: 1px dashed var(--border-color);
    color: #6c757d;
}

.auto-refresh-card i {
    animation: rotate 2s linear infinite;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Detail Cards */
.detail-card {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: var(--transition);
    height: 100%;
}

.detail-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.card-header {
    padding: 16px 20px;
    display: flex;
    align-items: center;
    border: none;
    color: white;
}

.card-header.header-primary {
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
}

.card-header.header-success {
    background: linear-gradient(135deg, var(--success-color), #1e7e34);
}

.card-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.card-body {
    padding: 24px;
}

/* Info Groups */
.info-group {
    margin-bottom: 0;
}

.info-group label {
    display: block;
    font-weight: 600;
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 6px;
}

.info-group p {
    margin: 0;
    color: #2c3e50;
    font-size: 1rem;
}

.code-text {
    font-family: 'Courier New', monospace;
    background: var(--light-bg);
    padding: 8px 12px;
    border-radius: 6px;
    display: inline-block;
    font-weight: 600;
    color: var(--primary-color);
}

.amount-text {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--success-color);
}

.status-badge-sm {
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

/* Buttons */
.btn {
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    transition: var(--transition);
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
}

.btn-success {
    background: linear-gradient(135deg, var(--success-color), #1e7e34);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #1e7e34, #145523);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
}

.btn-outline-danger {
    border: 2px solid var(--danger-color);
    color: var(--danger-color);
    background: white;
}

.btn-outline-danger:hover {
    background: var(--danger-color);
    color: white;
    transform: translateY(-2px);
}

.btn-outline-secondary {
    border: 2px solid var(--border-color);
    color: var(--secondary-color);
    background: white;
}

.btn-outline-secondary:hover {
    background: var(--light-bg);
    border-color: var(--secondary-color);
    color: var(--secondary-color);
}

/* Action Buttons */
.action-buttons-wrapper {
    border-top: 1px solid var(--border-color);
    padding-top: 24px;
    margin-bottom: 24px;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
}

/* Contact Support */
.contact-support h5 {
    font-weight: 700;
    color: #2c3e50;
}

.contact-items {
    display: flex;
    justify-content: center;
    gap: 24px;
    flex-wrap: wrap;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: var(--light-bg);
    border-radius: 50px;
    text-decoration: none;
    color: #2c3e50;
    transition: var(--transition);
    font-size: 0.9rem;
}

.contact-item:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.contact-item i {
    font-size: 18px;
}

/* Payment Action */
.payment-action {
    padding: 24px;
    background: linear-gradient(135deg, #e3f2fd 0%, #f0f9ff 100%);
    border-radius: var(--border-radius);
    border: 2px dashed var(--primary-color);
}

/* Responsive */
@media (max-width: 768px) {
    .status-card {
        padding: 24px;
    }
    
    .status-header h1 {
        font-size: 1.5rem;
    }
    
    .status-header .status-icon {
        font-size: 60px;
    }
    
    .status-badge {
        font-size: 1rem;
        padding: 10px 24px;
    }
    
    .alert-card {
        flex-direction: column;
        text-align: center;
    }
    
    .alert-icon {
        font-size: 36px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
    
    .contact-items {
        flex-direction: column;
        align-items: stretch;
    }
    
    .contact-item {
        justify-content: center;
    }
    
    .amount-text {
        font-size: 1.25rem;
    }
}

@media (max-width: 576px) {
    .status-card {
        padding: 20px;
    }
    
    .payment-status-section {
        padding: 40px 0;
    }
}

/* Loading States */
.btn-loading {
    position: relative;
    pointer-events: none;
    opacity: 0.7;
}

.btn-loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    border: 2px solid #ffffff;
    border-radius: 50%;
    border-top-color: transparent;
    animation: spinner 0.6s linear infinite;
}

@keyframes spinner {
    to {
        transform: rotate(360deg);
    }
}

/* Smooth Transitions */
* {
    transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
}

button, a {
    transition: all 0.3s ease;
}
</style>
@endpush

@push('after-script')
<script>
// Cancel payment confirmation and debugging
function confirmCancel(event) {
    console.log('Cancel payment form submitted');
    console.log('Event:', event);
    console.log('Form:', event.target);
    
    const confirmed = confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?');
    
    if (confirmed) {
        console.log('User confirmed cancellation');
        const button = document.getElementById('cancelButton');
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Membatalkan...';
            button.classList.add('btn-loading');
        }
        
        // Add additional debugging
        const form = event.target;
        console.log('Form action:', form.action);
        console.log('Form method:', form.method);
        console.log('CSRF token:', form.querySelector('input[name="_token"]')?.value);
        
        return true;
    } else {
        console.log('User cancelled the cancellation');
        event.preventDefault();
        return false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const paymentCode = '{{ $payment->payment_code }}';
    const currentStatus = '{{ $payment->status }}';
    
    console.log('Payment status page loaded', {
        paymentCode: paymentCode,
        currentStatus: currentStatus
    });
    
    // Check if cancel form exists
    const cancelForm = document.getElementById('cancelPaymentForm');
    if (cancelForm) {
        console.log('Cancel form found', {
            action: cancelForm.action,
            method: cancelForm.method
        });
        
        // Add additional debugging
        cancelForm.addEventListener('submit', function(e) {
            console.log('Form submit event triggered');
            console.log('Form data:', new FormData(this));
        });
    } else {
        console.log('Cancel form not found - payment status might not be pending');
    }
    
    // Auto refresh for pending payments
    if (currentStatus === 'pending') {
        let countdown = 30;
        let maxRetries = 10; // Maksimum 10 kali retry (5 menit)
        let retryCount = 0;
        const countdownElement = document.getElementById('countdown');
        
        const countdownInterval = setInterval(() => {
            countdown--;
            if (countdownElement) {
                countdownElement.textContent = countdown;
            }
            
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                checkPaymentStatus();
            }
        }, 1000);
        
        // Check payment status
        function checkPaymentStatus() {
            // Stop polling if max retries reached
            if (retryCount >= maxRetries) {
                console.log('Max retries reached, stopping payment status check');
                if (countdownElement) {
                    countdownElement.parentElement.innerHTML = '<i class="fas fa-info-circle me-2"></i><span>Refresh halaman untuk memeriksa status terbaru</span>';
                }
                return;
            }
            
            retryCount++;
            
            fetch(`{{ route('frontsite.payment.check-status', $payment->payment_code) }}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Payment status check result:', data);
                    if (data.status !== currentStatus) {
                        // Status changed, show loading and reload page
                        showPageReloading();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else if (data.status === 'pending' && !data.is_expired && retryCount < maxRetries) {
                        // Still pending, restart countdown
                        countdown = 30;
                        setTimeout(() => {
                            const newInterval = setInterval(() => {
                                countdown--;
                                if (countdownElement) {
                                    countdownElement.textContent = countdown;
                                }
                                
                                if (countdown <= 0) {
                                    clearInterval(newInterval);
                                    checkPaymentStatus();
                                }
                            }, 1000);
                        }, 100);
                    }
                })
                .catch(error => {
                    console.error('Error checking payment status:', error);
                    // Retry after 30 seconds only if under max retries
                    if (retryCount < maxRetries) {
                        countdown = 30;
                        setTimeout(checkPaymentStatus, 30000);
                    }
                });
        }
        
        function showPageReloading() {
            const overlay = document.createElement('div');
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            `;
            overlay.innerHTML = `
                <div style="text-align: center; color: white;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 48px; margin-bottom: 16px;"></i>
                    <p style="font-size: 18px; font-weight: 600;">Status pembayaran berubah, memuat ulang...</p>
                </div>
            `;
            document.body.appendChild(overlay);
        }
    }
    
    // Add smooth scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    // Add entrance animation to cards
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.detail-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
    });
});
</script>
@endpush
@endsection