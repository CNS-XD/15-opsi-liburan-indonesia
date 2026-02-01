@extends('layouts.frontsite')

@section('title', 'Pembayaran Berhasil | Opsi Liburan Indonesia')

@section('content')
<div class="payment-success-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-success-card text-center p-50" style="border: 1px solid #eee; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <!-- Success Icon -->
                    <div class="success-icon mb-30">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>

                    <!-- Success Message -->
                    <h1 class="text-success mb-20">Pembayaran Berhasil!</h1>
                    <p class="lead mb-30">Terima kasih! Pembayaran Anda telah berhasil diproses dan booking Anda telah dikonfirmasi.</p>

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
                                <strong>Tanggal Tour:</strong>
                                {{ \Carbon\Carbon::parse($payment->booking->preferred_date)->format('d M Y') }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Total Pembayaran:</strong>
                                <span class="text-success fw-bold">{{ $payment->formatted_amount }}</span>
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Metode Pembayaran:</strong>
                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}
                            </div>
                            <div class="col-md-6 mb-15">
                                <strong>Waktu Pembayaran:</strong>
                                {{ $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="next-steps mb-40">
                        <h4 class="mb-20">Langkah Selanjutnya</h4>
                        <div class="row text-start">
                            <div class="col-md-4 mb-20">
                                <div class="step-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="step-icon mb-15">
                                        <i class="fas fa-envelope text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>1. Email Konfirmasi</h6>
                                    <p class="mb-0 small">Anda akan menerima email konfirmasi dengan detail lengkap dalam beberapa menit.</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-20">
                                <div class="step-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="step-icon mb-15">
                                        <i class="fas fa-phone text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>2. Konfirmasi Tim</h6>
                                    <p class="mb-0 small">Tim kami akan menghubungi Anda untuk konfirmasi detail dan persiapan tour.</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-20">
                                <div class="step-item p-20" style="border: 1px solid #eee; border-radius: 10px; height: 100%;">
                                    <div class="step-icon mb-15">
                                        <i class="fas fa-map-marked-alt text-primary" style="font-size: 30px;"></i>
                                    </div>
                                    <h6>3. Persiapan Tour</h6>
                                    <p class="mb-0 small">Kami akan memberikan panduan lengkap dan itinerary detail untuk perjalanan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons mb-30">
                        <a href="{{ route('frontsite.booking.show', $payment->booking->booking_code) }}" class="btn btn-success me-15">
                            <i class="fas fa-eye me-5"></i>Lihat Detail Booking
                        </a>
                        <a href="{{ route('index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-5"></i>Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Important Notes -->
                    <div class="important-notes p-20" style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 10px;">
                        <h6 class="text-warning mb-15"><i class="fas fa-exclamation-triangle me-5"></i>Catatan Penting</h6>
                        <ul class="text-start mb-0">
                            <li>Simpan email konfirmasi dan booking code untuk referensi</li>
                            <li>Pastikan nomor telepon Anda aktif untuk dihubungi tim kami</li>
                            <li>Persiapkan dokumen yang diperlukan sesuai panduan yang akan dikirim</li>
                            <li>Hubungi customer service jika ada pertanyaan atau perubahan</li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-info mt-40 pt-30" style="border-top: 1px solid #eee;">
                        <h5 class="mb-20">Butuh Bantuan?</h5>
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
.payment-success-card {
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

.success-icon {
    animation: bounceIn 1s ease-out;
}

@keyframes bounceIn {
    0% {
        transform: scale(0.3);
        opacity: 0;
    }
    50% {
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .payment-success-card {
        padding: 30px 20px;
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
// Confetti effect for success page
document.addEventListener('DOMContentLoaded', function() {
    // Simple confetti effect (you can use a library like canvas-confetti for better effect)
    setTimeout(() => {
        console.log('🎉 Payment successful! 🎉');
    }, 500);
});
</script>
@endpush
@endsection