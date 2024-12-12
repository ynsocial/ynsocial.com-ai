@php
    $style = $content['style'] ?? 'with_stats';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $image = $content['image'] ?? '';
    $stats = $content['stats'] ?? [];
    $mission = $content['mission'] ?? '';
    $vision = $content['vision'] ?? '';
    $values = $content['values'] ?? '';
@endphp

<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="about-image position-relative">
                    @if($image)
                        <img src="{{ $image }}" alt="{{ $title }}" class="img-fluid rounded-3 shadow">
                        <div class="experience-badge position-absolute bg-primary text-white p-3 rounded-3">
                            <span class="h4 d-block mb-0">10+</span>
                            <small>Years Experience</small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content ps-lg-4">
                    @if($subtitle)
                        <h5 class="text-primary text-uppercase mb-3">{{ $subtitle }}</h5>
                    @endif
                    @if($title)
                        <h2 class="display-5 mb-4">{{ $title }}</h2>
                    @endif
                    @if($description)
                        <p class="lead text-muted mb-4">{{ $description }}</p>
                    @endif

                    @if($mission || $vision)
                        <div class="row g-4 mb-4">
                            @if($mission)
                                <div class="col-md-6">
                                    <div class="mission-card bg-light p-4 rounded-3 h-100">
                                        <h5 class="mb-3">
                                            <i class="fas fa-bullseye text-primary me-2"></i>
                                            Our Mission
                                        </h5>
                                        <p class="mb-0">{{ $mission }}</p>
                                    </div>
                                </div>
                            @endif
                            @if($vision)
                                <div class="col-md-6">
                                    <div class="vision-card bg-light p-4 rounded-3 h-100">
                                        <h5 class="mb-3">
                                            <i class="fas fa-eye text-primary me-2"></i>
                                            Our Vision
                                        </h5>
                                        <p class="mb-0">{{ $vision }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if($values)
                        <div class="values-section mb-4">
                            <h5 class="mb-3">
                                <i class="fas fa-star text-primary me-2"></i>
                                Core Values
                            </h5>
                            <div class="row g-2">
                                @foreach(explode(',', $values) as $value)
                                    <div class="col-auto">
                                        <span class="badge bg-light text-dark p-2 rounded-pill">
                                            {{ trim($value) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if(count($stats) > 0)
            <div class="row stats-row g-4 py-4">
                @foreach($stats as $stat)
                    <div class="col-6 col-md-3">
                        <div class="stat-card text-center p-4 rounded-3 bg-white shadow-sm hover-shadow transition-all">
                            <h3 class="stat-value text-primary mb-2">{{ $stat['value'] }}</h3>
                            <p class="stat-label text-muted mb-0">{{ $stat['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .about-section {
        background-color: #fff;
    }
    
    .about-image {
        overflow: hidden;
    }
    
    .about-image img {
        transition: transform 0.3s ease;
    }
    
    .about-image:hover img {
        transform: scale(1.05);
    }
    
    .experience-badge {
        bottom: 30px;
        right: -20px;
        z-index: 1;
    }
    
    .stat-card {
        border: 1px solid rgba(0,0,0,.1);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    
    .transition-all {
        transition: all .3s ease-in-out;
    }
    
    .mission-card, .vision-card {
        transition: all 0.3s ease;
    }
    
    .mission-card:hover, .vision-card:hover {
        background-color: #fff !important;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
    }
</style>
@endpush 