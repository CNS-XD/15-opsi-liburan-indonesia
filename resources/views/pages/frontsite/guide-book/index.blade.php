@extends('layouts.frontsite')

@section('title', 'How to Book - Guide Book | Opsi Liburan Indonesia')
@section('meta_description', 'Learn how to book your perfect tour package with Opsi Liburan Indonesia. Simple step-by-step guide to make your booking process easy and secure.')

@section('content')
<div class="guide-book-page">
    <div class="steps-section">
        <div class="container">
            @foreach($steps as $index => $step)
            <div class="step-container">
                
                <!-- 1. Text Content -->
                <div class="step-content">
                    <h2 class="title-text">Step {{ $step['number'] }}.</h2>
                    <p class="desc-text">{{ $step['description'] }}</p>
                </div>

                <!-- 2. The Loop Line Structure -->
                <!-- Ideally placed absolute behind content or relative sibling -->
                <div class="loop-structure">
                    <!-- Top horizontal line -->
                    <div class="line-top"></div>
                    
                    <!-- Right vertical line with top curve -->
                    <div class="line-right-vertical">
                        <div class="plane-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" style="transform: rotate(90deg);">
                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" fill="#D4A853"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Bottom return curve -->
                    <div class="line-bottom-return"></div>
                    
                    <!-- Line to mockup cap -->
                    <div class="line-to-mockup-cap"></div>
                </div>

                <!-- 3. Mockup -->
                <div class="mockup-wrapper">
                    <div class="phone-mockup">
                        <div class="phone-header">
                            <span class="step-label">STEP {{ $step['number'] }}</span>
                            <div class="phone-dots"><span></span><span></span><span></span></div>
                        </div>
                        <div class="phone-content">
                            <img src="{{ $step['image'] }}" alt="{{ $step['title'] }}" onerror="this.src='/frontsite-assets/img/guide/booking-illustration.svg'">
                        </div>
                    </div>
                </div>

                <!-- 4. Connector to Next -->
                @if($index < count($steps) - 1)
                <div class="connector-next"></div>
                @endif

            </div>
            @endforeach
        </div>
    </div>
    
    <div class="cta-section">
        <div class="container">
            <h2>Ready to Start Your Adventure?</h2>
            <p>Book your perfect tour package today!</p>
            <a href="{{ route('index') }}#tours" class="cta-button">Start Booking Now</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Base Styles */
.guide-book-page { 
    background: #fff; 
    min-height: 100vh; 
    font-family: 'Inter', sans-serif;
    overflow-x: hidden;
}

.container { 
    max-width: 500px; 
    margin: 0 auto; 
    padding: 0 20px; 
    position: relative;
}

.steps-section {
    padding: 60px 0 0;
}

.step-container { 
    margin-bottom: 0; 
    padding-bottom: 50px; /* Space for next step connection */
    position: relative;
}

/* Text Content */
.step-content { 
    text-align: left; 
    position: relative;
    z-index: 5;
}

.title-text { 
    font-size: 2.5rem; 
    font-weight: 800; 
    color: #1F2937; 
    margin: 0; 
    display: inline-block; 
    background: #fff; 
    position: relative; 
    padding-right: 15px;
}

.desc-text { 
    color: #4B5563; 
    font-size: 1rem; 
    margin-top: 10px; 
    max-width: 85%; 
    line-height: 1.6;
}

/* Loop Structure */
.loop-structure {
    position: absolute;
    top: 25px; /* Aligns with middle of title text approx */
    left: 0;
    right: -25px; /* Extend slightly outside container */
    bottom: 0px; 
    pointer-events: none;
    z-index: 1;
}

.line-top {
    position: absolute;
    left: 120px; /* Start after text */
    right: 0;
    top: 0;
    height: 1px;
    border-top: 3px dashed #9CA3AF;
}

.line-right-vertical {
    position: absolute;
    top: 0;
    right: 0;
    /* Height: defined by bottom offset */
    bottom: 120px; /* Stop above mockup area */
    width: 20px;
    border-right: 3px dashed #9CA3AF;
    border-top-right-radius: 25px;
}

