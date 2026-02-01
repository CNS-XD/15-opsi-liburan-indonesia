@extends('layouts.frontsite')

@section('title', 'Status Pembayaran | Opsi Liburan Indonesia')

@section('content')
<div class="payment-status-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-status-card p-40" style="border: 1px solid #eee; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <div class="payment-header text-center mb-40">
                        <h1 class="mb-10">Status Pembayaran</h1>
                        <p class="text-muted">Payment Code: <strong class="text-primary">{{ $payment->payment_code }}</strong></p>
                        
                        <!-- Status Badge -->
                        <div class="status-badge mt-20">
                            <span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'expired' ? 'secondary' : 'warning') }} px-3 py-2" id="statusBadge">
                                {{ $payment->status_label }}
                            </span>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="payment-info mb-40">
                        <div class="row">
                            <!-- Booking Details -->
                            <div class="col-md-6 mb-30">
                                <div class="info-section p-20" style="background: #f8f9fa; border-radius: 10px; height: 100%;">
                                    <h4 class="mb-20">Detail Pesanan</h4>
                                    <div class="info-item mb-15">
                                        <strong>Tour:</strong>
                                        <p class="mb-0">{{ $payment->booking->tour->title }}</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Booking Code:</strong>
                                        <p class="mb-0">{{ $payment->booking->booking_code }}</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Nama:</strong>
                                        <p class="mb-0">{{ $payment->booking->name }}</p>
                                    </div>
                                    <div class="info-item">
                                        <strong>Jumlah Peserta:</strong>
                                        <p class="mb-0">{{ $payment->booking->travelers }} orang</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Details -->
                            <div class="col-md-6 mb-30">
                                <div class="info-section p-20" style="background: #f8f9fa; border-radius: 10px; height: 100%;">
                                    <h4 class="mb-20">Detail Pembayaran</h4>
                                    <div class="info-item mb-15">
                                        <strong>Jumlah:</strong>
                                        <p class="mb-0 text-primary fw-bold">{{ $payment->formatted_amount }}</p>
                                    </div>
                                    <div class="info-item mb-15">
                                        <strong>Status:</strong>
                                        <p class="mb-0">{{ $payment->status_label }}</p>
                                    </div>
                                    <div class="info-item">
                                        <strong>Berlaku Hingga:</strong>
                                        <p class="mb-0">{{ $payment->expired_at ? $payment->expired_at->format('d M Y H:i') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status Content -->
                    <div id="paymentStatusContent">
                        @if($payment->status === 'pending')
                            <div class="pending-payment mb-40">
                                <div class="alert alert-warning">
                                    <h5 class="alert-heading"><i class="fas fa-clock me-10"></i>Menunggu Pembayaran</h5>
                                    <p class="mb-0">Silakan selesaikan pembayaran Anda. Halaman ini akan otomatis diperbarui ketika pembayaran berhasil.</p>
                                </div>
                                
                                @if($payment->payment_details && isset($payment->payment_details['invoice_url']))
                                <div class="payment-action text-center mb-30">
                                    <a href="{{ $payment->payment_details['invoice_url'] }}" class="btn btn-primary btn-lg" target="_blank">
                                        <i class="fas fa-external-link-alt me-10"></i>Lanjutkan Pembayaran di Xendit
                                    </a>
                                    <p class="mt-15 text-muted">
                                        <small>Anda akan diarahkan ke halaman pembayaran Xendit yang aman</small>
                                    </p>
                                </div>
                                @elseif($payment->xendit_response && isset($payment->xendit_response['invoice_url']))
                                <div class="payment-action text-center mb-30">
                                    <a href="{{ $payment->xendit_response['invoice_url'] }}" class="btn btn-primary btn-lg" target="_blank">
                                        <i class="fas fa-external-link-alt me-10"></i>Lanjutkan Pembayaran di Xendit
                                    </a>
                                    <p class="mt-15 text-muted">
                                        <small>Anda akan diarahkan ke halaman pembayaran Xendit yang aman</small>
                                    </p>
                                </div>
                                @endif

                                <!-- Auto refresh countdown -->
                                <div class="auto-refresh text-center">
                                    <small class="text-muted">
                                        <i class="fas fa-sync-alt me-5"></i>
                                        Halaman akan diperbarui otomatis dalam <span id="countdown">30</span> detik
                                    </small>
                                </div>
                            </div>
                        @elseif($payment->status === 'paid')
                            <div class="paid-payment mb-40">
                                <div class="alert alert-success">
                                    <h5 class="alert-heading"><i class="fas fa-check-circle me-10"></i>Pembayaran Berhasil!</h5>
                                    <p class="mb-0">Terima kasih! Pembayaran Anda telah berhasil diproses pada {{ $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : 'N/A' }}.</p>
                                </div>
                            </div>
                        @elseif($payment->status === 'expired')
                            <div class="expired-payment mb-40">
                                <div class="alert alert-secondary">
                                    <h5 class="alert-heading"><i class="fas fa-times-circle me-10"></i>Pembayaran Kadaluarsa</h5>
                                    <p class="mb-0">Waktu pembayaran telah habis. Silakan buat pesanan baru atau hubungi customer service.</p>
                                </div>
                            </div>
                        @elseif($payment->status === 'failed')
                            <div class="failed-payment mb-40">
                                <div class="alert alert-danger">
                                    <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-10"></i>Pembayaran Gagal</h5>
                                    <p class="mb-0">{{ $payment->failure_reason ?? 'Pembayaran tidak dapat diproses. Silakan coba lagi atau hubungi customer service.' }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons text-center mb-30">
                        @if($payment->status === 'pending')
                            <form action="{{ route('frontsite.payment.cancel', $payment->payment_code) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pembayaran ini?')">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger me-15">
                                    <i class="fas fa-times me-5"></i>Batalkan Pembayaran
                                </button>
                            </form>
                        @endif
                        
                        @if($payment->status === 'paid')
                            <a href="{{ route('frontsite.booking.show', $payment->booking->booking_code) }}" class="btn btn-success me-15">
                                <i class="fas fa-eye me-5"></i>Lihat Detail Booking
                            </a>
                        @endif
                        
                        @if(in_array($payment->status, ['expired', 'failed']))
                            <a href="{{ route('frontsite.payment.show', $payment->booking->booking_code) }}" class="btn btn-primary me-15">
                                <i class="fas fa-redo me-5"></i>Coba Lagi
                            </a>
                        @endif
                        
                        <a href="{{ route('index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-5"></i>Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support pt-30 text-center" style="border-top: 1px solid #eee;">
                        <h5 class="mb-20">Butuh Bantuan?</h5>
                        <p class="mb-20">Jika Anda mengalami masalah dengan pembayaran, jangan ragu untuk menghubungi kami.</p>
                        <div class="contact-items d-flex justify-content-center gap-30 flex-wrap">
                            <div class="contact-item">
                                <i class="fas fa-phone text-primary me-5"></i>
                                <span>+62 123 456 789</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope text-primary me-5"></i>
                                <span>support@opsiliburan.com</span>
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
.payment-status-card {
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

@media (max-width: 768px) {
    .payment-status-card {
        padding: 20px;
    }
    
    .contact-items {
        flex-direction: column;
        gap: 15px !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentCode = '{{ $payment->payment_code }}';
    const currentStatus = '{{ $payment->status }}';
    
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
                    countdownElement.textContent = 'Stopped checking';
                }
                return;
            }
            
            retryCount++;
            
            fetch(`{{ route('frontsite.payment.check-status', $payment->payment_code) }}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status !== currentStatus) {
                        // Status changed, reload page
                        window.location.reload();
                    } else if (data.status === 'pending' && !data.is_expired && retryCount < maxRetries) {
                        // Still pending, restart countdown
                        countdown = 30;
                        setTimeout(checkPaymentStatus, 30000);
                    }
                })
                .catch(error => {
                    console.error('Error checking payment status:', error);
                    // Retry after 30 seconds only if under max retries
                    if (retryCount < maxRetries) {
                        setTimeout(checkPaymentStatus, 30000);
                    }
                });
        }
    }
});
</script>
@endpush
@endsection