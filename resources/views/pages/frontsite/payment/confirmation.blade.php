@extends('layouts.frontsite')

@section('title', 'Konfirmasi Pemesanan | Opsi Liburan Indonesia')

@section('content')
<div class="booking-confirmation-section pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="confirmation-card p-40" style="border: 1px solid #eee; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <div class="confirmation-header text-center mb-40">
                        <h1 class="mb-10">Konfirmasi Pemesanan</h1>
                        <p class="text-muted">Silakan periksa detail pemesanan Anda sebelum melanjutkan ke pembayaran</p>
                        <div class="booking-code mt-20">
                            <span class="badge bg-primary px-3 py-2" style="font-size: 1.1em;">
                                <i class="fas fa-ticket-alt me-2"></i>{{ $booking->booking_code }}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tour Details -->
                        <div class="col-lg-8 mb-40">
                            <div class="tour-details">
                                <!-- Tour Information -->
                                <div class="detail-section mb-30">
                                    <h3 class="section-title mb-20">
                                        <i class="fas fa-map-marked-alt text-primary me-10"></i>Detail Tour
                                    </h3>
                                    <div class="tour-card p-20" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #007bff;">
                                        <div class="row">
                                            @if($booking->tour->tour_photos->count() > 0)
                                            <div class="col-md-4 mb-20">
                                                <img src="{{ Storage::url($booking->tour->tour_photos->first()->photo) }}" 
                                                     alt="{{ $booking->tour->title }}" 
                                                     class="img-fluid rounded"
                                                     style="width: 100%; height: 150px; object-fit: cover;">
                                            </div>
                                            @endif
                                            <div class="col-md-8">
                                                <h4 class="tour-title mb-15">{{ $booking->tour->title }}</h4>
                                                <div class="tour-info">
                                                    <div class="info-item mb-10">
                                                        <i class="fas fa-clock text-muted me-10"></i>
                                                        <strong>Durasi:</strong> {{ $booking->tour->duration }} hari
                                                    </div>
                                                    <div class="info-item mb-10">
                                                        <i class="fas fa-map-marker-alt text-muted me-10"></i>
                                                        <strong>Lokasi:</strong> {{ $booking->tour->location }}
                                                    </div>
                                                    <div class="info-item mb-10">
                                                        <i class="fas fa-users text-muted me-10"></i>
                                                        <strong>Tipe:</strong> {{ $booking->tour->type }}
                                                    </div>
                                                    @if($booking->tour->tour_reviews->count() > 0)
                                                    <div class="info-item">
                                                        <i class="fas fa-star text-warning me-10"></i>
                                                        <strong>Rating:</strong> 
                                                        {{ number_format($booking->tour->tour_reviews->avg('rating'), 1) }}/5 
                                                        ({{ $booking->tour->tour_reviews->count() }} review)
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Information -->
                                <div class="detail-section mb-30">
                                    <h3 class="section-title mb-20">
                                        <i class="fas fa-user text-success me-10"></i>Informasi Pemesan
                                    </h3>
                                    <div class="booking-info p-20" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #28a745;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-item mb-15">
                                                    <strong>Nama Lengkap:</strong>
                                                    <p class="mb-0">{{ $booking->name }}</p>
                                                </div>
                                                <div class="info-item mb-15">
                                                    <strong>Email:</strong>
                                                    <p class="mb-0">{{ $booking->email }}</p>
                                                </div>
                                                <div class="info-item">
                                                    <strong>No. Telepon:</strong>
                                                    <p class="mb-0">{{ $booking->phone }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item mb-15">
                                                    <strong>Tanggal Keberangkatan:</strong>
                                                    <p class="mb-0">{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}</p>
                                                </div>
                                                <div class="info-item mb-15">
                                                    <strong>Jumlah Peserta:</strong>
                                                    <p class="mb-0">{{ $booking->travelers }} orang</p>
                                                </div>
                                                <div class="info-item">
                                                    <strong>Status:</strong>
                                                    <span class="badge bg-warning">{{ ucfirst($booking->status) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($booking->notes)
                                        <div class="booking-notes mt-20 pt-20" style="border-top: 1px solid #dee2e6;">
                                            <strong>Catatan Tambahan:</strong>
                                            <p class="mb-0 mt-10">{{ $booking->notes }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Tour Inclusions -->
                                @if($booking->tour->tour_details->count() > 0)
                                <div class="detail-section mb-30">
                                    <h3 class="section-title mb-20">
                                        <i class="fas fa-check-circle text-info me-10"></i>Yang Termasuk
                                    </h3>
                                    <div class="inclusions p-20" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #17a2b8;">
                                        <div class="row">
                                            @foreach($booking->tour->tour_details as $detail)
                                            <div class="col-md-6 mb-10">
                                                <div class="inclusion-item">
                                                    <i class="fas fa-check text-success me-10"></i>
                                                    {{ $detail->title }}
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Summary -->
                        <div class="col-lg-4">
                            <div class="payment-summary sticky-top" style="top: 120px; z-index: 998;">
                                <div class="summary-card p-20" style="background: #fff; border: 1px solid #eee; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                    <h3 class="summary-title mb-20 text-center">
                                        <i class="fas fa-calculator text-warning me-10"></i>Ringkasan Pembayaran
                                    </h3>
                                    
                                    <div class="price-breakdown">
                                        <div class="price-item d-flex justify-content-between mb-15">
                                            <span>Harga per orang:</span>
                                            <span>${{ number_format($booking->total_price / $booking->travelers, 2) }}</span>
                                        </div>
                                        <div class="price-item d-flex justify-content-between mb-15">
                                            <span>Jumlah peserta:</span>
                                            <span>{{ $booking->travelers }} orang</span>
                                        </div>
                                        <div class="price-item d-flex justify-content-between mb-15">
                                            <span>Subtotal (USD):</span>
                                            <span>${{ number_format($booking->total_price, 2) }}</span>
                                        </div>
                                        <hr>
                                        <div class="price-item d-flex justify-content-between mb-20">
                                            <strong>Total (IDR):</strong>
                                            <strong class="text-primary" style="font-size: 1.2em;">
                                                Rp {{ number_format($idrAmount, 0, ',', '.') }}
                                            </strong>
                                        </div>
                                        <div class="exchange-rate-info text-center mt-15">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-5"></i>
                                                Kurs: 1 USD = Rp {{ number_format($exchangeRate, 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Payment Methods Info -->
                                    <div class="payment-methods mb-20">
                                        <h6 class="mb-15">Metode Pembayaran Tersedia:</h6>
                                        <div class="methods-grid">
                                            <div class="method-item mb-10">
                                                <i class="fas fa-university text-primary me-10"></i>
                                                <small>Virtual Account (BCA, BNI, BRI, Mandiri)</small>
                                            </div>
                                            <div class="method-item mb-10">
                                                <i class="fas fa-mobile-alt text-success me-10"></i>
                                                <small>E-Wallet (OVO, DANA, LinkAja, ShopeePay)</small>
                                            </div>
                                            <div class="method-item mb-10">
                                                <i class="fas fa-qrcode text-warning me-10"></i>
                                                <small>QR Code (QRIS)</small>
                                            </div>
                                            <div class="method-item mb-10">
                                                <i class="fas fa-credit-card text-danger me-10"></i>
                                                <small>Kartu Kredit (Visa, Mastercard)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="action-buttons">
                                        <form action="{{ route('frontsite.payment.create', $booking->booking_code) }}" method="POST" class="mb-15">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                                <i class="fas fa-credit-card me-10"></i>Lanjutkan ke Pembayaran
                                            </button>
                                        </form>
                                        
                                        <a href="{{ route('index') }}" class="btn btn-outline-secondary w-100">
                                            <i class="fas fa-arrow-left me-10"></i>Kembali ke Beranda
                                        </a>
                                    </div>

                                    <!-- Security Info -->
                                    <div class="security-info mt-20 pt-20" style="border-top: 1px solid #eee;">
                                        <div class="text-center">
                                            <small class="text-muted">
                                                <i class="fas fa-shield-alt text-success me-5"></i>
                                                Pembayaran aman dengan enkripsi SSL
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="terms-section mt-40 pt-30" style="border-top: 1px solid #eee;">
                        <h4 class="mb-20">
                            <i class="fas fa-file-contract text-secondary me-10"></i>Syarat dan Ketentuan
                        </h4>
                        <div class="terms-content p-20" style="background: #f8f9fa; border-radius: 10px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="terms-list">
                                        <li>Pembayaran harus dilakukan dalam waktu 24 jam</li>
                                        <li>Konfirmasi booking akan dikirim via email</li>
                                        <li>Pembatalan dapat dilakukan maksimal 7 hari sebelum keberangkatan</li>
                                        <li>Harga sudah termasuk pajak dan biaya layanan</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="terms-list">
                                        <li>Peserta wajib membawa identitas yang valid</li>
                                        <li>Itinerary dapat berubah sesuai kondisi cuaca</li>
                                        <li>Asuransi perjalanan sangat disarankan</li>
                                        <li>Hubungi customer service untuk bantuan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support mt-30 text-center">
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
.confirmation-card {
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

.section-title {
    color: #333;
    font-weight: 600;
    border-bottom: 2px solid #f8f9fa;
    padding-bottom: 10px;
}

.tour-card, .booking-info, .inclusions {
    transition: transform 0.3s ease;
}

.tour-card:hover, .booking-info:hover, .inclusions:hover {
    transform: translateY(-2px);
}

.summary-card {
    transition: box-shadow 0.3s ease;
}

.summary-card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.method-item {
    padding: 5px 0;
    border-bottom: 1px solid #f0f0f0;
}

.method-item:last-child {
    border-bottom: none;
}

.terms-list {
    list-style: none;
    padding-left: 0;
}

.terms-list li {
    padding: 5px 0;
    position: relative;
    padding-left: 20px;
}

.terms-list li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
}

.btn-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #0056b3, #004085);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

@media (max-width: 768px) {
    .confirmation-card {
        padding: 20px;
    }
    
    .contact-items {
        flex-direction: column;
        gap: 15px !important;
    }
    
    .sticky-top {
        position: relative !important;
        top: auto !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to payment button
    const paymentForm = document.querySelector('form[action*="payment"]');
    const paymentButton = paymentForm.querySelector('button[type="submit"]');
    
    paymentForm.addEventListener('submit', function() {
        paymentButton.innerHTML = '<i class="fas fa-spinner fa-spin me-10"></i>Memproses...';
        paymentButton.disabled = true;
    });
    
    // Smooth scroll for long content
    if (window.innerHeight < document.body.scrollHeight) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});
</script>
@endpush
@endsection