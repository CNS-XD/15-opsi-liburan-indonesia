@extends('layouts.frontsite')

@section('title', 'Request Submitted Successfully - Opsi Liburan Indonesia')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 40vh; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-check-circle-fill" style="font-size: 5rem; color: white;"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Request Submitted Successfully!</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Thank you for choosing Opsi Liburan Indonesia</center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success Section -->
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <!-- Success Message -->
                <div style="background: white; border-radius: 1.5rem; padding: 3rem; box-shadow: 0 10px 40px rgba(0,0,0,0.08); text-align: center; margin-bottom: 2rem;">
                    <h2 style="color: #1e293b; margin-bottom: 1rem; font-weight: 700;">Your Custom Itinerary Request Has Been Submitted!</h2>
                    <p style="color: #64748b; font-size: 1.1rem; margin-bottom: 0;">We've received your custom itinerary request and our travel experts will review it shortly.</p>
                </div>
                
                <!-- Request Details -->
                <div style="background: white; border-radius: 1.5rem; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                    <h4 style="color: #1e293b; margin-bottom: 1.5rem; font-weight: 700; text-align: center; font-size: 1.5rem;">
                        <i class="bi bi-file-text me-2" style="color: #667eea;"></i>Request Details
                    </h4>
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 1rem; padding: 2rem;">
                        <div class="detail-item-modern">
                            <span class="label-modern">Request ID:</span>
                            <span class="value-modern">{{ $customItinerary->request_code }}</span>
                        </div>
                        <div class="detail-item-modern">
                            <span class="label-modern">Customer Name:</span>
                            <span class="value-modern">{{ $customItinerary->customer_name }}</span>
                        </div>
                        <div class="detail-item-modern">
                            <span class="label-modern">Email:</span>
                            <span class="value-modern">{{ $customItinerary->email }}</span>
                        </div>
                        <div class="detail-item-modern">
                            <span class="label-modern">Duration:</span>
                            <span class="value-modern">{{ $customItinerary->duration_days }} Days</span>
                        </div>
                        <div class="detail-item-modern">
                            <span class="label-modern">Participants:</span>
                            <span class="value-modern">{{ $customItinerary->participants_adult }} Adults, {{ $customItinerary->participants_child }} Children</span>
                        </div>
                        <div class="detail-item-modern">
                            <span class="label-modern">Destinations:</span>
                            <span class="value-modern">
                                @foreach($customItinerary->destinations as $destination)
                                    {{ $destination->destination->title }}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        </div>
                        <div class="detail-item-modern" style="border-bottom: none;">
                            <span class="label-modern">Status:</span>
                            <span style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 700; text-transform: uppercase;">
                                {{ $customItinerary->status_label }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Next Steps -->
                <div style="background: white; border-radius: 1.5rem; padding: 2.5rem; box-shadow: 0 10px 40px rgba(0,0,0,0.08); margin-bottom: 2rem;">
                    <h4 style="color: #1e293b; margin-bottom: 2rem; font-weight: 700; text-align: center; font-size: 1.5rem;">
                        <i class="bi bi-list-check me-2" style="color: #667eea;"></i>What Happens Next?
                    </h4>
                    
                    @if($customItinerary->status == 'cancelled')
                        <!-- Cancelled Status Message -->
                        <div style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 1rem; padding: 2rem; margin-bottom: 1.5rem; border-left: 4px solid #dc2626;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <i class="bi bi-x-circle-fill" style="font-size: 2.5rem; color: #dc2626;"></i>
                                <div>
                                    <h5 style="margin: 0 0 8px 0; color: #dc2626; font-weight: 700; font-size: 1.2rem;">Request Cancelled</h5>
                                    <p style="margin: 0; color: #991b1b; line-height: 1.6;">This custom itinerary request has been cancelled. If you have any questions or would like to submit a new request, please contact our support team.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Show only first step as active for cancelled -->
                        <div class="steps-timeline-modern">
                            <div class="timeline-item-modern active">
                                <div class="timeline-icon-modern">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="timeline-content-modern">
                                    <h5>Request Received</h5>
                                    <p>Your custom itinerary request was received and logged in our system.</p>
                                </div>
                            </div>
                            <div class="timeline-item-modern cancelled">
                                <div class="timeline-icon-modern">
                                    <i class="bi bi-x-circle"></i>
                                </div>
                                <div class="timeline-content-modern">
                                    <h5>Request Cancelled</h5>
                                    <p>This request has been cancelled and will not proceed further.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Normal Timeline -->
                        <div class="steps-timeline-modern">
                            <div class="timeline-item-modern {{ in_array($customItinerary->status, ['pending', 'review', 'quoted', 'confirmed']) ? 'active' : '' }}">
                                <div class="timeline-icon-modern">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="timeline-content-modern">
                                    <h5>Request Received</h5>
                                    <p>Your custom itinerary request has been received and logged in our system.</p>
                                </div>
                            </div>
                            <div class="timeline-item-modern {{ in_array($customItinerary->status, ['review', 'quoted', 'confirmed']) ? 'active' : '' }}">
                                <div class="timeline-icon-modern">
                                    <i class="bi bi-search"></i>
                                </div>
                                <div class="timeline-content-modern">
                                    <h5>Expert Review</h5>
                                    <p>Our travel experts will review your requirements and create a personalized itinerary.</p>
                                </div>
                            </div>
                            <div class="timeline-item-modern {{ in_array($customItinerary->status, ['quoted', 'confirmed']) ? 'active' : '' }}">
                                <div class="timeline-icon-modern">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <div class="timeline-content-modern">
                                    <h5>Quote Preparation</h5>
                                    <p>We'll prepare a detailed quote with pricing and send it to your email.</p>
                                </div>
                            </div>
                            <div class="timeline-item-modern {{ $customItinerary->status == 'confirmed' ? 'active' : '' }}">
                                <div class="timeline-icon-modern">
                                    <i class="bi bi-check2-square"></i>
                                </div>
                                <div class="timeline-content-modern">
                                    <h5>Confirmation</h5>
                                    <p>Once you approve the quote, we'll confirm your booking and start planning your dream trip.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Contact Info -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 1.5rem; padding: 2.5rem; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3); margin-bottom: 2rem; text-align: center;">
                    <h4 style="color: white; margin-bottom: 1rem; font-weight: 700; font-size: 1.5rem;">
                        <i class="bi bi-headset me-2"></i>Need Help?
                    </h4>
                    <p style="color: rgba(255, 255, 255, 0.95); margin-bottom: 2rem; font-size: 1.05rem;">If you have any questions about your request, please don't hesitate to contact us:</p>
                    <div style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: white; font-weight: 600;">
                            <i class="bi bi-envelope" style="font-size: 1.25rem;"></i>
                            <span>info@opsiliburan.com</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: white; font-weight: 600;">
                            <i class="bi bi-telephone" style="font-size: 1.25rem;"></i>
                            <span>+62 123 456 789</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: white; font-weight: 600;">
                            <i class="bi bi-whatsapp" style="font-size: 1.25rem;"></i>
                            <span>+62 123 456 789</span>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
                    <a href="{{ route('frontsite.home.index') }}" 
                       class="btn-modern btn-modern-primary">
                        <i class="bi bi-house me-2"></i>
                        Back to Home
                    </a>
                    <a href="{{ route('frontsite.custom-itinerary.show', $customItinerary->request_code) }}" 
                       class="btn-modern btn-modern-secondary">
                        <i class="bi bi-eye me-2"></i>
                        View Request Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-style')
<style>
.detail-item-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.detail-item-modern .label-modern {
    font-weight: 600;
    color: #64748b;
    font-size: 0.95rem;
}

.detail-item-modern .value-modern {
    color: #1e293b;
    font-weight: 600;
    text-align: right;
}

.steps-timeline-modern {
    position: relative;
    padding-left: 2rem;
}

.steps-timeline-modern::before {
    content: '';
    position: absolute;
    left: 1.5rem;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #667eea 0%, #e2e8f0 100%);
}

.timeline-item-modern {
    display: flex;
    align-items: flex-start;
    margin-bottom: 2rem;
    position: relative;
}

.timeline-item-modern:last-child {
    margin-bottom: 0;
}

.timeline-icon-modern {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-right: 1.5rem;
    position: relative;
    z-index: 2;
    flex-shrink: 0;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.timeline-item-modern.active .timeline-icon-modern {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.timeline-item-modern.cancelled .timeline-icon-modern {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
}

.timeline-item-modern.cancelled .timeline-content-modern h5 {
    color: #dc2626;
}

.timeline-item-modern.cancelled .timeline-content-modern p {
    color: #991b1b;
}

.timeline-content-modern h5 {
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-weight: 700;
    font-size: 1.1rem;
}

.timeline-content-modern p {
    color: #64748b;
    margin-bottom: 0;
    font-size: 0.95rem;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .detail-item-modern {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .detail-item-modern .value-modern {
        text-align: left;
    }
    
    .steps-timeline-modern {
        padding-left: 0;
    }
    
    .steps-timeline-modern::before {
        left: 25px;
    }
}
</style>
@endpush
