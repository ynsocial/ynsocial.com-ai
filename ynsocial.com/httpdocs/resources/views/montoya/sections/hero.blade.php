@php
    $style = $content['style'] ?? 'main';
    $backgroundType = $content['background_type'] ?? 'gradient';
    $hasOverlay = $content['background_overlay'] ?? false;
    $fullHeight = $content['full_height'] ?? false;
    $animate = $content['animate'] ?? false;
@endphp

<section class="hero-section {{ $style }} {{ $fullHeight ? 'vh-100' : '' }}" 
         @if($backgroundType === 'gradient')
         style="background: linear-gradient({{ $content['gradient_direction'] ?? '45deg' }}, 
                                         {{ $content['gradient_start'] ?? '#4a90e2' }}, 
                                         {{ $content['gradient_end'] ?? '#7c4dff' }});"
         @endif>
    
    @if($backgroundType === 'image')
    <div class="hero-background">
        <img src="{{ $content['background_image'] }}" alt="Background" class="hero-image">
    </div>
    @endif

    @if($backgroundType === 'video')
    <div class="hero-background">
        <video autoplay muted loop playsinline poster="{{ $content['video_poster'] }}" class="hero-video">
            <source src="{{ $content['video_url'] }}" type="video/mp4">
        </video>
    </div>
    @endif

    @if($hasOverlay)
    <div class="hero-overlay"></div>
    @endif

    <div class="container">
        <div class="row align-items-center {{ $fullHeight ? 'min-vh-100' : 'py-5' }}">
            <div class="col-lg-8 text-center text-lg-start">
                @if($animate)
                <div class="hero-content" data-aos="fade-up" data-aos-delay="100">
                @else
                <div class="hero-content">
                @endif
                    <h1 class="display-4 fw-bold text-white mb-4">
                        {{ $content['title'] }}
                    </h1>
                    
                    @if(!empty($content['subtitle']))
                    <h2 class="h3 text-white-75 mb-4">
                        {{ $content['subtitle'] }}
                    </h2>
                    @endif

                    @if(!empty($content['description']))
                    <p class="lead text-white-75 mb-5">
                        {{ $content['description'] }}
                    </p>
                    @endif

                    <div class="hero-buttons">
                        @if(!empty($content['primary_button']['text']))
                        <a href="{{ $content['primary_button']['url'] }}" 
                           class="btn btn-primary btn-lg me-3 mb-3">
                            {{ $content['primary_button']['text'] }}
                        </a>
                        @endif

                        @if(!empty($content['secondary_button']['text']))
                        <a href="{{ $content['secondary_button']['url'] }}" 
                           class="btn btn-outline-light btn-lg mb-3">
                            {{ $content['secondary_button']['text'] }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($style === 'main')
    <div class="hero-shape">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    @endif
</section>

@push('styles')
<style>
.hero-section {
    position: relative;
    overflow: hidden;
    padding: 6rem 0;
    color: white;
}

.hero-section.main {
    padding: 8rem 0 12rem;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}

.hero-image,
.hero-video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-shape {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 3;
    line-height: 0;
}

.hero-shape svg {
    position: relative;
    display: block;
    width: 100%;
    height: 80px;
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75) !important;
}

/* Animation classes */
[data-aos] {
    opacity: 0;
    transition-property: opacity, transform;
}

[data-aos].aos-animate {
    opacity: 1;
}

[data-aos="fade-up"] {
    transform: translateY(100px);
}

[data-aos="fade-up"].aos-animate {
    transform: translateY(0);
}
</style>
@endpush

@if($animate)
@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        once: true
    });
});
</script>
@endpush
@endif 