.plane-icon {
    position: absolute;
    top: 50%;
    right: -13px; /* Centered on the 3px border */
    background: white;
    padding: 8px 0;
    transform: translateY(-50%);
}

.line-bottom-return {
    position: absolute;
    right: 0;
    bottom: 80px; /* Where vertical ends + curve */
    /* This needs to connect to line-right-vertical */
    /* Let's adjust: right-vertical goes down to X. bottom-return continues. */
    
    /* Revised Logic: 
       line-right-vertical handles the top-right corner and straight down part.
       line-bottom-return handles the bottom-right corner and return left.
    */
    bottom: 120px; /* Same as vertical bottom */
    width: 40px;
    height: 40px;
    border-right: 3px dashed #9CA3AF; /* Overlap or continue? */
    border-bottom: 3px dashed #9CA3AF;
    border-bottom-right-radius: 25px;
    /* But vertical has border-right too. */
    /* Hide vertical border at bottom? No. */
}

/* Let's simplify: 
   line-right-vertical is the main U shape. 
   It triggers top-right curve. 
   We need bottom-right curve.
*/
.line-right-vertical {
    bottom: 160px; /* End higher */
    border-bottom-right-radius: 0; /* Straight line */
}

/* Dedicated Bottom Right Curve Element */
.line-bottom-return {
    position: absolute;
    bottom: 120px; /* Position where mockup starts appearing */
    right: 0;
    width: 40px; 
    height: 40px;
    border-right: 3px dashed #9CA3AF;
    border-bottom: 3px dashed #9CA3AF;
    border-bottom-right-radius: 25px;
    border-top: none;
}

/* Line connecting return curve to header center */
.line-to-mockup-cap {
    position: absolute;
    bottom: 120px;
    right: 40px; /* End of return curve */
    left: 50%; /* Center of container */
    height: 1px;
    border-bottom: 3px dashed #9CA3AF;
}

/* Vertical line dropping into mockup */
.line-to-mockup-cap::after {
    content: '';
    position: absolute;
    left: 0; /* Center */
    top: 0; /* Bottom border line */
    height: 30px; /* Drop down */
    width: 1px;
    border-left: 3px dashed #9CA3AF;
}

/* Mockup */
.mockup-wrapper {
    margin-top: 50px; /* Space for the loop to complete */
    position: relative;
    z-index: 2;
    display: flex;
    justify-content: center;
}

.phone-mockup {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 320px;
    overflow: hidden;
}

.phone-header {
    background: #4B5563;
    padding: 12px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.step-label { color: white; font-weight: 600; font-size: 0.85rem; }
.phone-dots span { display: inline-block; width: 6px; height: 6px; background: #9CA3AF; border-radius: 50%; margin: 0 2px; }

.phone-content {
    background: #F3F4F6;
    min-height: 250px;
}
.phone-content img { width: 100%; height: auto; display: block; }

/* Connector to Next Step */
.connector-next {
    position: absolute;
    bottom: -30px; /* Extend into padding */
    left: 50%;
    transform: translateX(-50%);
    width: 1px;
    height: 60px;
    border-left: 3px dashed #9CA3AF;
    z-index: 0;
}

/* CTA */
.cta-section {
    padding: 80px 0;
    text-align: center;
    background: #fff;
}
.cta-section h2 { font-size: 2rem; font-weight: 800; color: #1F2937; margin-bottom: 20px; }
.cta-button { 
    display: inline-block; 
    background: #D4A853; 
    color: white; 
    padding: 15px 40px; 
    border-radius: 50px; 
    font-weight: 600; 
    text-decoration: none;
    transition: all 0.2s;
}
.cta-button:hover { background: #b88f3e; text-decoration: none; color: white; }

/* Responsive */
@media (max-width: 576px) {
    .container { padding: 0 15px; }
    .title-text { font-size: 2rem; }
    .loop-structure { right: -15px; }
    .line-top { left: 100px; }
}
</style>
@endpush

@push('scripts')
<script>
    // Additional scripts if needed
</script>
@endpush