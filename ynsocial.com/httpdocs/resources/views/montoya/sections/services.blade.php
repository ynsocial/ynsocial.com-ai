@php
    $style = $content['style'] ?? 'grid';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $columns = $content['columns'] ?? 3;
    $showIcons = $content['show_icons'] ?? true;
    $showDescription = $content['show_description'] ?? true;
    $showLink = $content['show_link'] ?? true;
    $services = $content['services'] ?? [];
    
    $colClass = match($columns) {
        2 => 'col-md-6',
        3 => 'col-md-4',
        4 => 'col-md-3',
        default => 'col-md-4'
    };
@endphp

<section class="services-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                @if($subtitle)
                    <h5 class="text-primary text-uppercase mb-3">{{ $subtitle }}</h5>
                @endif
                @if($title)
                    <h2 class="display-5 mb-4">{{ $title }}</h2>
                @endif
                @if($description)
                    <p class="lead text-muted">{{ $description }}</p>
                @endif
            </div>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
                <div class="{{ $colClass }}">
                    <div class="service-card h-100 p-4 rounded-3 bg-white shadow-sm hover-shadow transition-all">
                        @if($showIcons && isset($service['icon']))
                            <div class="service-icon mb-4">
                                <i class="{{ $service['icon'] }} fa-2x text-primary"></i>
                            </div>
                        @endif
                        
                        <h4 class="service-title h5 mb-3">{{ $service['title'] ?? '' }}</h4>
                        
                        @if($showDescription && isset($service['description']))
                            <p class="service-description text-muted mb-3">{{ $service['description'] }}</p>
                        @endif
                        
                        @if($showLink && isset($service['link']))
                            <a href="{{ $service['link'] }}" class="btn btn-link text-primary p-0">
                                Learn More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
    .services-section {
        background-color: #f8f9fa;
    }
    
    .service-card {
        border: 1px solid rgba(0,0,0,.1);
        transition: all 0.3s ease;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
    }
    
    .service-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(var(--bs-primary-rgb), 0.1);
        border-radius: 12px;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    
    .transition-all {
        transition: all .3s ease-in-out;
    }
</style>
@endpush 