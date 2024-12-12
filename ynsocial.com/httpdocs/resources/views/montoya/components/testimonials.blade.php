@php
$content = $component->content ?? [
    'title' => 'Client Testimonials',
    'subtitle' => 'What Our Clients Say About Us',
    'testimonials' => [
        [
            'name' => 'Sarah Johnson',
            'position' => 'Marketing Director',
            'company' => 'Tech Solutions Inc.',
            'image' => '/images/testimonials/client1.jpg',
            'rating' => 5,
            'text' => 'Working with YnSocial has transformed our digital presence. Their strategic approach and dedication to results have exceeded our expectations.',
            'video_url' => null
        ],
        [
            'name' => 'Michael Chen',
            'position' => 'CEO',
            'company' => 'Innovation Labs',
            'image' => '/images/testimonials/client2.jpg',
            'rating' => 5,
            'text' => 'The team at YnSocial brings creativity and data-driven insights together perfectly. Our social media engagement has increased by 300% since working with them.',
            'video_url' => 'https://youtube.com/embed/testimonial1'
        ],
        [
            'name' => 'Emma Davis',
            'position' => 'E-commerce Manager',
            'company' => 'Global Retail',
            'image' => '/images/testimonials/client3.jpg',
            'rating' => 5,
            'text' => 'Their SEO expertise has significantly improved our online visibility. We\'ve seen a substantial increase in qualified leads and conversions.',
            'video_url' => null
        ]
    ]
];

$animations = $component->animations ?? [
    'title' => 'fade-up',
    'testimonials' => 'fade-up',
    'rating' => 'bounce'
];

$styles = $component->styles ?? [
    'background' => '#f8f9fa',
    'text_color' => '#333333',
    'accent_color' => '#007bff',
    'card_background' => '#ffffff'
];
@endphp

<section id="testimonials" class="testimonials-section py-5" style="background-color: {{ $styles['background'] }}; color: {{ $styles['text_color'] }}">
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

        <!-- Testimonials Slider -->
        <div class="testimonials-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($content['testimonials'] as $index => $testimonial)
                    <div class="swiper-slide">
                        <div class="testimonial-card" 
                             data-animation="{{ $animations['testimonials'] }}"
                             data-animation-delay="{{ 200 + ($index * 200) }}"
                             style="background-color: {{ $styles['card_background'] }}">
                            
                            <div class="testimonial-header">
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="{{ $testimonial['image'] }}" 
                                             alt="{{ $testimonial['name'] }}"
                                             class="rounded-circle">
                                    </div>
                                    <div class="client-details">
                                        <h4 class="client-name">{{ $testimonial['name'] }}</h4>
                                        <p class="client-position">
                                            {{ $testimonial['position'] }}<br>
                                            <span class="company">{{ $testimonial['company'] }}</span>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="rating" 
                                     data-animation="{{ $animations['rating'] }}"
                                     data-animation-delay="{{ 400 + ($index * 200) }}">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="star {{ $i <= $testimonial['rating'] ? 'filled' : '' }}"
                                           style="color: {{ $i <= $testimonial['rating'] ? '#ffc107' : '#e0e0e0' }}">★</i>
                                    @endfor
                                </div>
                            </div>

                            <div class="testimonial-content">
                                <p class="testimonial-text">{{ $testimonial['text'] }}</p>
                                
                                @if($testimonial['video_url'])
                                <div class="video-testimonial">
                                    <button class="btn btn-primary btn-sm watch-video" 
                                            data-video-url="{{ $testimonial['video_url'] }}">
                                        <i class="fas fa-play me-2"></i> Watch Video
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <iframe src="" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .testimonials-section {
        position: relative;
        overflow: hidden;
    }
    
    .testimonial-card {
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin: 1rem;
        transition: transform 0.3s ease;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
    }
    
    .testimonial-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }
    
    .client-info {
        display: flex;
        align-items: center;
    }
    
    .client-image {
        width: 60px;
        height: 60px;
        margin-right: 1rem;
        overflow: hidden;
    }
    
    .client-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .client-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .client-position {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 0;
    }
    
    .company {
        font-weight: 600;
    }
    
    .rating {
        display: flex;
        gap: 0.25rem;
    }
    
    .star {
        font-size: 1.2rem;
    }
    
    .testimonial-text {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    
    .video-testimonial {
        text-align: center;
    }
    
    .swiper-container {
        padding: 2rem;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        color: {{ $styles['accent_color'] }};
    }
    
    .swiper-pagination-bullet-active {
        background-color: {{ $styles['accent_color'] }};
    }
    
    @media (max-width: 768px) {
        .testimonial-header {
            flex-direction: column;
        }
        
        .rating {
            margin-top: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    const testimonialsSection = document.querySelector('#testimonials');
    initializeAnimations(testimonialsSection);
    
    // Initialize Swiper
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
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
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        }
    });
    
    // Video Modal
    const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
    const videoButtons = document.querySelectorAll('.watch-video');
    
    videoButtons.forEach(button => {
        button.addEventListener('click', function() {
            const videoUrl = this.dataset.videoUrl;
            const modal = document.getElementById('videoModal');
            const iframe = modal.querySelector('iframe');
            iframe.src = videoUrl;
            videoModal.show();
        });
    });
    
    // Clean up video when modal is closed
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
        const iframe = this.querySelector('iframe');
        iframe.src = '';
    });
});
</script>
@endpush
