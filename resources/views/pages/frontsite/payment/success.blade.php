@extends('layouts.frontsite')

@section('title', 'Pembayaran Berhasil | Opsi Liburan Indonesia')

@section('content')
<div class="payment-success-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="success-card">
                    
                    <!-- Success Header with Celebration -->
                    <div class="success-header text-center mb-4">
                        <!-- Success Icon with Animation -->
                        <div class="success-icon-wrapper mb-3">
                            <div class="success-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="success-particles">
                                <span class="particle"></span>
                                <span class="particle"></span>
                                <span class="particle"></span>
                                <span class="particle"></span>
                                <span class="particle"></span>
                                <span class="particle"></span>
                            </div>
                        </div>
                        
                        <h1 class="success-title mb-2">Pembayaran Berhasil!</h1>
                        <p class="success-subtitle mb-4">Terima kasih! Pembayaran Anda telah berhasil diproses dan booking Anda telah dikonfirmasi.</p>
                        
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

                    <!-- Payment Summary Card -->
                    <div class="payment-summary-card mb-4">
                        <div class="summary-header">
                            <i class="fas fa-receipt me-2"></i>
                            <h3>Ringkasan Pembayaran</h3>
                        </div>
                        <div class="summary-body">
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
                                        <i class="fas fa-calendar-alt"></i>
                                        <div class="info-content">
                                            <label>Tanggal Tour</label>
                                            <p>{{ \Carbon\Carbon::parse($payment->booking->preferred_date)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-credit-card"></i>
                                        <div class="info-content">
                                            <label>Metode Pembayaran</label>
                                            <p>{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <i class="fas fa-clock"></i>
                                        <div class="info-content">
                                            <label>Waktu Pembayaran</label>
                                            <p>{{ $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item highlight">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <div class="info-content">
                                            <label>Total Pembayaran</label>
                                            <p class="amount">{{ $payment->formatted_amount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps -->
                    <div class="next-steps-section mb-4">
                        <div class="section-title text-center mb-4">
                            <h3><i class="fas fa-list-check me-2"></i>Langkah Selanjutnya</h3>
                            <p class="text-muted">Ikuti langkah-langkah berikut untuk persiapan perjalanan Anda</p>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="step-card">
                                    <div class="step-number">1</div>
                                    <div class="step-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h5>Email Konfirmasi</h5>
                                    <p>Anda akan menerima email konfirmasi dengan detail lengkap dalam beberapa menit.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="step-card">
                                    <div class="step-number">2</div>
                                    <div class="step-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h5>Konfirmasi Tim</h5>
                                    <p>Tim kami akan menghubungi Anda untuk konfirmasi detail dan persiapan tour.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="step-card">
                                    <div class="step-number">3</div>
                                    <div class="step-icon">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <h5>Persiapan Tour</h5>
                                    <p>Kami akan memberikan panduan lengkap dan itinerary detail untuk perjalanan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="important-notes-card mb-4">
                        <div class="notes-header">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <h4>Catatan Penting</h4>
                        </div>
                        <div class="notes-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Simpan email konfirmasi dan booking code untuk referensi</span>
                                    </div>
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Pastikan nomor telepon Anda aktif untuk dihubungi tim kami</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Persiapkan dokumen yang diperlukan sesuai panduan yang akan dikirim</span>
                                    </div>
                                    <div class="note-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Hubungi customer service jika ada pertanyaan atau perubahan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons-wrapper">
                        <div class="action-buttons">
                            <a href="{{ route('frontsite.booking.show', $payment->booking->booking_code) }}" class="btn btn-success btn-lg">
                                <i class="fas fa-eye me-2"></i>Lihat Detail Booking
                            </a>
                            <a href="{{ route('index') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="contact-support text-center mt-5">
                        <h5 class="mb-3">Butuh Bantuan?</h5>
                        <p class="text-muted mb-3">Tim kami siap membantu Anda 24/7</p>
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

@push('styles')
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
.payment-success-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

/* Animated Background */
.payment-success-section::before {
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

/* Success Card */
.success-card {
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

/* Success Header */
.success-icon-wrapper {
    position: relative;
    display: inline-block;
}

.success-icon {
    font-size: 100px;
    color: var(--success-color);
    animation: bounceIn 1s ease-out;
    position: relative;
    z-index: 2;
}

@keyframes bounceIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.1);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Success Particles */
.success-particles {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 200px;
    height: 200px;
    pointer-events: none;
}

.particle {
    position: absolute;
    width: 10px;
    height: 10px;
    background: var(--success-color);
    border-radius: 50%;
    animation: particle-burst 1.5s ease-out forwards;
    opacity: 0;
}

.particle:nth-child(1) {
    animation-delay: 0.5s;
    top: 0;
    left: 50%;
}

.particle:nth-child(2) {
    animation-delay: 0.6s;
    top: 25%;
    right: 10%;
}

.particle:nth-child(3) {
    animation-delay: 0.7s;
    bottom: 25%;
    right: 10%;
}

.particle:nth-child(4) {
    animation-delay: 0.8s;
    bottom: 0;
    left: 50%;
}

.particle:nth-child(5) {
    animation-delay: 0.9s;
    bottom: 25%;
    left: 10%;
}

.particle:nth-child(6) {
    animation-delay: 1s;
    top: 25%;
    left: 10%;
}

@keyframes particle-burst {
    0% {
        opacity: 1;
        transform: translate(0, 0) scale(1);
    }
    100% {
        opacity: 0;
        transform: translate(var(--tx, 0), var(--ty, 0)) scale(0);
    }
}

.particle:nth-child(1) { --tx: 0; --ty: -50px; }
.particle:nth-child(2) { --tx: 50px; --ty: -25px; }
.particle:nth-child(3) { --tx: 50px; --ty: 25px; }
.particle:nth-child(4) { --tx: 0; --ty: 50px; }
.particle:nth-child(5) { --tx: -50px; --ty: 25px; }
.particle:nth-child(6) { --tx: -50px; --ty: -25px; }

.success-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--success-color);
    text-shadow: 0 2px 4px rgba(40, 167, 69, 0.1);
}

.success-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    max-width: 600px;
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
    background: linear-gradient(135deg, var(--primary-color), #0056b3);
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

/* Payment Summary Card */
.payment-summary-card {
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
    font-size: 1.3rem;
    font-weight: 600;
}

.summary-body {
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

.info-item.highlight {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: 2px solid var(--success-color);
}

.info-item i {
    font-size: 20px;
    color: var(--primary-color);
    margin-top: 2px;
    width: 24px;
    text-align: center;
}

.info-item.highlight i {
    color: var(--success-color);
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

.info-content p.amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--success-color);
}

/* Section Title */
.section-title h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
}

/* Step Cards */
.step-card {
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

.step-card:nth-child(1) { animation-delay: 0.5s; }
.step-card:nth-child(2) { animation-delay: 0.6s; }
.step-card:nth-child(3) { animation-delay: 0.7s; }

.step-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.step-number {
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

.step-icon {
    font-size: 48px;
    color: var(--primary-color);
    margin-bottom: 16px;
}

.step-card h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 12px;
}

.step-card p {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.6;
    margin: 0;
}

/* Important Notes Card */
.important-notes-card {
    background: linear-gradient(135deg, #fff9e6 0%, #fffbf0 100%);
    border: 2px solid var(--warning-color);
    border-radius: var(--border-radius);
    overflow: hidden;
    animation: fadeIn 0.6s ease-out 0.8s backwards;
}

.notes-header {
    background: linear-gradient(135deg, var(--warning-color), #e0a800);
    color: #856404;
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
    color: var(--success-color);
    margin-top: 2px;
    font-size: 16px;
}

.note-item span {
    flex: 1;
    color: #856404;
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

.btn-success {
    background: linear-gradient(135deg, var(--success-color), #1e7e34);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #1e7e34, #145523);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
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
    animation: fadeIn 0.6s ease-out 0.9s backwards;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 16px;
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
    .success-card {
        padding: 32px 24px;
    }
    
    .success-title {
        font-size: 2rem;
    }
    
    .success-icon {
        font-size: 80px;
    }
    
    .code-badges {
        flex-direction: column;
        align-items: stretch;
    }
    
    .code-badge {
        text-align: center;
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
    .success-card {
        padding: 24px 20px;
    }
    
    .payment-success-section {
        padding: 40px 0;
    }
    
    .success-subtitle {
        font-size: 1rem;
    }
}

/* Print Styles */
@media print {
    .payment-success-section {
        background: white;
    }
    
    .btn, .contact-support {
        display: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    // Confetti effect using canvas
    createConfetti();
    
    // Add entrance animations to elements
    animateElements();
    
    // Log success
    console.log('🎉 Payment successful! 🎉');
});

function createConfetti() {
    const duration = 3000;
    const animationEnd = Date.now() + duration;
    const colors = ['#28a745', '#007bff', '#ffc107', '#dc3545', '#17a2b8'];
    
    const confettiInterval = setInterval(function() {
        const timeLeft = animationEnd - Date.now();
        
        if (timeLeft <= 0) {
            clearInterval(confettiInterval);
            return;
        }
        
        const particleCount = 3;
        
        for (let i = 0; i < particleCount; i++) {
            createConfettiParticle(colors);
        }
    }, 50);
}

function createConfettiParticle(colors) {
    const particle = document.createElement('div');
    const color = colors[Math.floor(Math.random() * colors.length)];
    const size = Math.random() * 10 + 5;
    const startX = Math.random() * window.innerWidth;
    const endX = startX + (Math.random() - 0.5) * 200;
    const duration = Math.random() * 2000 + 1000;
    
    particle.style.cssText = `
        position: fixed;
        top: -20px;
        left: ${startX}px;
        width: ${size}px;
        height: ${size}px;
        background: ${color};
        border-radius: ${Math.random() > 0.5 ? '50%' : '0'};
        pointer-events: none;
        z-index: 9999;
        opacity: 1;
    `;
    
    document.body.appendChild(particle);
    
    const animation = particle.animate([
        {
            transform: `translate(0, 0) rotate(0deg)`,
            opacity: 1
        },
        {
            transform: `translate(${endX - startX}px, ${window.innerHeight + 20}px) rotate(${Math.random() * 720}deg)`,
            opacity: 0
        }
    ], {
        duration: duration,
        easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
    });
    
    animation.onfinish = () => particle.remove();
}

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
    
    document.querySelectorAll('.step-card, .payment-summary-card, .important-notes-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
}
</script>
@endpush
@endsection