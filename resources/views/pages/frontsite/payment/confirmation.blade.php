@extends('layouts.frontsite')

@section('title', 'Konfirmasi Pemesanan | Opsi Liburan Indonesia')

@section('content')
<div class="booking-confirmation-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="confirmation-card">
                    
                    <!-- Header -->
                    <div class="confirmation-header text-center mb-4">
                        <div class="success-icon mb-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h1 class="mb-2">Konfirmasi Pemesanan</h1>
                        <p class="text-muted mb-3">Silakan periksa detail pemesanan Anda sebelum melanjutkan ke pembayaran</p>
                        <div class="booking-code">
                            <span class="badge-code">
                                <i class="fas fa-ticket-alt me-2"></i>{{ $booking->booking_code }}
                            </span>
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- Tour Details - Left Column -->
                        <div class="col-lg-8">
                            
                            <!-- Tour Information -->
                            <div class="detail-card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-map-marked-alt me-2"></i>
                                    <h3 class="text-white">Detail Tour</h3>
                                </div>
                                <div class="card-body">
                                    <div class="tour-showcase">
                                        @if($booking->tour->tour_photos->count() > 0)
                                        <div class="tour-image mb-3">
                                            <img src="{{ Storage::url($booking->tour->tour_photos->first()->image) }}" 
                                                 alt="{{ $booking->tour->title }}"
                                                 class="img-fluid rounded">
                                        </div>
                                        @endif
                                        
                                        <h4 class="tour-title mb-3">{{ $booking->tour->title }}</h4>
                                        
                                        <div class="tour-info-grid">
                                            <div class="info-item">
                                                <i class="fas fa-clock"></i>
                                                <div>
                                                    <small class="label">Durasi</small>
                                                    <strong>{{ $booking->tour->duration }} hari</strong>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <div>
                                                    <small class="label">Lokasi</small>
                                                    <strong>{{ $booking->tour->location }}</strong>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-users"></i>
                                                <div>
                                                    <small class="label">Tipe Tour</small>
                                                    <strong>{{ $booking->tour->type }}</strong>
                                                </div>
                                            </div>
                                            @if($booking->tour->tour_reviews->count() > 0)
                                            <div class="info-item">
                                                <i class="fas fa-star"></i>
                                                <div>
                                                    <small class="label">Rating</small>
                                                    <strong>{{ number_format($booking->tour->tour_reviews->avg('rating'), 1) }}/5 
                                                    <span class="text-muted">({{ $booking->tour->tour_reviews->count() }})</span></strong>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Information -->
                            <div class="detail-card mb-4">
                                <div class="card-header header-success">
                                    <i class="fas fa-user me-2"></i>
                                    <h3 class="text-white">Informasi Pemesan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="info-group">
                                                <label>Nama Lengkap</label>
                                                <p>{{ $booking->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-group">
                                                <label>Tanggal Keberangkatan</label>
                                                <p>{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-group">
                                                <label>Email</label>
                                                <p>{{ $booking->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-group">
                                                <label>Jumlah Peserta</label>
                                                <p>{{ $booking->travelers }} orang</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-group">
                                                <label>No. Telepon</label>
                                                <p>{{ $booking->phone }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-group">
                                                <label>Status Pemesanan</label>
                                                <p><span class="badge bg-warning text-dark">{{ ucfirst($booking->status) }}</span></p>
                                            </div>
                                        </div>
                                        
                                        @if($booking->notes)
                                        <div class="col-12">
                                            <div class="info-group">
                                                <label>Catatan Tambahan</label>
                                                <p class="notes-text">{{ $booking->notes }}</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Tour Inclusions -->
                            @if($booking->tour->tour_details->count() > 0)
                            <div class="detail-card mb-4">
                                <div class="card-header header-info">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <h3>Yang Termasuk</h3>
                                </div>
                                <div class="card-body">
                                    <div class="inclusions-grid">
                                        @foreach($booking->tour->tour_details as $detail)
                                        <div class="inclusion-item">
                                            <i class="fas fa-check"></i>
                                            <span>{{ $detail->title }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Terms and Conditions - Mobile -->
                            <div class="detail-card mb-4 d-lg-none">
                                <div class="card-header header-secondary">
                                    <i class="fas fa-file-contract me-2"></i>
                                    <h3 class="text-white">Syarat dan Ketentuan</h3>
                                </div>
                                <div class="card-body">
                                    <div class="terms-list">
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Pembayaran harus dilakukan dalam waktu 24 jam</span>
                                        </div>
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Konfirmasi booking akan dikirim via email</span>
                                        </div>
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Pembatalan dapat dilakukan maksimal 7 hari sebelum keberangkatan</span>
                                        </div>
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Harga sudah termasuk pajak dan biaya layanan</span>
                                        </div>
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Peserta wajib membawa identitas yang valid</span>
                                        </div>
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Itinerary dapat berubah sesuai kondisi cuaca</span>
                                        </div>
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Asuransi perjalanan sangat disarankan</span>
                                        </div>
                                        <div class="term-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Hubungi customer service untuk bantuan</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Summary - Right Column -->
                        <div class="col-lg-4">
                            <div class="payment-sidebar">
                                <div class="summary-card">
                                    <div class="summary-header">
                                        <i class="fas fa-calculator me-2"></i>
                                        <h3 class="text-white">Ringkasan Pembayaran</h3>
                                    </div>
                                    
                                    <div class="summary-body">
                                        <div class="price-breakdown">
                                            <div class="price-row">
                                                <span>Harga per orang</span>
                                                <span>${{ number_format($booking->total_price / $booking->travelers, 2) }}</span>
                                            </div>
                                            <div class="price-row">
                                                <span>Jumlah peserta</span>
                                                <span>{{ $booking->travelers }} orang</span>
                                            </div>
                                            <div class="price-row">
                                                <span>Subtotal (USD)</span>
                                                <span>${{ number_format($booking->total_price, 2) }}</span>
                                            </div>
                                            
                                            <div class="price-divider"></div>
                                            
                                            <div class="price-row total">
                                                <strong>Total Pembayaran</strong>
                                                <strong>Rp {{ number_format($idrAmount, 0, ',', '.') }}</strong>
                                            </div>
                                            
                                            <div class="exchange-info">
                                                <i class="fas fa-info-circle"></i>
                                                <small>Kurs: 1 USD = Rp {{ number_format($exchangeRate, 0, ',', '.') }}</small>
                                            </div>
                                        </div>

                                        <!-- Payment Methods -->
                                        <div class="payment-methods">
                                            <h6>Metode Pembayaran:</h6>
                                            <div class="methods-list">
                                                <div class="method-item">
                                                    <i class="fas fa-university"></i>
                                                    <span>Virtual Account</span>
                                                </div>
                                                <div class="method-item">
                                                    <i class="fas fa-mobile-alt"></i>
                                                    <span>E-Wallet</span>
                                                </div>
                                                <div class="method-item">
                                                    <i class="fas fa-qrcode"></i>
                                                    <span>QR Code (QRIS)</span>
                                                </div>
                                                <div class="method-item">
                                                    <i class="fas fa-credit-card"></i>
                                                    <span>Kartu Kredit</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="action-buttons">
                                            <form action="{{ route('frontsite.payment.create', $booking->booking_code) }}" method="POST" id="paymentForm">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-lg w-100 mb-2" id="paymentBtn">
                                                    <i class="fas fa-credit-card me-2"></i>Lanjutkan ke Pembayaran
                                                </button>
                                            </form>
                                            
                                            <a href="{{ route('frontsite.home.index') }}" class="btn btn-outline-secondary w-100">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                                            </a>
                                        </div>

                                        <!-- Security Badge -->
                                        <div class="security-badge">
                                            <i class="fas fa-shield-alt"></i>
                                            <small>Pembayaran aman dengan enkripsi SSL</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms (Desktop) -->
                                <div class="detail-card mt-4 d-none d-lg-block">
                                    <div class="card-header header-secondary">
                                        <i class="fas fa-file-contract me-2"></i>
                                        <h3 class="text-white">Syarat & Ketentuan</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="terms-list-compact">
                                            <div class="term-item">
                                                <i class="fas fa-check"></i>
                                                <span>Bayar dalam 24 jam</span>
                                            </div>
                                            <div class="term-item">
                                                <i class="fas fa-check"></i>
                                                <span>Konfirmasi via email</span>
                                            </div>
                                            <div class="term-item">
                                                <i class="fas fa-check"></i>
                                                <span>Batal maks. 7 hari sebelumnya</span>
                                            </div>
                                            <div class="term-item">
                                                <i class="fas fa-check"></i>
                                                <span>Bawa identitas valid</span>
                                            </div>
                                            <div class="term-item">
                                                <i class="fas fa-check"></i>
                                                <span>Asuransi disarankan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support text-center mt-5">
                        <h5 class="mb-3">Butuh Bantuan?</h5>
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
                                <span>WhatsApp</span>
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
.booking-confirmation-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 60px 0;
}

.confirmation-card {
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
.confirmation-header .success-icon {
    font-size: 60px;
    color: var(--success-color);
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

.confirmation-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
}

.badge-code {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    box-shadow: var(--shadow-md);
}

/* Detail Cards */
.detail-card {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: var(--transition);
}

.detail-card:hover {
    box-shadow: var(--shadow-md);
}

.card-header {
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    color: white;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    border: none;
}

.card-header.header-success {
    background: linear-gradient(135deg, var(--success-color), #1e7e34);
}

.card-header.header-info {
    background: linear-gradient(135deg, var(--info-color), #117a8b);
}

.card-header.header-secondary {
    background: linear-gradient(135deg, var(--secondary-color), #545b62);
}

.card-header h3 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.card-body {
    padding: 24px;
}

/* Tour Showcase */
.tour-image img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 8px;
}

.tour-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
}

.tour-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px;
    background: var(--light-bg);
    border-radius: 8px;
    transition: var(--transition);
}

.info-item:hover {
    background: #e9ecef;
    transform: translateX(4px);
}

.info-item i {
    font-size: 20px;
    color: var(--primary-color);
    margin-top: 2px;
}

.info-item .label {
    display: block;
    color: #6c757d;
    font-size: 0.85rem;
    margin-bottom: 4px;
}

.info-item strong {
    color: #2c3e50;
    font-size: 1rem;
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

.notes-text {
    background: var(--light-bg);
    padding: 12px;
    border-radius: 6px;
    border-left: 3px solid var(--primary-color);
}

/* Inclusions */
.inclusions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 12px;
}

.inclusion-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: var(--light-bg);
    border-radius: 6px;
    transition: var(--transition);
}

.inclusion-item:hover {
    background: #e9ecef;
}

.inclusion-item i {
    color: var(--success-color);
    font-size: 16px;
}

/* Payment Sidebar */
.payment-sidebar {
    position: sticky;
    top: 20px;
}

.summary-card {
    background: white;
    border: 2px solid var(--primary-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.summary-header {
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    color: white;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.summary-header h3 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
}

.summary-body {
    padding: 24px;
}

/* Price Breakdown */
.price-breakdown {
    margin-bottom: 24px;
}

.price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    font-size: 0.95rem;
}

.price-row.total {
    font-size: 1.2rem;
    color: var(--primary-color);
    padding-top: 16px;
}

.price-divider {
    height: 1px;
    background: var(--border-color);
    margin: 16px 0;
}

.exchange-info {
    background: #fff3cd;
    padding: 10px;
    border-radius: 6px;
    text-align: center;
    margin-top: 12px;
}

.exchange-info i {
    color: var(--warning-color);
    margin-right: 6px;
}

/* Payment Methods */
.payment-methods {
    background: var(--light-bg);
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
}

.payment-methods h6 {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 12px;
    color: #2c3e50;
}

.methods-list {
    display: grid;
    gap: 8px;
}

.method-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px;
    background: white;
    border-radius: 6px;
    font-size: 0.85rem;
}

.method-item i {
    color: var(--primary-color);
    font-size: 16px;
    width: 20px;
}

/* Buttons */
.btn {
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    transition: var(--transition);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
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

/* Security Badge */
.security-badge {
    text-align: center;
    padding: 12px;
    background: #d4edda;
    border-radius: 6px;
    margin-top: 16px;
}

.security-badge i {
    color: var(--success-color);
    margin-right: 6px;
}

.security-badge small {
    color: #155724;
    font-weight: 500;
}

/* Terms */
.terms-list,
.terms-list-compact {
    display: grid;
    gap: 10px;
}

.term-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 8px 0;
}

.term-item i {
    color: var(--success-color);
    margin-top: 3px;
    font-size: 14px;
}

.term-item span {
    flex: 1;
    font-size: 0.9rem;
    line-height: 1.5;
}

.terms-list-compact .term-item span {
    font-size: 0.85rem;
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

/* Responsive */
@media (max-width: 991px) {
    .payment-sidebar {
        position: relative;
        top: 0;
    }
    
    .confirmation-card {
        padding: 24px;
    }
}

@media (max-width: 768px) {
    .confirmation-card {
        padding: 20px;
    }
    
    .confirmation-header h1 {
        font-size: 1.5rem;
    }
    
    .badge-code {
        font-size: 1rem;
        padding: 10px 20px;
    }
    
    .tour-info-grid {
        grid-template-columns: 1fr;
    }
    
    .inclusions-grid {
        grid-template-columns: 1fr;
    }
    
    .contact-items {
        flex-direction: column;
        align-items: stretch;
    }
    
    .contact-item {
        justify-content: center;
    }
}

/* Loading State */
.btn-loading {
    position: relative;
    pointer-events: none;
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
</style>
@endpush

@push('after-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment form handling
    const paymentForm = document.getElementById('paymentForm');
    const paymentBtn = document.getElementById('paymentBtn');
    
    if (paymentForm && paymentBtn) {
        paymentForm.addEventListener('submit', function(e) {
            paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            paymentBtn.disabled = true;
            paymentBtn.classList.add('btn-loading');
        });
    }
    
    // Smooth scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    // Add animation to cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
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