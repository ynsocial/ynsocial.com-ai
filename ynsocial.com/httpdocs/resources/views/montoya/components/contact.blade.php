@php
$content = $component->content ?? [
    'title' => 'Get in Touch',
    'subtitle' => 'Let\'s Start a Conversation',
    'contact_info' => [
        'address' => '123 Digital Avenue, Silicon Valley, CA 94025',
        'email' => 'contact@ynsocial.com',
        'phone' => '+1 (555) 123-4567',
        'hours' => 'Monday - Friday: 9:00 AM - 6:00 PM'
    ],
    'social_media' => [
        [
            'platform' => 'Facebook',
            'url' => 'https://facebook.com/ynsocial',
            'icon' => 'fab fa-facebook'
        ],
        [
            'platform' => 'Twitter',
            'url' => 'https://twitter.com/ynsocial',
            'icon' => 'fab fa-twitter'
        ],
        [
            'platform' => 'LinkedIn',
            'url' => 'https://linkedin.com/company/ynsocial',
            'icon' => 'fab fa-linkedin'
        ],
        [
            'platform' => 'Instagram',
            'url' => 'https://instagram.com/ynsocial',
            'icon' => 'fab fa-instagram'
        ]
    ],
    'map' => [
        'latitude' => 37.4419,
        'longitude' => -122.1419,
        'zoom' => 15
    ],
    'form' => [
        'success_message' => 'Thank you for your message! We\'ll get back to you soon.',
        'error_message' => 'Oops! Something went wrong. Please try again later.'
    ]
];

$animations = $component->animations ?? [
    'title' => 'fade-up',
    'form' => 'fade-right',
    'info' => 'fade-left',
    'map' => 'fade-up'
];

$styles = $component->styles ?? [
    'background' => '#ffffff',
    'text_color' => '#333333',
    'accent_color' => '#007bff',
    'form_background' => '#f8f9fa'
];
@endphp

<section id="contact" class="contact-section py-5" style="background-color: {{ $styles['background'] }}; color: {{ $styles['text_color'] }}">
    <div class="container">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title" 
                    data-animation="{{ $animations['title'] }}"
                    data-animation-delay="200">
                    {{ $content['title'] }}
                </h2>
                <p class="section-subtitle" 
                   data-animation="{{ $animations['title'] }}"
                   data-animation-delay="400">
                    {{ $content['subtitle'] }}
                </p>
            </div>
        </div>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="contact-form-wrapper p-4" 
                     data-animation="{{ $animations['form'] }}"
                     data-animation-delay="600"
                     style="background-color: {{ $styles['form_background'] }}">
                    <form id="contactForm" class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Your Name"
                                   required>
                            <label for="name">Your Name</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Your Email"
                                   required>
                            <label for="email">Your Email</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="tel" 
                                   class="form-control" 
                                   id="phone" 
                                   name="phone" 
                                   placeholder="Your Phone">
                            <label for="phone">Your Phone (Optional)</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <select class="form-select" 
                                    id="subject" 
                                    name="subject" 
                                    required>
                                <option value="">Select a Subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="services">Services</option>
                                <option value="quote">Request a Quote</option>
                                <option value="support">Support</option>
                            </select>
                            <label for="subject">Subject</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control" 
                                      id="message" 
                                      name="message" 
                                      placeholder="Your Message"
                                      style="height: 150px"
                                      required></textarea>
                            <label for="message">Your Message</label>
                        </div>
                        
                        <button type="submit" 
                                class="btn btn-primary w-100"
                                style="background-color: {{ $styles['accent_color'] }}; border-color: {{ $styles['accent_color'] }}">
                            Send Message
                        </button>
                    </form>
                    
                    <!-- Form Messages -->
                    <div class="alert alert-success mt-3 d-none" id="successMessage">
                        {{ $content['form']['success_message'] }}
                    </div>
                    <div class="alert alert-danger mt-3 d-none" id="errorMessage">
                        {{ $content['form']['error_message'] }}
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-6">
                <div class="contact-info" 
                     data-animation="{{ $animations['info'] }}"
                     data-animation-delay="800">
                    <div class="info-card mb-4">
                        <h4>Contact Information</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $content['contact_info']['address'] }}
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-envelope me-2"></i>
                                <a href="mailto:{{ $content['contact_info']['email'] }}"
                                   style="color: {{ $styles['accent_color'] }}">
                                    {{ $content['contact_info']['email'] }}
                                </a>
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-phone me-2"></i>
                                <a href="tel:{{ $content['contact_info']['phone'] }}"
                                   style="color: {{ $styles['accent_color'] }}">
                                    {{ $content['contact_info']['phone'] }}
                                </a>
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-clock me-2"></i>
                                {{ $content['contact_info']['hours'] }}
                            </li>
                        </ul>
                    </div>
                    
                    <div class="social-links mb-4">
                        <h4>Connect With Us</h4>
                        <div class="social-icons">
                            @foreach($content['social_media'] as $social)
                            <a href="{{ $social['url'] }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="social-icon"
                               style="color: {{ $styles['accent_color'] }}">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="map-wrapper" 
                     data-animation="{{ $animations['map'] }}"
                     data-animation-delay="1000">
                    <div id="map" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .contact-section {
        position: relative;
    }
    
    .contact-form-wrapper {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: {{ $styles['accent_color'] }};
    }
    
    .form-control:focus {
        border-color: {{ $styles['accent_color'] }};
        box-shadow: 0 0 0 0.25rem rgba(0,123,255,0.25);
    }
    
    .info-card {
        padding: 2rem;
        border-radius: 15px;
        background-color: {{ $styles['form_background'] }};
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .social-icons {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }
    
    .social-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: {{ $styles['form_background'] }};
        transition: all 0.3s ease;
    }
    
    .social-icon:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .map-wrapper {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    @media (max-width: 768px) {
        .contact-info {
            margin-top: 2rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&callback=initMap" 
        async defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    const contactSection = document.querySelector('#contact');
    initializeAnimations(contactSection);
    
    // Form handling
    const contactForm = document.getElementById('contactForm');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        try {
            const formData = new FormData(this);
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            
            if (response.ok) {
                successMessage.classList.remove('d-none');
                errorMessage.classList.add('d-none');
                this.reset();
            } else {
                throw new Error(data.message || 'Something went wrong');
            }
        } catch (error) {
            successMessage.classList.add('d-none');
            errorMessage.classList.remove('d-none');
            errorMessage.textContent = error.message;
        }
    });
});

// Initialize Google Map
function initMap() {
    const mapOptions = {
        center: {
            lat: {{ $content['map']['latitude'] }},
            lng: {{ $content['map']['longitude'] }}
        },
        zoom: {{ $content['map']['zoom'] }},
        styles: [
            {
                "featureType": "all",
                "elementType": "geometry",
                "stylers": [{"color": "#f5f5f5"}]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [{"color": "#e9e9e9"}]
            }
        ]
    };
    
    const map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
    // Add marker
    new google.maps.Marker({
        position: mapOptions.center,
        map: map,
        title: 'YnSocial'
    });
}
</script>
@endpush
