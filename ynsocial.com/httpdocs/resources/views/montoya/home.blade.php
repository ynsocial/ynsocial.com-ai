@extends('montoya.layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Creative Digital Solutions for Your Business</h1>
                <p class="lead mb-4">We help businesses grow through innovative digital strategies and cutting-edge technology solutions.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('portfolio.index') }}" class="btn btn-light btn-lg">View Our Work</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Get in Touch</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/hero-illustration.svg') }}" alt="Hero Illustration" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Our Services</h2>
            <p class="lead text-muted">Comprehensive digital solutions tailored to your needs</p>
        </div>
        
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="{{ $service->icon }} fa-2x"></i>
                        </div>
                        <h3 class="h4 mb-3">{{ $service->title }}</h3>
                        <p class="text-muted mb-4">{{ $service->description }}</p>
                        <a href="{{ route('services') }}#{{ $service->slug }}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Portfolio Showcase -->
<section class="portfolio bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Featured Work</h2>
            <p class="lead text-muted">Some of our best projects that showcase our expertise</p>
        </div>

        <div class="row g-4">
            @foreach($featuredPortfolio as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card portfolio-item border-0 shadow-sm h-100">
                    <img src="{{ $item->getFeaturedImageUrl() }}" class="card-img-top" alt="{{ $item->title }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $item->title }}</h4>
                        <p class="card-text text-muted">{{ $item->excerpt }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('portfolio.show', $item->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                            <small class="text-muted">{{ $item->category->name }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('portfolio.index') }}" class="btn btn-primary btn-lg">View All Projects</a>
        </div>
    </div>
</section>

<!-- Latest Blog Posts -->
<section class="blog py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Latest Insights</h2>
            <p class="lead text-muted">Stay updated with our latest thoughts and industry trends</p>
        </div>

        <div class="row g-4">
            @foreach($latestPosts as $post)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ $post->getFeaturedImageUrl() }}" class="card-img-top" alt="{{ $post->title }}">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <span class="badge bg-primary me-2">{{ $post->category->name }}</span>
                            <small class="text-muted">{{ $post->published_at->format('M d, Y') }}</small>
                        </div>
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text text-muted">{{ $post->excerpt }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <a href="{{ $post->getUrl() }}" class="btn btn-link text-primary p-0">Read More →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">View All Posts</a>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta bg-primary text-white py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-4">Ready to Start Your Project?</h2>
                <p class="lead mb-4">Let's discuss how we can help your business grow through innovative digital solutions.</p>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="newsletter py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h3 class="mb-4">Subscribe to Our Newsletter</h3>
                <p class="text-muted mb-4">Stay updated with our latest news and insights delivered directly to your inbox.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .hero {
        padding: 6rem 0;
        background: linear-gradient(45deg, var(--bs-primary), var(--bs-primary-dark));
    }

    .feature-icon {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .portfolio-item {
        transition: transform 0.3s ease;
    }

    .portfolio-item:hover {
        transform: translateY(-5px);
    }

    .portfolio-item img {
        height: 250px;
        object-fit: cover;
    }

    .cta {
        background: linear-gradient(45deg, var(--bs-primary-dark), var(--bs-primary));
    }
</style>
@endpush 