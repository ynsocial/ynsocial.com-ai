@php
$content = $component->content ?? [
    'title' => 'About Our Agency',
    'subtitle' => 'We Create Digital Success Stories',
    'description' => 'With years of experience in digital marketing, we help businesses grow their online presence and achieve measurable results. Our team of experts combines creativity with data-driven strategies to deliver exceptional outcomes.',
    'stats' => [
        ['number' => '250+', 'label' => 'Projects Completed'],
        ['number' => '95%', 'label' => 'Client Satisfaction'],
        ['number' => '15+', 'label' => 'Years Experience'],
        ['number' => '50+', 'label' => 'Team Members']
    ],
    'image' => '/images/about-agency.jpg',
    'features' => [
        ['icon' => 'strategy', 'title' => 'Strategic Planning'],
        ['icon' => 'innovation', 'title' => 'Innovative Solutions'],
        ['icon' => 'results', 'title' => 'Proven Results']
    ]
];

$animations = $component->animations ?? [
    'title' => 'fade-up',
    'image' => 'fade-right',
    'content' => 'fade-left',
    'stats' => 'fade-up',
    'features' => 'fade-up'
];

$styles = $component->styles ?? [
    'background' => '#ffffff',
    'text_color' => '#333333',
    'accent_color' => '#007bff'
];
@endphp

<section id="about" class="about-section py-5" style="background-color: {{ $styles['background'] }}; color: {{ $styles['text_color'] }}">
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

        <!-- Main Content -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6" data-animation="{{ $animations['image'] }}">
                <img src="{{ $content['image'] }}" 
                     alt="About Our Agency" 
                     class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6" data-animation="{{ $animations['content'] }}">
                <div class="about-content ps-lg-4">
                    <p class="lead mb-4">{{ $content['description'] }}</p>
                    
                    <!-- Features -->
                    <div class="features">
                        @foreach($content['features'] as $index => $feature)
                        <div class="feature d-flex align-items-center mb-3"
                             data-animation="{{ $animations['features'] }}"
                             data-animation-delay="{{ 200 + ($index * 200) }}">
                            <div class="feature-icon me-3">
                                @include('montoya.svgs.' . $feature['icon'])
                            </div>
                            <h4 class="feature-title mb-0">{{ $feature['title'] }}</h4>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="row stats-row">
            @foreach($content['stats'] as $index => $stat)
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="stat-item text-center" 
                     data-animation="{{ $animations['stats'] }}"
                     data-animation-delay="{{ 200 + ($index * 200) }}">
                    <h3 class="stat-number" style="color: {{ $styles['accent_color'] }}">
                        {{ $stat['number'] }}
                    </h3>
                    <p class="stat-label mb-0">{{ $stat['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
    .about-section {
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
    
    .about-content {
        position: relative;
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: {{ $styles['accent_color'] }};
        border-radius: 50%;
        color: #ffffff;
    }
    
    .feature-icon svg {
        width: 24px;
        height: 24px;
    }
    
    .feature-title {
        font-size: 1.1rem;
        font-weight: 600;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 1rem;
        opacity: 0.8;
    }
    
    @media (max-width: 991.98px) {
        .about-content {
            margin-top: 2rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    const aboutSection = document.querySelector('#about');
    initializeAnimations(aboutSection);
    
    // Counter animation for stats
    const statNumbers = aboutSection.querySelectorAll('.stat-number');
    const options = {
        threshold: 0.5
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const number = target.textContent.replace(/[^0-9]/g, '');
                animateNumber(target, 0, number);
                observer.unobserve(target);
            }
        });
    }, options);
    
    statNumbers.forEach(stat => observer.observe(stat));
});

function animateNumber(element, start, end) {
    let current = start;
    const increment = end / 50;
    const duration = 1500;
    const stepTime = duration / 50;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= end) {
            element.textContent = end + '+';
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current) + '+';
        }
    }, stepTime);
}
</script>
@endpush
