@php
    $style = $content['style'] ?? 'grid';
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $itemsPerRow = $content['items_per_row'] ?? 3;
    $maxItems = $content['max_items'] ?? 6;
    $showFilters = $content['show_filters'] ?? true;
    $showCategories = $content['show_categories'] ?? true;
    $selectedCategories = $content['categories'] ?? [];
    $layout = $content['layout'] ?? 'masonry';
    $showPagination = $content['show_pagination'] ?? true;
    $animation = $content['animation'] ?? ['effect' => 'fade', 'duration' => 300];

    // Fetch portfolio items based on selected categories
    $query = \App\Models\Portfolio::with('categories')->published();
    if (!empty($selectedCategories)) {
        $query->whereHas('categories', function($q) use ($selectedCategories) {
            $q->whereIn('id', $selectedCategories);
        });
    }
    $portfolioItems = $query->take($maxItems)->get();

    // Get unique categories from the fetched items
    $categories = $portfolioItems->pluck('categories')->flatten()->unique('id');
@endphp

<section class="portfolio-section py-5">
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

        @if($showFilters && $categories->count() > 0)
            <div class="portfolio-filters text-center mb-5">
                <div class="btn-group filter-buttons" role="group">
                    <button type="button" class="btn btn-outline-primary active" data-filter="*">All</button>
                    @foreach($categories as $category)
                        <button type="button" class="btn btn-outline-primary" data-filter=".category-{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="portfolio-grid row g-4" data-layout="{{ $layout }}" data-animation-effect="{{ $animation['effect'] }}" data-animation-duration="{{ $animation['duration'] }}">
            @foreach($portfolioItems as $item)
                <div class="col-md-{{ 12/$itemsPerRow }} portfolio-item {{ $item->categories->map(function($cat) { return 'category-'.$cat->id; })->implode(' ') }}">
                    <div class="portfolio-card position-relative rounded-3 overflow-hidden">
                        <div class="portfolio-image">
                            @if($item->featured_image)
                                <img src="{{ $item->featured_image }}" alt="{{ $item->title }}" class="img-fluid w-100">
                            @endif
                        </div>
                        <div class="portfolio-overlay">
                            <div class="overlay-content text-center">
                                <h4 class="portfolio-title text-white mb-2">{{ $item->title }}</h4>
                                @if($showCategories)
                                    <div class="portfolio-categories mb-3">
                                        @foreach($item->categories as $category)
                                            <span class="badge bg-primary">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="portfolio-actions">
                                    @if($item->external_url)
                                        <a href="{{ $item->external_url }}" class="btn btn-light btn-sm me-2" target="_blank">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('portfolio.show', $item->slug) }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($showPagination && $portfolioItems->count() >= $maxItems)
            <div class="text-center mt-5">
                <a href="{{ route('portfolio.index') }}" class="btn btn-primary">
                    View All Projects
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .portfolio-section {
        background-color: #f8f9fa;
    }
    
    .portfolio-card {
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        transition: all 0.3s ease;
    }
    
    .portfolio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    }
    
    .portfolio-image {
        position: relative;
        overflow: hidden;
    }
    
    .portfolio-image img {
        transition: transform 0.3s ease;
    }
    
    .portfolio-card:hover .portfolio-image img {
        transform: scale(1.1);
    }
    
    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .portfolio-card:hover .portfolio-overlay {
        opacity: 1;
    }
    
    .portfolio-title {
        font-size: 1.25rem;
    }
    
    .filter-buttons {
        display: inline-flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }
    
    .filter-buttons .btn {
        border-radius: 30px;
        padding: 0.5rem 1.5rem;
    }
    
    .portfolio-categories .badge {
        margin: 0 0.25rem;
    }
    
    /* Animation classes */
    .portfolio-item {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity {{ $animation['duration'] }}ms ease,
                    transform {{ $animation['duration'] }}ms ease;
    }
    
    .portfolio-item.show {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Masonry layout specific styles */
    @if($layout === 'masonry')
        .portfolio-grid {
            column-count: {{ $itemsPerRow }};
            column-gap: 1.5rem;
        }
        
        .portfolio-grid .portfolio-item {
            break-inside: avoid;
            margin-bottom: 1.5rem;
        }
    @endif
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        const $grid = $('.portfolio-grid');
        const $items = $('.portfolio-item');
        const layout = $grid.data('layout');
        const animationEffect = $grid.data('animation-effect');
        const animationDuration = $grid.data('animation-duration');

        // Initialize Isotope if not using masonry layout
        if (layout !== 'masonry') {
            $grid.isotope({
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows'
            });
        }

        // Filter functionality
        $('.filter-buttons .btn').click(function() {
            const filterValue = $(this).attr('data-filter');
            
            $(this).addClass('active').siblings().removeClass('active');
            
            if (layout !== 'masonry') {
                $grid.isotope({ filter: filterValue === '*' ? '' : filterValue });
            } else {
                $items.hide();
                if (filterValue === '*') {
                    $items.show();
                } else {
                    $(filterValue).show();
                }
            }
        });

        // Animation on scroll
        const animateItems = () => {
            $items.each(function() {
                const $item = $(this);
                if ($item.isInViewport() && !$item.hasClass('show')) {
                    setTimeout(() => {
                        $item.addClass('show');
                    }, $items.index($item) * 100);
                }
            });
        };

        // Check if element is in viewport
        $.fn.isInViewport = function() {
            const elementTop = $(this).offset().top;
            const elementBottom = elementTop + $(this).outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();
            return elementBottom > viewportTop && elementTop < viewportBottom;
        };

        // Initial animation
        animateItems();

        // Animate on scroll
        $(window).scroll(animateItems);
    });
</script>
@endpush 