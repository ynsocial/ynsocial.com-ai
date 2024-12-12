@extends('frontend.layouts.app')

@section('content')
<!-- Portfolio Detail Header -->
<section class="page-header bg-tertiary">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto text-center">
                <h2 class="mb-3 text-capitalize">{{ $portfolio->title }}</h2>
                <ul class="list-inline breadcrumbs text-capitalize" style="font-weight:500">
                    <li class="list-inline-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="list-inline-item">/ <a href="{{ route('portfolio') }}">Portfolio</a></li>
                    <li class="list-inline-item">/ <a href="#" class="text-primary">{{ $portfolio->title }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="has-shapes">
        <svg class="shape shape-left text-light" viewBox="0 0 192 752" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M-30.883 0C-41.3436 36.4248 -22.7145 75.8085 4.29154 102.398C31.2976 128.987 65.8677 146.199 97.6457 166.87C129.424 187.542 160.139 213.902 172.162 249.847C193.542 313.799 149.886 378.897 129.069 443.036C97.5623 540.079 122.109 653.229 191 728.495" stroke="currentColor" stroke-width="2" />
        </svg>
        <svg class="shape shape-right text-light" viewBox="0 0 731 746" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.1794 745.14C1.80036 707.275 -5.75764 666.015 8.73984 629.537C27.748 581.745 80.4729 554.968 131.538 548.843C182.604 542.703 234.032 552.841 285.323 556.748C336.615 560.64 391.543 557.276 433.828 527.964C492.452 487.323 511.701 408.123 564.607 360.255C608.718 320.353 675.307 307.183 731.29 327.323" stroke="currentColor" stroke-width="2" />
        </svg>
    </div>
</section>

<!-- Portfolio Content -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Featured Image -->
                <div class="mb-5">
                    <img src="{{ asset($portfolio->featured_image) }}" alt="{{ $portfolio->title }}" class="img-fluid rounded-lg w-100">
                </div>

                <!-- YouTube Video -->
                @if($portfolio->youtube_url)
                <div class="mb-5">
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $portfolio->youtube_embed_url }}" 
                                title="{{ $portfolio->title }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen></iframe>
                    </div>
                </div>
                @endif

                <!-- Description -->
                <div class="mb-5">
                    <h3 class="mb-4">Project Overview</h3>
                    <div class="content">
                        {!! nl2br(e($portfolio->description)) !!}
                    </div>
                </div>

                <!-- Gallery Images -->
                @if($portfolio->gallery_images)
                <div class="mb-5">
                    <h3 class="mb-4">Project Gallery</h3>
                    <div class="row g-4">
                        @foreach($portfolio->gallery_images as $image)
                        <div class="col-md-6">
                            <a href="{{ asset($image) }}" class="gallery-popup">
                                <img src="{{ asset($image) }}" alt="Gallery Image" class="img-fluid rounded-lg w-100">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Mockups -->
                @if($portfolio->mockup_images)
                <div class="mb-5">
                    <h3 class="mb-4">Project Mockups</h3>
                    <div class="row g-4">
                        @foreach($portfolio->mockup_images as $mockup)
                        <div class="col-md-6">
                            <a href="{{ asset($mockup) }}" class="gallery-popup">
                                <img src="{{ asset($mockup) }}" alt="Mockup" class="img-fluid rounded-lg w-100">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <!-- Project Details -->
                <div class="card border-0 shadow rounded-lg mb-4">
                    <div class="card-body">
                        <h4 class="mb-4">Project Details</h4>
                        <ul class="list-unstyled mb-0">
                            @if($portfolio->client_name)
                            <li class="mb-3">
                                <strong class="text-dark">Client:</strong>
                                <span class="ms-2">{{ $portfolio->client_name }}</span>
                            </li>
                            @endif

                            @if($portfolio->completion_date)
                            <li class="mb-3">
                                <strong class="text-dark">Completed:</strong>
                                <span class="ms-2">{{ $portfolio->completion_date->format('F Y') }}</span>
                            </li>
                            @endif

                            <li class="mb-3">
                                <strong class="text-dark">Category:</strong>
                                <span class="ms-2">{{ ucfirst(str_replace('_', ' ', $portfolio->category)) }}</span>
                            </li>

                            @if($portfolio->website_url)
                            <li class="mb-3">
                                <strong class="text-dark">Website:</strong>
                                <a href="{{ $portfolio->website_url }}" 
                                   class="ms-2 text-primary" 
                                   target="_blank">Visit Website</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Services Provided -->
                @if($portfolio->services_provided)
                <div class="card border-0 shadow rounded-lg mb-4">
                    <div class="card-body">
                        <h4 class="mb-4">Services Provided</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach($portfolio->services_provided as $service)
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-primary me-2"></i>
                                {{ ucfirst(str_replace('_', ' ', $service)) }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Results Achieved -->
                @if($portfolio->results_achieved)
                <div class="card border-0 shadow rounded-lg mb-4">
                    <div class="card-body">
                        <h4 class="mb-4">Results Achieved</h4>
                        <ul class="list-unstyled mb-0">
                            @foreach($portfolio->results_achieved as $result)
                            <li class="mb-2">
                                <i class="fas fa-chart-line text-primary me-2"></i>
                                {{ $result }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Technologies Used -->
                @if($portfolio->technologies_used)
                <div class="card border-0 shadow rounded-lg">
                    <div class="card-body">
                        <h4 class="mb-4">Technologies Used</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($portfolio->technologies_used as $tech)
                            <span class="badge bg-light text-dark">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-title">Related Projects</h2>
            </div>
        </div>
        <div class="row mt-4">
            @foreach($relatedProjects as $project)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow rounded-lg">
                    <img src="{{ asset($project->featured_image) }}" alt="{{ $project->title }}" class="card-img-top">
                    <div class="card-body">
                        <h4 class="mb-3">{{ $project->title }}</h4>
                        <p class="mb-3">{{ Str::limit($project->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">{{ ucfirst(str_replace('_', ' ', $project->category)) }}</span>
                            <a href="{{ route('portfolio.show', $project->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('styles')
<link href="{{ asset('frontend/libs/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<style>
.gallery-popup {
    display: block;
    overflow: hidden;
    position: relative;
    border-radius: 8px;
}

.gallery-popup img {
    transition: transform 0.3s ease;
}

.gallery-popup:hover img {
    transform: scale(1.05);
}

.content {
    line-height: 1.8;
}

.badge {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 20px;
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('frontend/libs/glightbox/js/glightbox.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize lightbox for gallery images
    const lightbox = GLightbox({
        selector: '.gallery-popup',
        touchNavigation: true,
        loop: true,
        autoplayVideos: true
    });
});
</script>
@endpush
