@php
$content = $component->content ?? [
    'title' => 'Our Services',
    'subtitle' => 'Comprehensive Digital Marketing Solutions',
    'services' => [
        [
            'icon' => 'social-media',
            'title' => 'Social Media Marketing',
            'description' => 'Strategic social media management to boost your brand presence and engagement.',
            'features' => [
                'Platform Strategy Development',
                'Content Creation & Curation',
                'Community Management',
                'Performance Analytics'
            ]
        ],
        [
            'icon' => 'seo',
            'title' => 'Search Engine Optimization',
            'description' => 'Data-driven SEO strategies to improve your search rankings and visibility.',
            'features' => [
                'Keyword Research & Analysis',
                'On-Page Optimization',
                'Technical SEO',
                'Link Building'
            ]
        ],
        [
            'icon' => 'content',
            'title' => 'Content Marketing',
            'description' => 'Engaging content that tells your story and connects with your audience.',
            'features' => [
                'Content Strategy',
                'Blog Management',
                'Copywriting',
                'Content Distribution'
            ]
        ],
        [
            'icon' => 'analytics',
            'title' => 'Digital Analytics',
            'description' => 'In-depth analysis and reporting to track your digital success.',
            'features' => [
                'Performance Tracking',
                'Conversion Analysis',
                'User Behavior Insights',
                'ROI Reporting'
            ]
        ]
    ]
];

$animations = $component->animations ?? [
    'title' => 'fade-up',
    'cards' => 'fade-up',
    'features' => 'fade-right'
];

$styles = $component->styles ?? [
    'background' => '#f8f9fa',
    'card_background' => '#ffffff',
    'text_color' => '#333333',
    'accent_color' => '#007bff'
];
@endphp

<section id="services" class="services-section py-5" style="background-color: {{ $styles['background'] }}; color: {{ $styles['text_color'] }}">
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

        <!-- Services Grid -->
        <div class="row">
            @foreach($content['services'] as $index => $service)
            <div class="col-lg-6 mb-4">
                <div class="service-card h-100" 
                     data-animation="{{ $animations['cards'] }}"
                     data-animation-delay="{{ 200 + ($index * 200) }}"
                     style="background-color: {{ $styles['card_background'] }}">
                    <div class="service-icon" style="background-color: {{ $styles['accent_color'] }}">
                        @include('montoya.svgs.' . $service['icon'])
                    </div>
                    <h3 class="service-title">{{ $service['title'] }}</h3>
                    <p class="service-description">{{ $service['description'] }}</p>
                    
                    <ul class="service-features">
                        @foreach($service['features'] as $featureIndex => $feature)
                        <li data-animation="{{ $animations['features'] }}"
                            data-animation-delay="{{ 400 + ($featureIndex * 100) }}">
                            <i class="feature-check" style="color: {{ $styles['accent_color'] }}"></i>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    
                    <a href="#contact" class="btn btn-primary service-cta">
                        Contact Us
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
    .services-section {
        position: relative;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .section-subtitle {
        font-size: 1.25rem;
        opacity: 0.8;
    }
    
    .service-card {
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
    }
    
    .service-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .service-icon svg {
        width: 35px;
        height: 35px;
        color: #ffffff;
    }
    
    .service-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .service-description {
        font-size: 1rem;
        opacity: 0.8;
        margin-bottom: 1.5rem;
    }
    
    .service-features {
        list-style: none;
        padding: 0;
        margin: 0 0 1.5rem 0;
    }
    
    .service-features li {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }
    
    .feature-check {
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }
    
    .feature-check::before {
        content: '✓';
    }
    
    .service-cta {
        display: inline-block;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    
    .service-cta:hover {
        transform: scale(1.05);
    }
    
    @media (max-width: 991.98px) {
        .service-card {
            margin-bottom: 2rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    const servicesSection = document.querySelector('#services');
    initializeAnimations(servicesSection);
    
    // Add hover effects
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.service-icon');
            icon.style.transform = 'scale(1.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.service-icon');
            icon.style.transform = 'scale(1)';
        });
    });
});
</script>
@endpush
