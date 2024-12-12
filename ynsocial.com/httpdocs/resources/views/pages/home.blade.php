@extends('layouts.frontend')

@section('title', 'YN Social - Digital Marketing Agency')

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero-section">
    <div class="hero-wrap">
        <div class="hero-image" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
            <div class="hero-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1 class="hero-title">{{ $page->title ?? 'Digital Marketing Excellence' }}</h1>
                            <p class="hero-description">{{ $page->subtitle ?? 'Transform Your Digital Presence' }}</p>
                            <a href="#contact" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="services-section">
    <div class="container">
        <div class="section-header">
            <h2>Our Services</h2>
            <p>Comprehensive Digital Marketing Solutions</p>
        </div>
        
        <div class="row">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ $service->description }}</p>
                    <a href="{{ route('services.show', $service->id) }}" class="read-more">Learn More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="portfolio-section">
    <div class="container">
        <div class="section-header">
            <h2>Our Work</h2>
            <p>Featured Projects</p>
        </div>
        
        <div class="portfolio-filters">
            <ul>
                <li class="active" data-filter="*">All</li>
                <li data-filter=".video">Video</li>
                <li data-filter=".photo">Photography</li>
                <li data-filter=".social">Social Media</li>
                <li data-filter=".website">Websites</li>
            </ul>
        </div>
        
        <div class="row portfolio-grid">
            @foreach($portfolios as $portfolio)
            <div class="col-lg-4 col-md-6 portfolio-item {{ $portfolio->type }}">
                <div class="portfolio-wrap">
                    <img src="{{ asset($portfolio->thumbnail) }}" alt="{{ $portfolio->title }}">
                    <div class="portfolio-info">
                        <h4>{{ $portfolio->title }}</h4>
                        <p>{{ $portfolio->client_name }}</p>
                        <a href="{{ route('portfolio.show', $portfolio->id) }}" class="portfolio-link">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2>Client Testimonials</h2>
            <p>What Our Clients Say</p>
        </div>
        
        <div class="testimonials-slider">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-item">
                <div class="testimonial-content">
                    <p>{{ $testimonial->testimonial }}</p>
                    <div class="client-info">
                        <img src="{{ asset($testimonial->client_image) }}" alt="{{ $testimonial->client_name }}">
                        <h5>{{ $testimonial->client_name }}</h5>
                        <span>{{ $testimonial->position }}, {{ $testimonial->company_name }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <div class="section-header">
            <h2>Get in Touch</h2>
            <p>Let's Discuss Your Project</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p>{{ $settings->address ?? '' }}</p>
                    <p>Email: {{ $settings->email ?? '' }}</p>
                    <p>Phone: {{ $settings->phone ?? '' }}</p>
                </div>
            </div>
            
            <div class="col-lg-6">
                <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
<script>
    // Initialize portfolio filters
    $(document).ready(function() {
        var $grid = $('.portfolio-grid').isotope({
            itemSelector: '.portfolio-item',
            layoutMode: 'fitRows'
        });
        
        $('.portfolio-filters li').on('click', function() {
            $('.portfolio-filters li').removeClass('active');
            $(this).addClass('active');
            
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });
        
        // Initialize testimonials slider
        new Swiper('.testimonials-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });
    });
</script>
@endpush
