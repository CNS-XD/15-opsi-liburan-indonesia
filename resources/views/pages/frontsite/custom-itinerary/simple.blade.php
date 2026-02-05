@extends('layouts.frontsite')

@section('title', 'Create Custom Itinerary - Opsi Liburan Indonesia')
@section('activeMenuCustomItinerary', 'active')

@section('content')
<div class="container" style="padding: 50px 0;">
    <div class="row">
        <div class="col-12">
            <h1>Create Your Custom Itinerary</h1>
            <p>Tell us your dream trip and we'll make it happen</p>
            
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('frontsite.custom-itinerary.store') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="customer_name">Full Name *</label>
                            <input type="text" id="customer_name" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" 
                                   value="{{ old('customer_name') }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="participants_adult">Adults *</label>
                            <input type="number" id="participants_adult" name="participants_adult" class="form-control @error('participants_adult') is-invalid @enderror" 
                                   min="1" value="{{ old('participants_adult', 2) }}" required>
                            @error('participants_adult')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="participants_child">Children</label>
                            <input type="number" id="participants_child" name="participants_child" class="form-control @error('participants_child') is-invalid @enderror" 
                                   min="0" value="{{ old('participants_child', 0) }}">
                            @error('participants_child')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="duration_days">Duration (Days) *</label>
                            <select id="duration_days" name="duration_days" class="form-control @error('duration_days') is-invalid @enderror" required>
                                <option value="">Select duration</option>
                                @for($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}" {{ old('duration_days') == $i ? 'selected' : '' }}>
                                        {{ $i }} Day{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                                <option value="15" {{ old('duration_days') == '15' ? 'selected' : '' }}>15+ Days</option>
                            </select>
                            @error('duration_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="tour_type">Tour Type *</label>
                            <select id="tour_type" name="tour_type" class="form-control @error('tour_type') is-invalid @enderror" required>
                                <option value="">Select tour type</option>
                                <option value="private" {{ old('tour_type') == 'private' ? 'selected' : '' }}>Private Tour</option>
                                <option value="sharing" {{ old('tour_type') == 'sharing' ? 'selected' : '' }}>Sharing Tour</option>
                                <option value="group" {{ old('tour_type') == 'group' ? 'selected' : '' }}>Group Tour</option>
                            </select>
                            @error('tour_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="accommodation_level">Accommodation Level *</label>
                            <select id="accommodation_level" name="accommodation_level" class="form-control @error('accommodation_level') is-invalid @enderror" required>
                                <option value="">Select accommodation</option>
                                <option value="budget" {{ old('accommodation_level') == 'budget' ? 'selected' : '' }}>Budget</option>
                                <option value="standard" {{ old('accommodation_level') == 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="luxury" {{ old('accommodation_level') == 'luxury' ? 'selected' : '' }}>Luxury</option>
                            </select>
                            @error('accommodation_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="transportation_type">Transportation *</label>
                            <select id="transportation_type" name="transportation_type" class="form-control @error('transportation_type') is-invalid @enderror" required>
                                <option value="">Select transportation</option>
                                <option value="car" {{ old('transportation_type') == 'car' ? 'selected' : '' }}>Car</option>
                                <option value="bus" {{ old('transportation_type') == 'bus' ? 'selected' : '' }}>Bus</option>
                                <option value="flight" {{ old('transportation_type') == 'flight' ? 'selected' : '' }}>Flight</option>
                            </select>
                            @error('transportation_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="travel_date_start">Start Date (Optional)</label>
                            <input type="date" id="travel_date_start" name="travel_date_start" class="form-control @error('travel_date_start') is-invalid @enderror" 
                                   value="{{ old('travel_date_start') }}">
                            @error('travel_date_start')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="travel_date_end">End Date (Optional)</label>
                            <input type="date" id="travel_date_end" name="travel_date_end" class="form-control @error('travel_date_end') is-invalid @enderror" 
                                   value="{{ old('travel_date_end') }}">
                            @error('travel_date_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" id="date_flexible" name="date_flexible" class="form-check-input" value="1" {{ old('date_flexible') ? 'checked' : '' }}>
                                <label for="date_flexible" class="form-check-label">My travel dates are flexible</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label>Destinations *</label>
                            @error('destinations')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="row">
                                @foreach($destinations as $destination)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input type="checkbox" id="dest_{{ $destination->id }}" name="destinations[]" value="{{ $destination->id }}" 
                                                   class="form-check-input" {{ in_array($destination->id, old('destinations', [])) ? 'checked' : '' }}>
                                            <label for="dest_{{ $destination->id }}" class="form-check-label">{{ $destination->title }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="special_requirements">Special Requirements</label>
                            <textarea id="special_requirements" name="special_requirements" class="form-control @error('special_requirements') is-invalid @enderror" 
                                      rows="4" placeholder="Any special requirements, dietary restrictions, accessibility needs, etc.">{{ old('special_requirements') }}</textarea>
                            @error('special_requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg">Submit Custom Itinerary Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection