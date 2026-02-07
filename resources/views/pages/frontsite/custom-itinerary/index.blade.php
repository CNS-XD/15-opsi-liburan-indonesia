@extends('layouts.frontsite')

@section('title', 'Create Custom Itinerary - Opsi Liburan Indonesia')
@section('activeMenuCustomItinerary', 'active')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="min-height: 50vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-content animate-fade-in-up">
                    <div style="margin-bottom: 1.5rem;">
                        <i class="bi bi-calendar-plus" style="font-size: 4rem; color: rgba(255, 255, 255, 0.9);"></i>
                    </div>
                    <h1 style="color: white; margin-bottom: 1rem; font-weight: 700;">Create Your Custom Itinerary</h1>
                    <p style="color: rgba(255, 255, 255, 0.95); font-size: 1.2rem;">Tell us your dream trip and we'll make it happen</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Itinerary Form Section Start -->
<section class="section-modern" style="background: #f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="custom-itinerary-wrapper">
                    <div class="form-progress">
                        <div class="progress-steps">
                            <div class="step active" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-title">Basic Info</div>
                            </div>
                            <div class="step" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-title">Trip Details</div>
                            </div>
                            <div class="step" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-title">Preferences</div>
                            </div>
                            <div class="step" data-step="4">
                                <div class="step-number">4</div>
                                <div class="step-title">Activities</div>
                            </div>
                            <div class="step" data-step="5">
                                <div class="step-number">5</div>
                                <div class="step-title">Review</div>
                            </div>
                        </div>
                    </div>

                    <form id="custom-itinerary-form" method="POST" action="{{ route('frontsite.custom-itinerary.store') }}">
                        @csrf
                        
                        <!-- Step 1: Basic Information -->
                        <div class="form-step active" data-step="1">
                            <div class="step-header">
                                <h3>Basic Information</h3>
                                <p>Tell us about yourself and your travel group</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_name">Full Name *</label>
                                        <input type="text" id="customer_name" name="customer_name" class="form-control" required value="{{ old('customer_name') }}">
                                        @error('customer_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number *</label>
                                        <input type="tel" id="phone" name="phone" class="form-control" required value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="participants_adult">Adults *</label>
                                        <input type="number" id="participants_adult" name="participants_adult" class="form-control" min="1" required value="{{ old('participants_adult', 2) }}">
                                        @error('participants_adult')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="participants_child">Children</label>
                                        <input type="number" id="participants_child" name="participants_child" class="form-control" min="0" value="{{ old('participants_child', 0) }}">
                                        @error('participants_child')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="budget_min">Budget Range (USD)</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="number" id="budget_min" name="budget_min" class="form-control" placeholder="Min budget" value="{{ old('budget_min') }}">
                                            </div>
                                            <div class="col-6">
                                                <input type="number" id="budget_max" name="budget_max" class="form-control" placeholder="Max budget" value="{{ old('budget_max') }}">
                                            </div>
                                        </div>
                                        <small class="text-muted">Leave blank if flexible</small>
                                        @error('budget_min')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('budget_max')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Trip Details -->
                        <div class="form-step" data-step="2">
                            <div class="step-header">
                                <h3>Trip Details</h3>
                                <p>When and where would you like to go?</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="duration_days">Duration (Days) *</label>
                                        <select id="duration_days" name="duration_days" class="form-control" required>
                                            <option value="">Select duration</option>
                                            @for($i = 1; $i <= 14; $i++)
                                                <option value="{{ $i }}" {{ old('duration_days') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Day{{ $i > 1 ? 's' : '' }}
                                                </option>
                                            @endfor
                                            <option value="15" {{ old('duration_days') == '15' ? 'selected' : '' }}>15+ Days</option>
                                        </select>
                                        @error('duration_days')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="travel_date_start">Start Date</label>
                                        <input type="date" id="travel_date_start" name="travel_date_start" class="form-control" value="{{ old('travel_date_start') }}">
                                        @error('travel_date_start')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="travel_date_end">End Date</label>
                                        <input type="date" id="travel_date_end" name="travel_date_end" class="form-control" value="{{ old('travel_date_end') }}">
                                        @error('travel_date_end')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" id="date_flexible" name="date_flexible" class="form-check-input" value="1" {{ old('date_flexible') ? 'checked' : '' }}>
                                            <label for="date_flexible" class="form-check-label">My travel dates are flexible</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destinations">Destinations *</label>
                                        <div class="destinations-grid">
                                            @foreach($destinations as $destination)
                                                <div class="destination-item">
                                                    <input type="checkbox" id="dest_{{ $destination->id }}" name="destinations[]" value="{{ $destination->id }}" 
                                                           {{ in_array($destination->id, old('destinations', [])) ? 'checked' : '' }}>
                                                    <label for="dest_{{ $destination->id }}">{{ $destination->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('destinations')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Preferences -->
                        <div class="form-step" data-step="3">
                            <div class="step-header">
                                <h3>Travel Preferences</h3>
                                <p>Tell us about your travel style and preferences</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tour_type">Tour Type *</label>
                                        <select id="tour_type" name="tour_type" class="form-control" required>
                                            <option value="">Select tour type</option>
                                            <option value="private" {{ old('tour_type') == 'private' ? 'selected' : '' }}>Private Tour</option>
                                            <option value="sharing" {{ old('tour_type') == 'sharing' ? 'selected' : '' }}>Sharing Tour</option>
                                            <option value="group" {{ old('tour_type') == 'group' ? 'selected' : '' }}>Group Tour</option>
                                        </select>
                                        @error('tour_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="accommodation_level">Accommodation Level *</label>
                                        <select id="accommodation_level" name="accommodation_level" class="form-control" required>
                                            <option value="">Select accommodation</option>
                                            <option value="budget" {{ old('accommodation_level') == 'budget' ? 'selected' : '' }}>Budget</option>
                                            <option value="standard" {{ old('accommodation_level') == 'standard' ? 'selected' : '' }}>Standard</option>
                                            <option value="luxury" {{ old('accommodation_level') == 'luxury' ? 'selected' : '' }}>Luxury</option>
                                        </select>
                                        @error('accommodation_level')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="transportation_type">Transportation *</label>
                                        <select id="transportation_type" name="transportation_type" class="form-control" required>
                                            <option value="">Select transportation</option>
                                            <option value="car" {{ old('transportation_type') == 'car' ? 'selected' : '' }}>Car</option>
                                            <option value="bus" {{ old('transportation_type') == 'bus' ? 'selected' : '' }}>Bus</option>
                                            <option value="flight" {{ old('transportation_type') == 'flight' ? 'selected' : '' }}>Flight</option>
                                        </select>
                                        @error('transportation_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Activities -->
                        <div class="form-step" data-step="4">
                            <div class="step-header">
                                <h3>Activities & Interests</h3>
                                <p>What activities would you like to include in your trip?</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Activities (Optional)</label>
                                        <div class="activities-grid">
                                            <div class="activity-item">
                                                <input type="checkbox" id="activity_adventure" name="activities[]" value="Adventure Activities" 
                                                       {{ in_array('Adventure Activities', old('activities', [])) ? 'checked' : '' }}>
                                                <label for="activity_adventure">Adventure Activities</label>
                                            </div>
                                            <div class="activity-item">
                                                <input type="checkbox" id="activity_cultural" name="activities[]" value="Cultural Tours" 
                                                       {{ in_array('Cultural Tours', old('activities', [])) ? 'checked' : '' }}>
                                                <label for="activity_cultural">Cultural Tours</label>
                                            </div>
                                            <div class="activity-item">
                                                <input type="checkbox" id="activity_nature" name="activities[]" value="Nature & Wildlife" 
                                                       {{ in_array('Nature & Wildlife', old('activities', [])) ? 'checked' : '' }}>
                                                <label for="activity_nature">Nature & Wildlife</label>
                                            </div>
                                            <div class="activity-item">
                                                <input type="checkbox" id="activity_photography" name="activities[]" value="Photography" 
                                                       {{ in_array('Photography', old('activities', [])) ? 'checked' : '' }}>
                                                <label for="activity_photography">Photography</label>
                                            </div>
                                            <div class="activity-item">
                                                <input type="checkbox" id="activity_food" name="activities[]" value="Food & Culinary" 
                                                       {{ in_array('Food & Culinary', old('activities', [])) ? 'checked' : '' }}>
                                                <label for="activity_food">Food & Culinary</label>
                                            </div>
                                            <div class="activity-item">
                                                <input type="checkbox" id="activity_beach" name="activities[]" value="Beach & Water Sports" 
                                                       {{ in_array('Beach & Water Sports', old('activities', [])) ? 'checked' : '' }}>
                                                <label for="activity_beach">Beach & Water Sports</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="special_requirements">Special Requirements</label>
                                        <textarea id="special_requirements" name="special_requirements" class="form-control" rows="4" 
                                                  placeholder="Any special requirements, dietary restrictions, accessibility needs, etc.">{{ old('special_requirements') }}</textarea>
                                        @error('special_requirements')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Review -->
                        <div class="form-step" data-step="5">
                            <div class="step-header">
                                <h3>Review Your Request</h3>
                                <p>Please review your custom itinerary request before submitting</p>
                            </div>
                            
                            <div class="review-summary">
                                <div class="summary-section">
                                    <h4>Contact Information</h4>
                                    <div class="summary-item">
                                        <span class="label">Name:</span>
                                        <span class="value" id="review-name">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="label">Email:</span>
                                        <span class="value" id="review-email">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="label">Phone:</span>
                                        <span class="value" id="review-phone">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="label">Participants:</span>
                                        <span class="value" id="review-participants">-</span>
                                    </div>
                                </div>
                                
                                <div class="summary-section">
                                    <h4>Trip Details</h4>
                                    <div class="summary-item">
                                        <span class="label">Duration:</span>
                                        <span class="value" id="review-duration">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="label">Travel Dates:</span>
                                        <span class="value" id="review-dates">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="label">Destinations:</span>
                                        <span class="value" id="review-destinations">-</span>
                                    </div>
                                </div>
                                
                                <div class="summary-section">
                                    <h4>Preferences</h4>
                                    <div class="summary-item">
                                        <span class="label">Tour Type:</span>
                                        <span class="value" id="review-tour-type">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="label">Accommodation:</span>
                                        <span class="value" id="review-accommodation">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="label">Transportation:</span>
                                        <span class="value" id="review-transportation">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Navigation -->
                        <div class="form-navigation">
                            <button type="button" id="prev-step" class="btn-modern btn-modern-secondary" style="display: none;">
                                <i class="bi bi-arrow-left me-2"></i>Previous
                            </button>
                            <button type="button" id="next-step" class="btn-modern btn-modern-primary">
                                Next<i class="bi bi-arrow-right ms-2"></i>
                            </button>
                            <button type="submit" id="submit-form" class="btn-modern btn-modern-primary" style="display: none; background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                <i class="bi bi-check-circle me-2"></i>Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Custom Itinerary Form Section End -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('custom-itinerary-form');
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-steps .step');
    const nextBtn = document.getElementById('next-step');
    const prevBtn = document.getElementById('prev-step');
    const submitBtn = document.getElementById('submit-form');
    
    console.log('Form initialized:', {
        form: form,
        steps: steps.length,
        progressSteps: progressSteps.length,
        nextBtn: nextBtn,
        prevBtn: prevBtn,
        submitBtn: submitBtn
    });
    
    let currentStep = 1;
    const totalSteps = steps.length;
    
    // Initialize
    showStep(currentStep);
    
    // Next button click
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Next clicked, current step:', currentStep);
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                    updateReview();
                }
            }
        });
    }
    
    // Previous button click
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Previous clicked, current step:', currentStep);
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    }
    
    // Show specific step
    function showStep(step) {
        // Hide all steps
        steps.forEach(s => {
            s.classList.remove('active');
            s.style.display = 'none';
        });
        progressSteps.forEach(s => s.classList.remove('active', 'completed'));
        
        // Show current step
        const currentFormStep = document.querySelector(`.form-step[data-step="${step}"]`);
        if (currentFormStep) {
            currentFormStep.classList.add('active');
            currentFormStep.style.display = 'block';
        }
        
        const currentProgressStep = document.querySelector(`.progress-steps .step[data-step="${step}"]`);
        if (currentProgressStep) {
            currentProgressStep.classList.add('active');
        }
        
        // Mark completed steps
        for (let i = 1; i < step; i++) {
            const completedStep = document.querySelector(`.progress-steps .step[data-step="${i}"]`);
            if (completedStep) {
                completedStep.classList.add('completed');
            }
        }
        
        // Update navigation buttons
        prevBtn.style.display = step > 1 ? 'inline-flex' : 'none';
        nextBtn.style.display = step < totalSteps ? 'inline-flex' : 'none';
        submitBtn.style.display = step === totalSteps ? 'inline-flex' : 'none';
    }
    
    // Validate current step
    function validateStep(step) {
        const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);
        if (!currentStepElement) return true;
        
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (field.type === 'checkbox') {
                // For checkbox groups (like destinations)
                if (field.name.includes('[]')) {
                    const checkboxGroup = currentStepElement.querySelectorAll(`[name="${field.name}"]`);
                    const isChecked = Array.from(checkboxGroup).some(cb => cb.checked);
                    if (!isChecked) {
                        isValid = false;
                        showFieldError(field, 'Please select at least one option');
                    } else {
                        clearFieldError(field);
                    }
                }
            } else {
                if (!field.value.trim()) {
                    isValid = false;
                    showFieldError(field, 'This field is required');
                } else {
                    clearFieldError(field);
                }
            }
        });
        
        return isValid;
    }
    
    // Show field error
    function showFieldError(field, message) {
        clearFieldError(field);
        field.classList.add('is-invalid');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-danger mt-1';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }
    
    // Clear field error
    function clearFieldError(field) {
        field.classList.remove('is-invalid');
        const existingError = field.parentNode.querySelector('.text-danger');
        if (existingError) {
            existingError.remove();
        }
    }
    
    // Update review summary
    function updateReview() {
        if (currentStep === totalSteps) {
            // Contact Information
            document.getElementById('review-name').textContent = document.getElementById('customer_name').value || '-';
            document.getElementById('review-email').textContent = document.getElementById('email').value || '-';
            document.getElementById('review-phone').textContent = document.getElementById('phone').value || '-';
            
            const adults = document.getElementById('participants_adult').value || 0;
            const children = document.getElementById('participants_child').value || 0;
            document.getElementById('review-participants').textContent = `${adults} Adults, ${children} Children`;
            
            // Trip Details
            const duration = document.getElementById('duration_days').value;
            document.getElementById('review-duration').textContent = duration ? `${duration} Days` : '-';
            
            const startDate = document.getElementById('travel_date_start').value;
            const endDate = document.getElementById('travel_date_end').value;
            const flexible = document.getElementById('date_flexible').checked;
            
            let dateText = '-';
            if (flexible) {
                dateText = 'Flexible dates';
            } else if (startDate && endDate) {
                dateText = `${startDate} to ${endDate}`;
            } else if (startDate) {
                dateText = `From ${startDate}`;
            }
            document.getElementById('review-dates').textContent = dateText;
            
            // Destinations
            const selectedDestinations = Array.from(document.querySelectorAll('input[name="destinations[]"]:checked'))
                .map(cb => cb.nextElementSibling.textContent);
            document.getElementById('review-destinations').textContent = selectedDestinations.length > 0 ? selectedDestinations.join(', ') : '-';
            
            // Preferences
            const tourType = document.getElementById('tour_type');
            document.getElementById('review-tour-type').textContent = tourType.options[tourType.selectedIndex]?.text || '-';
            
            const accommodation = document.getElementById('accommodation_level');
            document.getElementById('review-accommodation').textContent = accommodation.options[accommodation.selectedIndex]?.text || '-';
            
            const transportation = document.getElementById('transportation_type');
            document.getElementById('review-transportation').textContent = transportation.options[transportation.selectedIndex]?.text || '-';
        }
    }
    
    // Handle flexible dates checkbox
    document.getElementById('date_flexible').addEventListener('change', function() {
        const startDate = document.getElementById('travel_date_start');
        const endDate = document.getElementById('travel_date_end');
        
        if (this.checked) {
            startDate.disabled = true;
            endDate.disabled = true;
            startDate.value = '';
            endDate.value = '';
        } else {
            startDate.disabled = false;
            endDate.disabled = false;
        }
    });
});
</script>
@endsection

