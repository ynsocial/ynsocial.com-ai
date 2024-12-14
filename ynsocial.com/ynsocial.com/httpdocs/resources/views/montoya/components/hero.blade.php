@php
$content = $component->content ?? [
    'title' => 'Digital Marketing Solutions for Your Business',
    'subtitle' => 'Transform your online presence with our expert digital marketing services',
    'cta_text' => 'Get Started',
    'cta_url' => '#contact',
    'background_image' => '/images/hero-bg.jpg'
];

$animations = $component->animations ?? [
    'title' => 'fade-down',
    'subtitle' => 'fade-up',
    'cta' => 'bounce'
];

$styles = $component->styles ?? [
    'height' => '100vh',
    'background_overlay' => 'rgba(0,0,0,0.5)',
    'text_color' => '#ffffff'
];
@endphp

<section id="hero" 
         class="hero-section position-relative" 
         style="height: {{ $styles['height'] }}; color: {{ $styles['text_color'] }};">
    
    <!-- Background -->
    <div class="hero-background" 
         style="background-image: url('{{ $content['background_image'] }}');">
        <div class="overlay" style="background-color: {{ $styles['background_overlay'] }}"></div>
    </div>
    
    <!-- Content -->
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="hero-title mb-4" 
                    data-animation="{{ $animations['title'] }}"
                    data-animation-delay="200">
                    {{ $content['title'] }}
                </h1>
                
                <p class="hero-subtitle lead mb-5" 
                   data-animation="{{ $animations['subtitle'] }}"
                   data-animation-delay="400">
                    {{ $content['subtitle'] }}
                </p>
                
                <a href="{{ $content['cta_url'] }}" 
                   class="btn btn-primary btn-lg"
                   data-animation="{{ $animations['cta'] }}"
                   data-animation-delay="600">
                    {{ $content['cta_text'] }}
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator" data-animation="fade-up" data-animation-delay="800">
        <span class="mouse">
            <span class="wheel"></span>
        </span>
        <p>Scroll Down</p>
    </div>
</section>

@push('styles')
<style>
    .hero-section {
        position: relative;
        overflow: hidden;
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: 1;
    }
    
    .hero-background .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    
    .hero-section .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 300;
    }
    
    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        z-index: 2;
    }
    
    .mouse {
        width: 26px;
        height: 40px;
        border: 2px solid currentColor;
        border-radius: 13px;
        display: block;
        margin: 0 auto 10px;
        position: relative;
    }
    
    .wheel {
        width: 4px;
        height: 8px;
        background: currentColor;
        border-radius: 2px;
        position: absolute;
        top: 6px;
        left: 50%;
        transform: translateX(-50%);
        animation: scroll 1.5s infinite;
    }
    
    @keyframes scroll {
        0% { transform: translateX(-50%) translateY(0); opacity: 1; }
        100% { transform: translateX(-50%) translateY(15px); opacity: 0; }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    const heroSection = document.querySelector('#hero');
    initializeAnimations(heroSection);
    
    // Parallax effect on scroll
    window.addEventListener('scroll', function() {
        const scroll = window.pageYOffset;
        const background = heroSection.querySelector('.hero-background');
        background.style.transform = `translateY(${scroll * 0.5}px)`;
    });
});
</script>
@endpush
