@extends('montoya.layouts.app')

@section('title', $portfolio->title)

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<style>
    .portfolio-header {
        position: relative;
        height: 60vh;
        min-height: 400px;
        overflow: hidden;
    }

    .portfolio-header-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .portfolio-header-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
        display: flex;
        align-items: flex-end;
        padding: 3rem 0;
    }

    .portfolio-header-content {
        color: white;
        position: relative;
        z-index: 1;
    }

    .portfolio-meta {
        display: flex;
        gap: 2rem;
        margin-top: 1rem;
    }

    .portfolio-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .portfolio-meta-item i {
        color: var(--color-primary);
    }

    .portfolio-content {
        padding: 4rem 0;
    }

    .portfolio-gallery {
        margin: 3rem 0;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .gallery-item {
        position: relative;
        aspect-ratio: 1;
        overflow: hidden;
        border-radius: 8px;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .project-details {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 8px;
    }

    .project-details-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .project-details-item {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .project-details-item:last-child {
        border-bottom: none;
    }

    .project-details-label {
        color: var(--color-secondary);
        font-weight: 600;
    }

    .related-projects {
        padding: 4rem 0;
        background: #f8f9fa;
    }

    .related-project-card {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        aspect-ratio: 4/3;
    }

    .related-project-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .related-project-card:hover img {
        transform: scale(1.1);
    }

    .related-project-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .related-project-card:hover .related-project-overlay {
        opacity: 1;
    }

    .related-project-title {
        color: white;
        text-align: center;
        padding: 1rem;
    }

    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .portfolio-header {
            height: 50vh;
        }
        .portfolio-meta {
            flex-direction: column;
            gap: 1rem;
        }
        .gallery-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Portfolio Header -->
<header class="portfolio-header">
    <img src="{{ asset('storage/' . $portfolio->image) }}" 
         alt="{{ $portfolio->title }}" 
         class="portfolio-header-image">
    <div class="portfolio-header-overlay">
        <div class="container">
            <div class="portfolio-header-content">
                <h1 class="display-4" data-scroll-reveal>{{ $portfolio->title }}</h1>
                <div class="portfolio-meta" data-scroll-reveal>
                    <div class="portfolio-meta-item">
                        <i class="fas fa-folder"></i>
                        <span>{{ $portfolio->category->name }}</span>
                    </div>
                    <div class="portfolio-meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $portfolio->created_at->format('M Y') }}</span>
                    </div>
                    @if($portfolio->client)
                        <div class="portfolio-meta-item">
                            <i class="fas fa-user"></i>
                            <span>{{ $portfolio->client }}</span>
                        </div>
                    @endif
                    @if($portfolio->website)
                        <div class="portfolio-meta-item">
                            <i class="fas fa-link"></i>
                            <a href="{{ $portfolio->website }}" target="_blank" class="text-white">
                                Visit Website
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Portfolio Content -->
<section class="portfolio-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" data-scroll-reveal>
                <div class="content-wrapper">
                    {!! $portfolio->description !!}
                </div>

                @if($portfolio->gallery)
                    <div class="portfolio-gallery">
                        <div class="gallery-grid">
                            @foreach(json_decode($portfolio->gallery) as $image)
                                <a href="{{ asset('storage/' . $image) }}" 
                                   class="gallery-item"
                                   data-fancybox="gallery">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         alt="Gallery image"
                                         loading="lazy">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4" data-scroll-reveal>
                <div class="project-details">
                    <h3 class="mb-4">Project Details</h3>
                    <ul class="project-details-list">
                        <li class="project-details-item">
                            <span class="project-details-label">Client</span>
                            <span>{{ $portfolio->client }}</span>
                        </li>
                        <li class="project-details-item">
                            <span class="project-details-label">Category</span>
                            <span>{{ $portfolio->category->name }}</span>
                        </li>
                        <li class="project-details-item">
                            <span class="project-details-label">Date</span>
                            <span>{{ $portfolio->created_at->format('M Y') }}</span>
                        </li>
                        @if($portfolio->technologies)
                            <li class="project-details-item">
                                <span class="project-details-label">Technologies</span>
                                <span>{{ $portfolio->technologies }}</span>
                            </li>
                        @endif
                        @if($portfolio->website)
                            <li class="project-details-item">
                                <span class="project-details-label">Website</span>
                                <a href="{{ $portfolio->website }}" target="_blank">
                                    Visit Site
                                </a>
                            </li>
                        @endif
                    </ul>

                    @if($portfolio->social_media)
                        <div class="social-share mt-4">
                            <h4 class="mb-3">Share Project</h4>
                            <div class="d-flex gap-2">
                                @foreach(json_decode($portfolio->social_media) as $platform => $url)
                                    <a href="{{ $url }}" 
                                       target="_blank" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-{{ $platform }}"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
    <section class="related-projects">
        <div class="container">
            <h2 class="mb-4" data-scroll-reveal>Related Projects</h2>
            <div class="row">
                @foreach($relatedProjects as $project)
                    <div class="col-lg-4 col-md-6 mb-4" data-scroll-reveal>
                        <a href="{{ route('portfolio.show', $project->slug) }}" 
                           class="related-project-card">
                            <img src="{{ asset('storage/' . $project->image) }}" 
                                 alt="{{ $project->title }}"
                                 loading="lazy">
                            <div class="related-project-overlay">
                                <h4 class="related-project-title">{{ $project->title }}</h4>
                                <span class="badge bg-primary">{{ $project->category->name }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Fancybox
    Fancybox.bind('[data-fancybox]', {
        // Custom options
        Toolbar: {
            display: [
                { id: 'prev', position: 'center' },
                { id: 'counter', position: 'center' },
                { id: 'next', position: 'center' },
                'zoom',
                'slideshow',
                'fullscreen',
                'download',
                'close',
            ],
        },
    });

    // Scroll Reveal Animation
    if (typeof ScrollReveal !== 'undefined') {
        ScrollReveal().reveal('[data-scroll-reveal]', {
            delay: 200,
            distance: '50px',
            interval: 100
        });
    }
});
</script>
@endpush 