@extends('layouts.frontsite')

@section('title', 'Pembayaran Gagal | Opsi Liburan Indonesia')

@section('content')
<div class="payment-failed-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="failed-card">
                    
                    <!-- Failed Header -->
                    <div class="failed-header text-center mb-4">
                        <!-- Failed Icon with Animation -->
                        <div class="failed-icon-wrapper mb-3">
                            <div class="failed-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="error-pulse"></div>
                        </div>
                        
                        <h1 class="failed-title mb-2">Pembayaran Gagal</h1>
                        <p class="failed-subtitle mb-4">Maaf, pembayaran Anda tidak dapat diproses. Jangan khawatir, booking Anda masih tersimpan dan Anda dapat mencoba lagi.</p>
                        
                        <!-- Payment Code Badges -->
                        <div class="code-badges">
                            <div class="code-badge">
                                <small>Kode Pembayaran</small>
                                <strong>{{ $payment->payment_code }}</strong>
                            </div>
                            <div class="code-badge">
                                <small>Kode Booking</small>
                                <strong>{{ $payment->booking->booking_code }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Error Alert -->
                    @if($payment->failure_reason)
                    <div class="error-alert-card mb-4">
                        <div class="alert-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="alert-content">
                            <h5>Alasan Kegagalan</h5>
                            <p>{{ $payment->failure_reason }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Payment Details Card -->
                    <div class="payment-details-card mb-4">
                        <div class="details-header">
                            <i class="fas fa-receipt me-2"></i>
                            <h3 class="text-white">Detail Pembayaran</h3>
                        </div>
                        <div class="details-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-map-marked-alt"></i>
                                        <div class="info-content">
                                            <label>Nama Tour</label>
                                            <p>{{ $payment->booking->tour->title }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-user"></i>
                                        <div class="info-content">
                                            <label>Nama Pemesan</label>
                                            <p>{{ $payment->booking->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-envelope"></i>
                                        <div class="info-content">
                                            <label>Email</label>
                                            <p>{{ $payment->booking->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-users"></i>
                                        <div class="info-content">
                                            <label>Jumlah Peserta</label>
                                            <p><span class="badge bg-info">{{ $payment->booking->travelers }} orang</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <div class="info-content">
                                            <label>Total Pembayaran</label>
                                            <p class="amount-text">{{ $payment->formatted_amount }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-info-circle"></i>
                                        <div class="info-content">
                                            <label>Status</label>
                                            <p><span class="badge bg-danger">{{ $payment->status_label }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Possible Reasons -->
                    <div class="reasons-section mb-4">
                        <div class="section-title text-center mb-4">
                            <h3><i class="fas fa-search me-2"></i>Kemungkinan Penyebab</h3>
                            <p class="text-muted">Berikut adalah beberapa alasan umum mengapa pembayaran gagal</p>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="reason-card">
                                    <div class="reason-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <h5>Masalah Kartu/Rekening</h5>
                                    <ul>
                                        <li>Saldo tidak mencukupi</li>
                                        <li>Kartu kadaluarsa atau diblokir</li>
                                        <li>Limit transaksi terlampaui</li>
                                        <li>Detail kartu tidak valid</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="reason-card">
                                    <div class="reason-icon">
                                        <i class="fas fa-wifi"></i>
                                    </div>
                                    <h5>Masalah Teknis</h5>
                                    <ul>
                                        <li>Koneksi internet terputus</li>
                                        <li>Timeout saat proses pembayaran</li>
                                        <li>Gangguan sistem bank</li>
                                        <li>Browser tidak kompatibel</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Solutions -->
                    <div class="solutions-section mb-4">
                        <div class="section-title text-center mb-4">
                            <h3><i class="fas fa-lightbulb me-2"></i>Solusi yang Dapat Dicoba</h3>
                            <p class="text-muted">Ikuti langkah-langkah berikut untuk menyelesaikan pembayaran</p>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="solution-card">
                                    <div class="solution-number">1</div>
                                    <div class="solution-icon">
                                        <i class="fas fa-redo"></i>
                                    </div>
                                    <h5>Coba Lagi</h5>
                                    <p>Ulangi proses pembayaran dengan metode yang sama atau berbeda.</p>
                                    <div class="solution-tip">
                                        <small><i class="fas fa-info-circle me-1"></i>Pastikan saldo mencukupi</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="solution-card">
                                    <div class="solution-number">2</div>
                                    <div class="solution-icon">
                                        <i class="fas fa-exchange-alt"></i>
                                    </div>
                                    <h5>Ganti Metode</h5>
                                    <p>Gunakan metode pembayaran lain yang tersedia.</p>
                                    <div class="solution-tip">
                                        <small><i class="fas fa-info-circle me-1"></i>Virtual Account, E-Wallet, dll</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="solution-card">
                                    <div class="solution-number">3</div>
                                    <div class="solution-icon">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <h5>Hubungi Kami</h5>
                                    <p>Tim support siap membantu menyelesaikan masalah Anda.</p>
                                    <div class="solution-tip">
                                        <small><i class="fas fa-info-circle me-1"></i>Tersedia 24/7</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="important-notes-card mb-4">
                        <div class="notes-header">
                            <i class="fas fa-shield-alt me-2"></i>
                            <h4>Yang Perlu Anda Ketahui</h4>
                        </div>
                        <div class="notes-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Booking Anda masih tersimpan dan dapat dibayar kembali</span>
                                    </div>
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Tidak ada biaya tambahan untuk mencoba pembayaran ulang</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Hubungi bank Anda jika masalah terus berlanjut</span>
                                    </div>
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Tim support kami siap membantu 24/7</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons-wrapper">
                        <div class="action-buttons">
                            <a href="{{ route('frontsite.payment.show', $payment->booking->booking_code) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-redo me-2"></i>Coba Pembayaran Lagi
                            </a>
                            <a href="{{ route('frontsite.booking.show', $payment->booking->booking_code) }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-eye me-2"></i>Lihat Detail Booking
                            </a>
                            <a href="{{ route('index') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support text-center mt-5">
                        <h5 class="mb-3">Butuh Bantuan Segera?</h5>
                        <p class="text-muted mb-3">Tim customer service kami siap membantu menyelesaikan masalah pembayaran Anda</p>
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
.payment-failed-section {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    min-height: 100vh;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

/* Animated Background */
.payment-failed-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    animation: bgScroll 60s linear infinite;
}

@keyframes bgScroll {
    0% { transform: translate(0, 0); }
    100% { transform: translate(60px, 60px); }
}

/* Failed Card */
.failed-card {
    background: white;
    border-radius: var(--border-radius);
    padding: 50px 40px;
    box-shadow: var(--shadow-lg);
    position: relative;
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

/* Failed Header */
.failed-icon-wrapper {
    position: relative;
    display: inline-block;
}

.failed-icon {
    font-size: 100px;
    color: var(--danger-color);
    animation: shake 0.8s ease-out;
    position: relative;
    z-index: 2;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-10px); }
    20%, 40%, 60%, 80% { transform: translateX(10px); }
}

/* Error Pulse */
.error-pulse {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100px;
    height: 100px;
    border: 3px solid var(--danger-color);
    border-radius: 50%;
    opacity: 0;
    animation: pulse-error 2s ease-out infinite;
}

@keyframes pulse-error {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.5;
    }
    100% {
        transform: translate(-50%, -50%) scale(2);
        opacity: 0;
    }
}

.failed-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--danger-color);
    text-shadow: 0 2px 4px rgba(220, 53, 69, 0.1);
}

.failed-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

/* Code Badges */
.code-badges {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
}

.code-badge {
    background: linear-gradient(135deg, var(--secondary-color), #545b62);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    box-shadow: var(--shadow-md);
    animation: slideInUp 0.6s ease-out 0.3s backwards;
}

.code-badge small {
    display: block;
    font-size: 0.75rem;
    opacity: 0.9;
    margin-bottom: 4px;
}

.code-badge strong {
    font-size: 1rem;
    font-weight: 700;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Error Alert Card */
.error-alert-card {
    display: flex;
    gap: 20px;
    padding: 24px;
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    border-left: 4px solid var(--danger-color);
    border-radius: var(--border-radius);
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

.error-alert-card .alert-icon {
    font-size: 48px;
    color: var(--danger-color);
    flex-shrink: 0;
}

.error-alert-card .alert-content {
    flex: 1;
}

.error-alert-card h5 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #721c24;
}

.error-alert-card p {
    margin: 0;
    color: #721c24;
    line-height: 1.6;
}

/* Payment Details Card */
.payment-details-card {
    background: white;
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    animation: fadeIn 0.6s ease-out 0.4s backwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.details-header {
    background: linear-gradient(135deg, var(--secondary-color), #545b62);
    color: white;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.details-header h3 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.details-body {
    padding: 24px;
}

/* Info Items */
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
    color: var(--danger-color);
    margin-top: 2px;
    width: 24px;
    text-align: center;
}

.info-content {
    flex: 1;
}

.info-content label {
    display: block;
    font-weight: 600;
    color: #6c757d;
    font-size: 0.85rem;
    margin-bottom: 4px;
}

.info-content p {
    margin: 0;
    color: #2c3e50;
    font-size: 1rem;
}

.amount-text {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--danger-color);
}

/* Section Title */
.section-title h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
}

/* Reason Cards */
.reason-card {
    background: white;
    border: 2px solid #ffeaa7;
    border-radius: var(--border-radius);
    padding: 24px;
    transition: var(--transition);
    height: 100%;
    animation: fadeInUp 0.6s ease-out backwards;
}

.reason-card:nth-child(1) { animation-delay: 0.5s; }
.reason-card:nth-child(2) { animation-delay: 0.6s; }

.reason-card:hover {
    border-color: var(--warning-color);
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

.reason-icon {
    font-size: 48px;
    color: var(--warning-color);
    margin-bottom: 16px;
}

.reason-card h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 16px;
}

.reason-card ul {
    margin: 0;
    padding-left: 20px;
    color: #6c757d;
    line-height: 1.8;
}

.reason-card li {
    margin-bottom: 8px;
}

/* Solution Cards */
.solution-card {
    background: white;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 32px 24px;
    text-align: center;
    position: relative;
    transition: var(--transition);
    height: 100%;
    animation: fadeInUp 0.6s ease-out backwards;
}

.solution-card:nth-child(1) { animation-delay: 0.7s; }
.solution-card:nth-child(2) { animation-delay: 0.8s; }
.solution-card:nth-child(3) { animation-delay: 0.9s; }

.solution-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.solution-number {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    box-shadow: var(--shadow-md);
}

.solution-icon {
    font-size: 48px;
    color: var(--primary-color);
    margin-bottom: 16px;
}

.solution-card h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 12px;
}

.solution-card p {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 16px;
}

.solution-tip {
    background: var(--light-bg);
    padding: 8px 12px;
    border-radius: 6px;
    color: var(--primary-color);
    font-weight: 500;
}

/* Important Notes Card */
.important-notes-card {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    border: 2px solid var(--info-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    animation: fadeIn 0.6s ease-out 1s backwards;
}

.notes-header {
    background: linear-gradient(135deg, var(--info-color), #117a8b);
    color: white;
    padding: 16px 20px;
    display: flex;
    align-items: center;
}

.notes-header h4 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
}

.notes-body {
    padding: 24px;
}

.note-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
}

.note-item:last-child {
    margin-bottom: 0;
}

.note-item i {
    color: var(--info-color);
    margin-top: 2px;
    font-size: 16px;
}

.note-item span {
    flex: 1;
    color: #0c5460;
    line-height: 1.6;
}

/* Buttons */
.btn {
    border-radius: 8px;
    padding: 14px 32px;
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

.btn-outline-secondary {
    border: 2px solid var(--secondary-color);
    color: var(--secondary-color);
    background: white;
}

.btn-outline-secondary:hover {
    background: var(--secondary-color);
    color: white;
    transform: translateY(-2px);
}

.btn-outline-primary {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    background: white;
}

.btn-outline-primary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

/* Action Buttons */
.action-buttons-wrapper {
    border-top: 1px solid var(--border-color);
    padding-top: 32px;
    margin-top: 32px;
    animation: fadeIn 0.6s ease-out 1.1s backwards;
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

/* Responsive */
@media (max-width: 768px) {
    .failed-card {
        padding: 32px 24px;
    }
    
    .failed-title {
        font-size: 2rem;
    }
    
    .failed-icon {
        font-size: 80px;
    }
    
    .code-badges {
        flex-direction: column;
        align-items: stretch;
    }
    
    .code-badge {
        text-align: center;
    }
    
    .error-alert-card {
        flex-direction: column;
        text-align: center;
    }
    
    .error-alert-card .alert-icon {
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
    
    .section-title h3 {
        font-size: 1.5rem;
    }
}

@media (max-width: 576px) {
    .failed-card {
        padding: 24px 20px;
    }
    
    .payment-failed-section {
        padding: 40px 0;
    }
    
    .failed-subtitle {
        font-size: 1rem;
    }
}

/* Print Styles */
@media print {
    .payment-failed-section {
        background: white;
    }
    
    .btn, .contact-support {
        display: none;
    }
}
</style>
@endpush

@push('after-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    // Add entrance animations to elements
    animateElements();
    
    // Log error (for debugging)
    console.log('⚠️ Payment failed - showing error page');
});

function animateElements() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    document.querySelectorAll('.reason-card, .solution-card, .payment-details-card, .important-notes-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
}
</script>
@endpush
@endsection