@push('after-style')
<style>
/* Wrapper Styling */
.custom-itinerary-wrapper {
    background: white;
    border-radius: 1.5rem;
    padding: 3rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

/* Progress Steps Styling */
.form-progress {
    margin-bottom: 3rem;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    margin-bottom: 30px;
}

.progress-steps::before {
    content: '';
    position: absolute;
    top: 22px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #e9ecef 0%, #e9ecef 100%);
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    background: white;
    padding: 0 15px;
}

.step-number {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background-color: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    margin-bottom: 8px;
    transition: all 0.3s ease;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.step.active .step-number {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    transform: scale(1.1);
}

.step.completed .step-number {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.step-title {
    font-size: 13px;
    color: #6c757d;
    text-align: center;
    font-weight: 600;
}

.step.active .step-title {
    color: #667eea;
    font-weight: 700;
}

/* Form Step Display */
.form-step {
    display: none !important;
}

.form-step.active {
    display: block !important;
}

/* Step Header */
.step-header {
    text-align: center;
    margin-bottom: 3rem;
}

.step-header h3 {
    color: #1e293b;
    margin-bottom: 0.75rem;
    font-weight: 700;
    font-size: 1.75rem;
}

.step-header p {
    color: #64748b;
    margin-bottom: 0;
    font-size: 1.05rem;
}

/* Form Group */
.form-group {
    margin-bottom: 1.75rem;
}

.form-group label {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.95rem;
}

/* Enhanced Form Input Styling */
.custom-itinerary-wrapper .form-control,
.custom-itinerary-wrapper .form-select,
.custom-itinerary-wrapper select.form-control {
    border: 2px solid #cbd5e1 !important;
    border-radius: 0.75rem !important;
    padding: 0.875rem 1rem !important;
    font-size: 0.95rem !important;
    transition: all 0.3s ease !important;
    color: #1e293b !important;
    background: white !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06) !important;
}

.custom-itinerary-wrapper .form-control:hover,
.custom-itinerary-wrapper .form-select:hover,
.custom-itinerary-wrapper select.form-control:hover {
    border-color: #94a3b8 !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}

.custom-itinerary-wrapper .form-control:focus,
.custom-itinerary-wrapper .form-select:focus,
.custom-itinerary-wrapper select.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1) !important;
    outline: none !important;
    background: white !important;
}

.custom-itinerary-wrapper .form-control::placeholder {
    color: #94a3b8 !important;
}

.custom-itinerary-wrapper textarea.form-control {
    min-height: 120px !important;
    resize: vertical !important;
}

/* Checkbox and Radio Styling */
.custom-itinerary-wrapper input[type="checkbox"],
.custom-itinerary-wrapper input[type="radio"] {
    width: 20px !important;
    height: 20px !important;
    border: 2px solid #cbd5e1 !important;
    border-radius: 0.375rem !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
}

.custom-itinerary-wrapper input[type="checkbox"]:checked,
.custom-itinerary-wrapper input[type="radio"]:checked {
    background-color: #667eea !important;
    border-color: #667eea !important;
}

.custom-itinerary-wrapper input[type="checkbox"]:focus,
.custom-itinerary-wrapper input[type="radio"]:focus {
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15) !important;
    outline: none !important;
}

/* Destination and Activity Cards */
.destinations-grid, .activities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.custom-itinerary-wrapper .destination-item,
.custom-itinerary-wrapper .activity-item {
    background: white !important;
    border: 2px solid #cbd5e1 !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06) !important;
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.custom-itinerary-wrapper .destination-item:hover,
.custom-itinerary-wrapper .activity-item:hover {
    border-color: #667eea !important;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2) !important;
    transform: translateY(-2px);
}

.custom-itinerary-wrapper .destination-item input[type="checkbox"],
.custom-itinerary-wrapper .activity-item input[type="checkbox"] {
    margin-right: 0.75rem;
}

.custom-itinerary-wrapper .destination-item label,
.custom-itinerary-wrapper .activity-item label {
    margin: 0;
    cursor: pointer;
    flex: 1;
}

.custom-itinerary-wrapper input[type="checkbox"]:checked ~ label {
    color: #667eea !important;
    font-weight: 700 !important;
}

/* Form Navigation */
.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid #e2e8f0;
}

/* Review Summary */
.review-summary {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 1rem;
    padding: 2rem;
    border: 2px solid #e2e8f0;
}

.summary-section {
    margin-bottom: 2rem;
    background: white;
    padding: 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.summary-section:last-child {
    margin-bottom: 0;
}

.summary-section h4 {
    color: #1e293b;
    margin-bottom: 1.25rem;
    padding-bottom: 0.75rem;
    border-bottom: 3px solid #667eea;
    font-weight: 700;
    font-size: 1.25rem;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-item .label {
    font-weight: 600;
    color: #64748b;
    font-size: 0.95rem;
}

.summary-item .value {
    color: #1e293b;
    font-weight: 600;
    text-align: right;
}

/* Date Input */
.custom-itinerary-wrapper input[type="date"] {
    background: white !important;
    cursor: pointer !important;
}

.custom-itinerary-wrapper input[type="date"]::-webkit-calendar-picker-indicator {
    cursor: pointer !important;
    filter: invert(45%) sepia(78%) saturate(1345%) hue-rotate(221deg) brightness(95%) contrast(91%);
}

/* Form Check */
.form-check {
    padding-left: 0;
}

.form-check-input {
    margin-right: 0.5rem;
}

.form-check-label {
    cursor: pointer;
}

/* Responsive */
@media (max-width: 768px) {
    .custom-itinerary-wrapper {
        padding: 1.5rem;
    }
    
    .progress-steps {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .step {
        flex: 1;
        min-width: 70px;
    }
    
    .step-number {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
    }
    
    .step-title {
        font-size: 11px;
    }
    
    .destinations-grid, .activities-grid {
        grid-template-columns: 1fr;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-navigation .btn-modern {
        width: 100%;
    }
    
    .summary-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .summary-item .value {
        text-align: left;
    }
}
</style>
@endpush