@extends('layouts.frontsite')

@section('title', 'Create Custom Itinerary - Opsi Liburan Indonesia')
@section('activeMenuCustomItinerary', 'active')

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-section" style="height: 30px; background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/frontsite-assets/img/innerpages/breadcrumb-bg1.jpg);">  
    <div class="container">
        <div class="banner-content" style="margin-top: -60px;">
            <h1 class="text-white">Create Your Custom Itinerary</h1>
            <h3 class="text-white">Tell us your dream trip and we'll make it happen</h3>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Custom Itinerary Form Section Start -->
<div class="custom-itinerary-section">
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
                            <button type="button" id="prev-step" class="btn btn-secondary" style="display: none;">Previous</button>
                            <button type="button" id="next-step" class="btn btn-primary">Next</button>
                            <button type="submit" id="submit-form" class="btn btn-success" style="display: none;">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Custom Itinerary Form Section End -->

<style>
.custom-itinerary-section {
    padding: 80px 0;
    background-color: #f8f9fa;
}

.custom-itinerary-wrapper {
    background: white;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-progress {
    margin-bottom: 40px;
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
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #e9ecef;
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
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.step.active .step-number {
    background-color: #007bff;
    color: white;
}

.step.completed .step-number {
    background-color: #28a745;
    color: white;
}

.step-title {
    font-size: 12px;
    color: #6c757d;
    text-align: center;
}

.step.active .step-title {
    color: #007bff;
    font-weight: 600;
}

.form-step {
    display: none;
}

.form-step.active {
    display: block;
}

.step-header {
    text-align: center;
    margin-bottom: 40px;
}

.step-header h3 {
    color: #2c3e50;
    margin-bottom: 10px;
}

.step-header p {
    color: #6c757d;
    margin-bottom: 0;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.destinations-grid, .activities-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 10px;
}

.destination-item, .activity-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.destination-item:hover, .activity-item:hover {
    border-color: #007bff;
    background-color: #f8f9ff;
}

.destination-item input[type="checkbox"], .activity-item input[type="checkbox"] {
    margin-right: 10px;
}

.destination-item input[type="checkbox"]:checked + label,
.activity-item input[type="checkbox"]:checked + label {
    color: #007bff;
    font-weight: 600;
}

.form-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #e9ecef;
}

.btn {
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.review-summary {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 30px;
}

.summary-section {
    margin-bottom: 30px;
}

.summary-section:last-child {
    margin-bottom: 0;
}

.summary-section h4 {
    color: #2c3e50;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #007bff;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #e9ecef;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-item .label {
    font-weight: 600;
    color: #495057;
}

.summary-item .value {
    color: #2c3e50;
}

@media (max-width: 768px) {
    .custom-itinerary-wrapper {
        padding: 20px;
    }
    
    .progress-steps {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .step {
        flex: 1;
        min-width: 80px;
    }
    
    .destinations-grid, .activities-grid {
        grid-template-columns: 1fr;
    }
    
    .form-navigation {
        flex-direction: column;
        gap: 15px;
    }
    
    .summary-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('custom-itinerary-form');
    const steps = document.querySelectorAll('.form-step');
    const progressSteps = document.querySelectorAll('.progress-steps .step');
    const nextBtn = document.getElementById('next-step');
    const prevBtn = document.getElementById('prev-step');
    const submitBtn = document.getElementById('submit-form');
    
    let currentStep = 1;
    const totalSteps = steps.length;
    
    // Initialize
    showStep(currentStep);
    
    // Next button click
    nextBtn.addEventListener('click', function() {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
                updateReview();
            }
        }
    });
    
    // Previous button click
    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });
    
    // Show specific step
    function showStep(step) {
        // Hide all steps
        steps.forEach(s => s.classList.remove('active'));
        progressSteps.forEach(s => s.classList.remove('active', 'completed'));
        
        // Show current step
        document.querySelector(`[data-step="${step}"]`).classList.add('active');
        document.querySelector(`.progress-steps [data-step="${step}"]`).classList.add('active');
        
        // Mark completed steps
        for (let i = 1; i < step; i++) {
            document.querySelector(`.progress-steps [data-step="${i}"]`).classList.add('completed');
        }
        
        // Update navigation buttons
        prevBtn.style.display = step > 1 ? 'inline-block' : 'none';
        nextBtn.style.display = step < totalSteps ? 'inline-block' : 'none';
        submitBtn.style.display = step === totalSteps ? 'inline-block' : 'none';
    }
    
    // Validate current step
    function validateStep(step) {
        const currentStepElement = document.querySelector(`[data-step="${step}"]`);
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