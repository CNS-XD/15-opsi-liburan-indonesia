@extends('layouts.frontsite')

@section('title', 'Pembayaran Gagal | Opsi Liburan Indonesia')

@section('content')
<div class="payment-failed-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-failed-card text-center p-50" style="border: 1px solid #eee; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <!-- Failed Icon -->
                    <div class="failed-icon mb-30">
                        <i class="fas fa-times-circle text-danger" style="font-size: 80px;"></i>
                    </div>

                    <!-- Failed Message -->
                    <h1 class="text-danger mb-20">Pembayaran Gagal</h1>
                    <p class="lead mb-30">Maaf, pembayaran Anda tidak dapat diproses. Silakan coba lagi atau hubungi customer service kami.</p>

                    <!-- Payment Details -->
                    <div class="payment-details mb-40 p-30" style="background: #f8f9fa; border-radius: 10px; text-align: left;">
                        <h4 class="mb-20 text-center">Detail Pembayaran</h4>
                        
                        <div class="row">
                            <div class="col-md-6 mb-15">
                                <strong>Payment Code:</strong>
                                <span class="text-primary">{{ $payment->payment_code }}</span>
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Booking Code:</strong>
                                <span class="text-primary">{{ $payment->booking->booking_code }}</span>
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Tour:</strong>
                                {{ $payment->booking->tour->title }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Nama:</strong>
                                {{ $payment->booking->name }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Email:</strong>
                                {{ $payment->booking->email }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Jumlah Peserta:</strong>
                                {{ $payment->booking->travelers }} orang
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Total Pembayaran:</strong>
                                <span class="text-danger fw-bold">{{ $payment->formatted_amount }}</span>
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Status:</strong>
                                <span class="badge bg-danger">{{ $payment->status_label }}</span>
                            </div>
                            @if($payment->failure_reason)
                            <div class="col-12 mb-15">
                                <strong>Alasan Kegagalan:</strong>
                                <p class="mb-0 text-danger">{{ $payment->failure_reason }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Possible Reasons -->
                    <div class="possible-reasons mb-40">
                        <h4 class="mb-20">Kemungkinan Penyebab</h4>
                        <div class="row text-start">
                            <div class="col-md-6 mb-20">
                                <div class="reason-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="reason-icon mb-15">
                                        <i class="fas fa-credit-card text-warning" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>Masalah Kartu/Rekening</h6>
                                    <ul class="small mb-0">
                                        <li>Saldo tidak mencukupi</li>
                                        <li>Kartu kadaluarsa atau diblokir</li>
                                        <li>Limit transaksi terlampaui</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 mb-20">
                                <div class="reason-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="reason-icon mb-15">
                                        <i class="fas fa-wifi text-warning" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>Masalah Teknis</h6>
                                    <ul class="small mb-0">
                                        <li>Koneksi internet terputus</li>
                                        <li>Timeout saat proses pembayaran</li>
                                        <li>Gangguan sistem bank</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Solutions -->
                    <div class="solutions mb-40">
                        <h4 class="mb-20">Solusi yang Dapat Dicoba</h4>
                        <div class="row text-start">
                            <div class="col-md-4 mb-20">
                                <div class="solution-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="solution-icon mb-15">
                                        <i class="fas fa-redo text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>1. Coba Lagi</h6>
                                    <p class="mb-0 small">Ulangi proses pembayaran dengan metode yang sama atau berbeda.</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-20">
                                <div class="solution-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="solution-icon mb-15">
                                        <i class="fas fa-exchange-alt text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>2. Ganti Metode</h6>
                                    <p class="mb-0 small">Gunakan metode pembayaran lain yang tersedia.</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-20">
                                <div class="solution-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="solution-icon mb-15">
                                        <i class="fas fa-headset text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>3. Hubungi Kami</h6>
                                    <p class="mb-0 small">Tim support siap membantu menyelesaikan masalah Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons mb-30">
                        <a href="{{ route('frontsite.payment.show', $payment->booking->booking_code) }}" class="btn btn-primary me-15">
                            <i class="fas fa-redo me-5"></i>Coba Lagi
                        </a>
                        <a href="{{ route('frontsite.booking.show', $payment->booking->booking_code) }}" class="btn btn-outline-secondary me-15">
                            <i class="fas fa-eye me-5"></i>Lihat Booking
                        </a>
                        <a href="{{ route('index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-5"></i>Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Important Notes -->
                    <div class="important-notes p-20" style="background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 10px;">
                        <h6 class="text-danger mb-15"><i class="fas fa-exclamation-triangle me-5"></i>Catatan Penting</h6>
                        <ul class="text-start mb-0">
                            <li>Booking Anda masih tersimpan dan dapat dibayar kembali</li>
                            <li>Tidak ada biaya tambahan untuk mencoba pembayaran ulang</li>
                            <li>Hubungi bank Anda jika masalah terus berlanjut</li>
                            <li>Tim support kami siap membantu 24/7</li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-info mt-40 pt-30" style="border-top: 1px solid #eee;">
                        <h5 class="mb-20">Butuh Bantuan Segera?</h5>
                        <p class="mb-20">Tim customer service kami siap membantu menyelesaikan masalah pembayaran Anda.</p>
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
.payment-failed-card {
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

.reason-item, .solution-item {
    transition: transform 0.3s ease;
}

.reason-item:hover, .solution-item:hover {
    transform: translateY(-5px);
}

.failed-icon {
    animation: shake 0.8s ease-out;
}

@keyframes shake {
    0%, 20%, 40%, 60%, 80%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-5px);
    }
}

@media (max-width: 768px) {
    .payment-failed-card {
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