@extends('layouts.frontsite')

@section('title', $tour->title . ' | Opsi Liburan Indonesia')

@section('content')
<!-- Tour Detail Section Start -->
<div class="tour-detail-section py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Tour Images -->
                <div class="tour-images-wrapper mb-4">
                    @if($tour->tour_photos->count() > 1)
                        <div class="swiper tour-detail-slider">
                            <div class="swiper-wrapper">
                                @foreach($tour->tour_photos as $photo)
                                <div class="swiper-slide">
                                    <div class="tour-image">
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $tour->title }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    @else
                        <div class="tour-image single-image">
                            <img src="{{ $tour->tour_photos->first() ? asset('storage/' . $tour->tour_photos->first()->image) : asset('frontsite-assets/img/packages/default.jpg') }}" 
                                 alt="{{ $tour->title }}">
                        </div>
                    @endif
                </div>

                <!-- Tour Header Info -->
                <div class="tour-header-section mb-4">
                    <div class="row align-items-start">
                        <div class="col-lg-8 mb-3 mb-lg-0">
                            <h1 class="tour-title mb-3">{{ $tour->title }}</h1>
                            <div class="tour-meta-wrapper">
                                <div class="rating-section mb-2">
                                    <div class="stars-display">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $averageRating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="rating-text">{{ number_format($averageRating, 1) }}</span>
                                    <span class="reviews-count">({{ $totalReviews }} reviews)</span>
                                </div>
                                <div class="tour-type-badge">
                                    <span class="badge bg-gradient-primary">
                                        <i class="fas {{ $tour->type_tour == 0 ? 'fa-user' : 'fa-users' }} me-1"></i>
                                        {{ $tour->type_tour == 0 ? 'Private Tour' : 'Sharing Tour' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="price-card">
                                <div class="price-label">Starting from</div>
                                <div class="price-value">${{ number_format($tour->price, 0) }}</div>
                                <div class="price-unit">per person</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tour Quick Info Grid -->
                <div class="tour-quick-info-grid mb-5">
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="info-box">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Duration</div>
                                    <div class="info-value">{{ $tour->time_tour }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="info-box">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Group Size</div>
                                    <div class="info-value">{{ $tour->group_size ?? 'Flexible' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="info-box">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Departure</div>
                                    <div class="info-value">
                                        @if($tour->tour_departures->first())
                                            {{ $tour->tour_departures->first()->departure->name }}
                                        @else
                                            Various Cities
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="info-box">
                                <div class="info-icon">
                                    <i class="fas fa-mountain"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Difficulty</div>
                                    <div class="info-value">{{ $tour->level_tour ?? 'Moderate' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tour Description -->
                <div class="content-section mb-4">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle me-2"></i>About This Tour
                    </h3>
                    <div class="content-body description-content">
                        {!! $tour->description !!}
                    </div>
                </div>

                <!-- Tour Details -->
                @if($tour->tour_details->count() > 0)
                <div class="content-section mb-4">
                    <h3 class="section-title">
                        <i class="fas fa-list-ul me-2"></i>Tour Details
                    </h3>
                    <div class="content-body">
                        <div class="details-grid">
                            @foreach($tour->tour_details as $detail)
                            <div class="detail-item-card">
                                <h5 class="detail-title">{{ $detail->title ?? 'Detail' }}</h5>
                                <p class="detail-description">{{ $detail->description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tour Reviews Section -->
                <div class="content-section mb-4">
                    <div class="section-header">
                        <h3 class="section-title mb-0">
                            <i class="fas fa-star me-2"></i>Reviews ({{ $totalReviews }})
                        </h3>
                        @if($totalReviews > 3)
                        <a href="{{ route('frontsite.tours.reviews', $tour->slug) }}" class="btn btn-outline-primary btn-sm">
                            View All Reviews
                        </a>
                        @endif
                    </div>
                    
                    <div class="reviews-list mt-4">
                        @if($tour->tour_reviews->count() > 0)
                            @foreach($tour->tour_reviews->take(3) as $review)
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <div class="reviewer-avatar">
                                            {{ substr($review->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h6 class="reviewer-name">{{ $review->name }}</h6>
                                            <div class="review-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-date">
                                        {{ $review->created_at ? \Carbon\Carbon::parse($review->created_at)->format('M d, Y') : 'Recently' }}
                                    </div>
                                </div>
                                <p class="review-text">{{ $review->description }}</p>
                            </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="fas fa-comment-slash"></i>
                                <p>No reviews yet. Be the first to review this tour!</p>
                            </div>
                        @endif
                    </div>

                    <!-- Add Review Form -->
                    <div class="add-review-section mt-5">
                        <h4 class="form-section-title">
                            <i class="fas fa-pen me-2"></i>Write a Review
                        </h4>
                        <form action="{{ route('frontsite.reviews.store') }}" method="POST" id="reviewForm" class="review-form">
                            @csrf
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Your name" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Rating *</label>
                                <div class="rating-input-wrapper">
                                    <input type="hidden" name="rating" id="rating" required>
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star" data-rating="{{ $i }}"></i>
                                        @endfor
                                    </div>
                                    <span class="rating-helper-text">Click to rate</span>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label class="form-label">Your Review *</label>
                                <textarea name="review" class="form-control" rows="4" placeholder="Share your experience with this tour..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Submit Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <!-- Booking Form Card -->
                    <div class="sidebar-card booking-card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fas fa-calendar-check me-2"></i>Book This Tour
                            </h4>
                        </div>
                        
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            <form action="{{ route('frontsite.booking.store') }}" method="POST" id="bookingForm">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-1"></i>Full Name *
                                    </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-1"></i>Email *
                                    </label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="john@example.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-phone me-1"></i>Phone *
                                    </label>
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+62 123 456 789" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-flag me-1"></i>Nationality *
                                    </label>
                                    <input list="nationalityList" name="nationality" id="nationalityInput" class="form-control @error('nationality') is-invalid @enderror" placeholder="Type to search or select your nationality..." value="{{ old('nationality') }}" required>
                                    <datalist id="nationalityList">
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cabo Verde">Cabo Verde</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Eswatini">Eswatini</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Ivory Coast">Ivory Coast</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="North Korea">North Korea</option>
                                        <option value="North Macedonia">North Macedonia</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="South Sudan">South Sudan</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City">Vatican City</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                        <option value="Other">Other</option>
                                    </datalist>
                                    @error('nationality')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-users me-1"></i>Number of Travelers *
                                    </label>
                                    <input type="number" name="travelers" class="form-control @error('travelers') is-invalid @enderror" min="1" value="{{ old('travelers', 1) }}" required>
                                    @error('travelers')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-alt me-1"></i>Preferred Date *
                                    </label>
                                    <input type="date" name="preferred_date" class="form-control @error('preferred_date') is-invalid @enderror" value="{{ old('preferred_date') }}" min="{{ date('Y-m-d') }}" required>
                                    @error('preferred_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-comment-alt me-1"></i>Special Requests
                                    </label>
                                    <textarea name="special_requests" class="form-control @error('special_requests') is-invalid @enderror" rows="3" placeholder="Any special requirements or requests...">{{ old('special_requests') }}</textarea>
                                    @error('special_requests')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-check-circle me-2"></i>Book Now
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Tour Highlights Card -->
                    @if($tour->tour_destinations->count() > 0)
                    <div class="sidebar-card highlights-card mb-4">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fas fa-star me-2"></i>Tour Highlights
                            </h4>
                        </div>
                        <div class="card-body">
                            <ul class="highlights-list">
                                @foreach($tour->tour_destinations as $destination)
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $destination->destination->name ?? $destination->name }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <!-- Contact Info Card -->
                    <div class="sidebar-card contact-card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <i class="fas fa-headset me-2"></i>Need Help?
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-content">
                                    <div class="contact-label">Phone</div>
                                    <div class="contact-value">+62 123 456 789</div>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-content">
                                    <div class="contact-label">Email</div>
                                    <div class="contact-value">info@opsiliburan.com</div>
                                </div>
                            </div>
                            <div class="contact-item mb-0">
                                <div class="contact-icon whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <div class="contact-content">
                                    <div class="contact-label">WhatsApp</div>
                                    <div class="contact-value">Support Available</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Tours Section -->
        @if($relatedTours->count() > 0)
        <div class="related-tours-section mt-5 pt-5">
            <h3 class="section-main-title text-center mb-5">
                <i class="fas fa-compass me-2"></i>You Might Also Like
            </h3>
            <div class="row g-4">
                @foreach($relatedTours as $relatedTour)
                <div class="col-lg-3 col-md-6">
                    <div class="related-tour-card">
                        <a href="{{ route('frontsite.tours.show', $relatedTour->slug) }}" class="tour-image-link">
                            <div class="tour-image-container">
                                <img src="{{ $relatedTour->tour_photos->first() ? asset('storage/' . $relatedTour->tour_photos->first()->image) : asset('frontsite-assets/img/packages/default.jpg') }}" 
                                     alt="{{ $relatedTour->title }}">
                                <div class="image-overlay">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </div>
                        </a>
                        <div class="tour-card-content">
                            <h6 class="tour-card-title">
                                <a href="{{ route('frontsite.tours.show', $relatedTour->slug) }}">
                                    {{ Str::limit($relatedTour->title, 50) }}
                                </a>
                            </h6>
                            <div class="tour-card-price">
                                <span class="price">${{ number_format($relatedTour->price, 0) }}</span>
                                <span class="unit">per person</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Tour Detail Section End -->

@push('after-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
<style>
    /* Main Section */
    .tour-detail-section {
        background: #f8f9fa;
        min-height: 100vh;
    }

    /* Tour Images */
    .tour-images-wrapper {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .tour-image {
        position: relative;
        width: 100%;
        height: 450px;
        overflow: hidden;
    }

    .tour-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .tour-image.single-image {
        border-radius: 20px;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #ffffff;
        background: rgba(0, 0, 0, 0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px;
    }

    .swiper-pagination-bullet {
        background: #ffffff;
        opacity: 0.7;
    }

    .swiper-pagination-bullet-active {
        opacity: 1;
        background: #667eea;
    }

    /* Tour Header */
    .tour-header-section {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .tour-title {
        font-size: 32px;
        font-weight: 700;
        color: #212529;
        line-height: 1.3;
    }

    .tour-meta-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .rating-section {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stars-display i {
        color: #ffc107;
        font-size: 16px;
    }

    .stars-display i.far {
        color: #dee2e6;
    }

    .rating-text {
        font-weight: 600;
        color: #212529;
        font-size: 16px;
    }

    .reviews-count {
        color: #6c757d;
        font-size: 14px;
    }

    .tour-type-badge .badge {
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 600;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Price Card */
    .price-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .price-label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .price-value {
        color: #ffffff;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .price-unit {
        color: rgba(255, 255, 255, 0.8);
        font-size: 13px;
    }

    /* Quick Info Grid */
    .tour-quick-info-grid {
        background: #ffffff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .info-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        height: 100%;
    }

    .info-box:hover {
        background: #ffffff;
        border-color: #667eea;
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .info-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .info-icon i {
        color: #ffffff;
        font-size: 24px;
    }

    .info-label {
        font-size: 13px;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 16px;
        color: #212529;
        font-weight: 600;
    }

    /* Content Sections */
    .content-section {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 3px solid #f0f0f0;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 3px solid #f0f0f0;
        margin-bottom: 20px;
    }

    .content-body {
        color: #495057;
        line-height: 1.8;
        font-size: 15px;
    }

    .description-content p {
        margin-bottom: 15px;
    }

    /* Details Grid */
    .details-grid {
        display: grid;
        gap: 20px;
    }

    .detail-item-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #667eea;
    }

    .detail-title {
        font-size: 18px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 10px;
    }

    .detail-description {
        color: #6c757d;
        margin: 0;
        line-height: 1.6;
    }

    /* Reviews Section */
    .reviews-list {
        display: grid;
        gap: 20px;
    }

    .review-card {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .review-card:hover {
        background: #ffffff;
        border-color: #667eea;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .reviewer-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .reviewer-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 20px;
        text-transform: uppercase;
    }

    .reviewer-name {
        font-size: 16px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 5px;
    }

    .review-stars i {
        color: #ffc107;
        font-size: 14px;
    }

    .review-stars i.far {
        color: #dee2e6;
    }

    .review-date {
        font-size: 13px;
        color: #6c757d;
    }

    .review-text {
        color: #495057;
        line-height: 1.7;
        margin: 0;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 50px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    /* Review Form */
    .add-review-section {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 15px;
    }

    .form-section-title {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 25px;
    }

    .review-form .form-group {
        margin-bottom: 20px;
    }

    .review-form .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .review-form .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 15px;
    }

    .review-form .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .rating-input-wrapper {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        border: 2px solid #e9ecef;
    }

    .stars {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .stars i {
        font-size: 32px;
        color: #dee2e6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .stars i:hover,
    .stars i.fas {
        color: #ffc107;
        transform: scale(1.1);
    }

    .rating-helper-text {
        font-size: 13px;
        color: #6c757d;
        font-style: italic;
    }

    /* Sidebar */
    .sidebar-sticky {
        position: sticky;
        top: 100px;
    }

    .sidebar-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .sidebar-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px 25px;
    }

    .sidebar-card .card-title {
        color: #ffffff;
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .sidebar-card .card-body {
        padding: 25px;
    }

    /* Booking Card Form */
    .booking-card .form-group {
        margin-bottom: 20px;
    }

    .booking-card .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
    }

    .booking-card .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 15px;
    }

    .booking-card .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    /* Highlights List */
    .highlights-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .highlights-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .highlights-list li:last-child {
        border-bottom: none;
    }

    .highlights-list i {
        color: #10b981;
        font-size: 18px;
        margin-top: 2px;
        flex-shrink: 0;
    }

    .highlights-list span {
        color: #495057;
        font-size: 15px;
        line-height: 1.6;
    }

    /* Contact Card */
    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .contact-item:last-child {
        border-bottom: none;
    }

    .contact-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .contact-icon.whatsapp {
        background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
    }

    .contact-icon i {
        color: #ffffff;
        font-size: 20px;
    }

    .contact-label {
        font-size: 12px;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 3px;
    }

    .contact-value {
        font-size: 14px;
        color: #212529;
        font-weight: 600;
    }

    /* Related Tours */
    .related-tours-section {
        border-top: 3px solid #e9ecef;
    }

    .section-main-title {
        font-size: 32px;
        font-weight: 700;
        color: #212529;
    }

    .related-tour-card {
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .related-tour-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .tour-image-link {
        display: block;
        position: relative;
    }

    .tour-image-container {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .tour-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .related-tour-card:hover .tour-image-container img {
        transform: scale(1.1);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(102, 126, 234, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .related-tour-card:hover .image-overlay {
        opacity: 1;
    }

    .image-overlay i {
        color: #ffffff;
        font-size: 40px;
    }

    .tour-card-content {
        padding: 20px;
    }

    .tour-card-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        min-height: 48px;
    }

    .tour-card-title a {
        color: #212529;
        text-decoration: none;
    }

    .tour-card-title a:hover {
        color: #667eea;
    }

    .tour-card-price {
        display: flex;
        align-items: baseline;
        gap: 8px;
    }

    .tour-card-price .price {
        font-size: 24px;
        font-weight: 700;
        color: #667eea;
    }

    .tour-card-price .unit {
        font-size: 13px;
        color: #6c757d;
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-outline-primary {
        border: 2px solid #667eea;
        color: #667eea;
        font-weight: 600;
        border-radius: 10px;
    }

    .btn-outline-primary:hover {
        background: #667eea;
        color: #ffffff;
    }

    /* Alerts */
    .alert {
        border-radius: 10px;
        border: none;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .tour-title {
            font-size: 28px;
        }
        
        .price-value {
            font-size: 30px;
        }
        
        .sidebar-sticky {
            position: relative;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        .tour-image {
            height: 300px;
        }
        
        .tour-header-section {
            padding: 20px;
        }
        
        .tour-title {
            font-size: 24px;
        }
        
        .tour-meta-wrapper {
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
        }
        
        .price-card {
            margin-top: 20px;
        }
        
        .info-box {
            padding: 15px;
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
        }
        
        .info-icon i {
            font-size: 20px;
        }
        
        .content-section,
        .sidebar-card .card-body {
            padding: 20px;
        }
        
        .section-main-title {
            font-size: 24px;
        }
    }

    @media (max-width: 576px) {
        .tour-detail-section {
            padding-top: 30px;
            padding-bottom: 30px;
        }
        
        .stars i {
            font-size: 28px;
        }
    }

    /* Enhanced datalist styling for nationality input */
    .position-relative {
        position: relative;
    }

    #nationalityInput {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    #nationalityInput:focus {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    /* Datalist dropdown styling */
    datalist {
        position: absolute;
        background-color: white;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        #nationalityInput {
            font-size: 16px; /* Prevent zoom on iOS */
        }
    }
</style>
@endpush

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper for tour images
    if (document.querySelector('.tour-detail-slider')) {
        new Swiper('.tour-detail-slider', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    // Rating stars functionality
    document.querySelectorAll('.stars i').forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            document.getElementById('rating').value = rating;
            
            // Update star display
            document.querySelectorAll('.stars i').forEach((s, index) => {
                if (index < rating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                    s.style.color = '#ffc107';
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                    s.style.color = '#dee2e6';
                }
            });
        });
        
        // Hover effect
        star.addEventListener('mouseenter', function() {
            const rating = this.getAttribute('data-rating');
            document.querySelectorAll('.stars i').forEach((s, index) => {
                if (index < rating) {
                    s.style.color = '#ffc107';
                } else {
                    s.style.color = '#dee2e6';
                }
            });
        });
    });

    // Reset hover effect
    document.querySelector('.stars').addEventListener('mouseleave', function() {
        const currentRating = document.getElementById('rating').value;
        document.querySelectorAll('.stars i').forEach((s, index) => {
            if (index < currentRating) {
                s.style.color = '#ffc107';
            } else {
                s.style.color = '#dee2e6';
            }
        });
    });

    // Booking form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalHTML = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        submitBtn.disabled = true;
        
        return true;
    });

    // Review form validation
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        const rating = document.getElementById('rating').value;
        if (!rating) {
            e.preventDefault();
            alert('Please select a rating.');
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
        submitBtn.disabled = true;
        
        return true;
    });

    // Auto-hide alerts after 5 seconds
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
    
    // Enhanced datalist functionality for nationality input
    document.addEventListener('DOMContentLoaded', function() {
        const nationalityInput = document.getElementById('nationalityInput');
        
        if (nationalityInput) {
            // Add search icon
            const wrapper = document.createElement('div');
            wrapper.className = 'position-relative';
            nationalityInput.parentNode.insertBefore(wrapper, nationalityInput);
            wrapper.appendChild(nationalityInput);
            
            const searchIcon = document.createElement('i');
            searchIcon.className = 'fas fa-search position-absolute';
            searchIcon.style.cssText = 'right: 12px; top: 50%; transform: translateY(-50%); color: #6c757d; pointer-events: none;';
            wrapper.appendChild(searchIcon);
            
            // Add autocomplete styling
            nationalityInput.style.paddingRight = '35px';
            
            // Handle form validation
            const form = document.getElementById('bookingForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const value = nationalityInput.value.trim();
                    if (!value) {
                        e.preventDefault();
                        nationalityInput.classList.add('is-invalid');
                        return false;
                    }
                    nationalityInput.classList.remove('is-invalid');
                });
            }
            
            // Remove error styling when user types
            nationalityInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
            
            console.log('Nationality datalist initialized successfully');
        }
    });
</script>
@endpush
@endsection