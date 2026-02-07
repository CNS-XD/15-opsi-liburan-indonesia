@extends('layouts.frontsite')

@section('title', 'Frequently Asked Questions - Travel Indonesia')

@section('meta_description', 'Find answers to frequently asked questions about our travel services, booking process, and tour packages.')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-question-circle" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Frequently Asked Questions</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">
                        <center>Find answers to common questions about our travel services</center>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                @if($faqs->count() > 0)
                <div class="faq-accordion-modern">
                    @foreach($faqs as $index => $faq)
                    <div class="faq-item-modern" style="background: white; border-radius: 1rem; margin-bottom: 1.5rem; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); transition: all 0.3s;">
                        <button class="faq-question-modern {{ $index == 0 ? 'active' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#faqCollapse{{ $index }}" 
                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                style="width: 100%; text-align: left; background: transparent; border: none; padding: 1.75rem 2rem; display: flex; align-items: center; justify-content: space-between; cursor: pointer; transition: all 0.3s;">
                            <span style="color: #1e293b; font-weight: 600; font-size: 1.1rem; padding-right: 2rem; line-height: 1.5;">
                                <i class="bi bi-patch-question me-3" style="color: #667eea; font-size: 1.3rem;"></i>{{ $faq->title }}
                            </span>
                            <i class="bi bi-chevron-down faq-icon" style="color: #667eea; font-size: 1.2rem; transition: transform 0.3s; flex-shrink: 0;"></i>
                        </button>
                        <div id="faqCollapse{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}">
                            <div class="faq-answer-modern" style="padding: 0 2rem 2rem 2rem; color: #64748b; font-size: 1rem; line-height: 1.8;">
                                {!! $faq->description !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5" style="background: white; border-radius: 1.5rem; padding: 4rem 2rem; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                    <div class="mb-4">
                        <i class="bi bi-inbox" style="font-size: 5rem; color: #cbd5e1;"></i>
                    </div>
                    <h4 style="color: #334155; font-weight: 700; margin-bottom: 15px;">No FAQs Available</h4>
                    <p style="color: #64748b; margin-bottom: 25px;">Please check back later or contact us directly for any questions.</p>
                    <a href="{{ route('frontsite.contact.index') }}" 
                       class="btn-modern btn-modern-primary" 
                       style="padding: 0.875rem 2rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="bi bi-envelope"></i>
                        Contact Us
                    </a>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Contact CTA -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 1.5rem; padding: 3rem 2rem; text-align: center; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);">
                    <div class="mb-3">
                        <i class="bi bi-headset" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <h3 style="color: white; font-weight: 700; margin-bottom: 1rem;">Still Have Questions?</h3>
                    <p style="color: rgba(255, 255, 255, 0.95); margin-bottom: 2rem; font-size: 1.1rem;">Can't find the answer you're looking for? Our customer support team is here to help!</p>
                    <a href="{{ route('frontsite.contact.index') }}" 
                       style="background: white; color: #667eea; padding: 1rem 2.5rem; border-radius: 0.75rem; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);"
                       class="contact-support-btn">
                        <i class="bi bi-chat-dots"></i>
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-style')
<style>
/* FAQ Item Hover Effect */
.faq-item-modern:hover {
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

/* FAQ Question Active State */
.faq-question-modern.active .faq-icon {
    transform: rotate(180deg);
}

.faq-question-modern:hover {
    background: #f8fafc !important;
}

/* FAQ Answer Styling */
.faq-answer-modern p {
    margin-bottom: 1rem;
}

.faq-answer-modern ul,
.faq-answer-modern ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.faq-answer-modern li {
    margin-bottom: 0.5rem;
}

.faq-answer-modern a {
    color: #667eea;
    text-decoration: underline;
    transition: all 0.3s;
}

.faq-answer-modern a:hover {
    color: #764ba2;
}

.faq-answer-modern strong {
    font-weight: 700;
    color: #1e293b;
}

/* Contact Support Button Hover */
.contact-support-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    background: #f8fafc !important;
}

/* Collapse Animation */
.collapse {
    transition: height 0.3s ease;
}

/* Bootstrap Icon Animation */
.faq-question-modern[aria-expanded="true"] .faq-icon {
    transform: rotate(180deg);
}
</style>
@endpush

@push('after-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add active class toggle for FAQ items
    const faqButtons = document.querySelectorAll('.faq-question-modern');
    
    faqButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            faqButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button if it's expanding
            if (this.getAttribute('aria-expanded') === 'false') {
                this.classList.add('active');
            }
        });
    });
});
</script>
@endpush
