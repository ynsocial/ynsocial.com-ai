@extends('montoya.layouts.app')

@section('title', 'Portfolio')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.css">
<style>
    .portfolio-container {
        position: relative;
        width: 100%;
    }

    .portfolio-filters {
        margin-bottom: 2rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .portfolio-filter {
        padding: 0.5rem 1.5rem;
        border: 1px solid var(--color-primary);
        border-radius: 30px;
        color: var(--color-primary);
        background: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .portfolio-filter:hover,
    .portfolio-filter.active {
        background: var(--color-primary);
        color: white;
    }

    /* Grid Layout */
    .portfolio-grid {
        display: grid;
        gap: var(--grid-spacing, 30px);
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    }

    /* Masonry Layout */
    .portfolio-masonry {
        margin: -15px;
    }

    .portfolio-masonry .portfolio-item {
        padding: 15px;
        width: calc(33.333% - 30px);
    }

    /* Metro Layout */
    .portfolio-metro {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(6, 1fr);
        grid-auto-rows: 200px;
    }

    .portfolio-metro .portfolio-item {
        grid-column: span 2;
        grid-row: span 1;
    }

    .portfolio-metro .portfolio-item.wide {
        grid-column: span 4;
    }

    .portfolio-metro .portfolio-item.tall {
        grid-row: span 2;
    }

    /* Portfolio Item */
    .portfolio-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }

    .portfolio-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .portfolio-item:hover img {
        transform: scale(1.1);
    }

    .portfolio-item-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .portfolio-item:hover .portfolio-item-overlay {
        opacity: 1;
    }

    .portfolio-item-title {
        color: white;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .portfolio-item:hover .portfolio-item-title {
        transform: translateY(0);
    }

    .portfolio-item-category {
        color: var(--color-primary);
        font-size: 0.9rem;
        transform: translateY(20px);
        transition: transform 0.3s ease 0.1s;
    }

    .portfolio-item:hover .portfolio-item-category {
        transform: translateY(0);
    }

    @media (max-width: 992px) {
        .portfolio-masonry .portfolio-item {
            width: calc(50% - 30px);
        }
        .portfolio-metro {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 768px) {
        .portfolio-masonry .portfolio-item {
            width: calc(100% - 30px);
        }
        .portfolio-metro {
            grid-template-columns: repeat(2, 1fr);
        }
        .portfolio-metro .portfolio-item,
        .portfolio-metro .portfolio-item.wide {
            grid-column: span 2;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-6">
            <h1 class="display-4 mb-3" data-scroll-reveal>Our Portfolio</h1>
            <p class="lead text-muted" data-scroll-reveal>Discover our creative works and innovative solutions that help businesses grow.</p>
        </div>
    </div>

    @if($theme->portfolio['show_filters'] ?? true)
        <div class="portfolio-filters" data-scroll-reveal>
            <button class="portfolio-filter active" data-filter="*">All</button>
            @foreach($categories as $category)
                <button class="portfolio-filter" data-filter=".{{ Str::slug($category->name) }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    @endif

    <div class="portfolio-container {{ 'portfolio-' . ($theme->portfolio['layout'] ?? 'grid') }}" data-scroll-reveal>
        @foreach($portfolios as $item)
            <div class="portfolio-item {{ $item->size ?? '' }} {{ Str::slug($item->category->name) }}"
                 data-category="{{ $item->category->name }}">
                <img src="{{ asset('storage/' . $item->image) }}" 
                     alt="{{ $item->title }}"
                     loading="lazy">
                <a href="{{ route('portfolio.show', $item->slug) }}" class="portfolio-item-overlay">
                    <h3 class="portfolio-item-title">{{ $item->title }}</h3>
                    <span class="portfolio-item-category">{{ $item->category->name }}</span>
                </a>
            </div>
        @endforeach
    </div>

    @if($portfolios->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $portfolios->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Isotope
    var grid = document.querySelector('.portfolio-container');
    var iso = new Isotope(grid, {
        itemSelector: '.portfolio-item',
        layoutMode: '{{ $theme->portfolio['layout'] === 'masonry' ? 'masonry' : 'fitRows' }}',
        percentPosition: true,
        masonry: {
            columnWidth: '.portfolio-item'
        }
    });

    // Filter items on button click
    document.querySelectorAll('.portfolio-filter').forEach(button => {
        button.addEventListener('click', function() {
            var filterValue = this.getAttribute('data-filter');
            iso.arrange({ filter: filterValue === '*' ? null : filterValue });
            
            // Update active state
            document.querySelectorAll('.portfolio-filter').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Layout-specific initialization
    if ('{{ $theme->portfolio['layout'] }}' === 'metro') {
        // Add size classes for metro layout
        document.querySelectorAll('.portfolio-item').forEach((item, index) => {
            if (index % 7 === 0) item.classList.add('wide');
            if (index % 5 === 0) item.classList.add('tall');
        });
    }

    // Scroll Reveal Animation
    if (typeof ScrollReveal !== 'undefined') {
        ScrollReveal().reveal('.portfolio-item', {
            delay: 200,
            distance: '50px',
            interval: 100
        });
    }
});
</script>
@endpush 