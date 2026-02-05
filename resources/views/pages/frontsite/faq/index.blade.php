@extends('layouts.frontsite')

@section('title', 'Frequently Asked Questions - Travel Indonesia')

@section('meta_description', 'Find answers to frequently asked questions about our travel services, booking process, and tour packages.')

@section('content')
<!-- Breadcrumb Section -->
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url('{{ asset('frontsite-assets/img/innerpages/destination-card4-img4.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="banner-content">
                    <h1>Frequently Asked Questions</h1>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ route('frontsite.home.index') }}">Home</a></li>
                        <li>FAQ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="faq-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-head text-center">
                    <h2>Frequently Asked Questions</h2>
                    <p>Find answers to common questions about our travel services</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($faqs->count() > 0)
                <div class="faq-accordion">
                    <div class="accordion" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    {{ $faq->title }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {!! $faq->description !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <h4>No FAQs available</h4>
                    <p>Please check back later or contact us directly for any questions.</p>
                    <a href="{{ route('frontsite.contact.index') }}" class="btn btn-primary">Contact Us</a>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Contact CTA -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="faq-cta text-center">
                    <h4>Still have questions?</h4>
                    <p>Can't find the answer you're looking for? Please contact our customer support team.</p>
                    <a href="{{ route('frontsite.contact.index') }}" class="btn btn-primary">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-style')
<style>
.faq-accordion .accordion-item {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-bottom: 15px;
}

.faq-accordion .accordion-button {
    background-color: #fff;
    color: #333 !important;
    font-weight: 600;
    padding: 20px;
    border: none;
    border-radius: 8px;
}

.faq-accordion .accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #007bff !important;
}

.faq-accordion .accordion-button:focus {
    box-shadow: none;
    border-color: transparent;
}

.faq-accordion .accordion-body {
    padding: 20px;
    background-color: #fff;
    color: #333 !important;
}

.faq-cta {
    background-color: #f8f9fa;
    padding: 50px 30px;
    border-radius: 10px;
}

.faq-cta h4 {
    margin-bottom: 15px;
    color: #333;
}

.faq-cta p {
    margin-bottom: 25px;
    color: #666;
}
</style>
@endpush