@extends('layouts.frontend')

@section('title', 'Portfolio - ' . config('app.name'))
@section('meta_description', 'Explore our portfolio of successful digital marketing campaigns, web development projects, and creative designs.')

@section('content')
    <!-- Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Our Portfolio</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Portfolio</li>
                </ul>
            </div>
        </div>

        <div class="shape2"><img src="{{ asset('assets/frontend/images/shape/shape2.png') }}" alt="shape"></div>
        <div class="shape3"><img src="{{ asset('assets/frontend/images/shape/shape3.png') }}" alt="shape"></div>
        <div class="shape4"><img src="{{ asset('assets/frontend/images/shape/shape4.png') }}" alt="shape"></div>
        <div class="shape5"><img src="{{ asset('assets/frontend/images/shape/shape5.png') }}" alt="shape"></div>
        <div class="shape6"><img src="{{ asset('assets/frontend/images/shape/shape6.png') }}" alt="shape"></div>
        <div class="shape7"><img src="{{ asset('assets/frontend/images/shape/shape7.png') }}" alt="shape"></div>
        <div class="shape8"><img src="{{ asset('assets/frontend/images/shape/shape8.png') }}" alt="shape"></div>
    </div>

    <!-- Portfolio Area -->
    <section class="portfolio-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Recent Work</span>
                <h2>Our Latest Projects</h2>
                <p>Explore our portfolio of successful projects and see how we've helped businesses achieve their digital marketing goals.</p>
            </div>

            <div class="portfolio-filter">
                <ul>
                    <li class="filter active" data-filter="all">All</li>
                    <li class="filter" data-filter="website">Website Design</li>
                    <li class="filter" data-filter="branding">Branding</li>
                    <li class="filter" data-filter="social_media">Social Media</li>
                    <li class="filter" data-filter="marketing">Digital Marketing</li>
                    <li class="filter" data-filter="video">Video Production</li>
                </ul>
            </div>

            <div class="row portfolio-container">
                @foreach($portfolios as $portfolio)
                    <div class="col-lg-4 col-md-6 portfolio-item {{ $portfolio->category }} wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                        <div class="portfolio-box">
                            <div class="portfolio-image">
                                <img src="{{ asset('images/placeholder.jpg') }}" 
                                     data-src="{{ asset($portfolio->featured_image) }}"
                                     srcset="{{ asset(str_replace($portfolio->featured_image, 'thumb_'.basename($portfolio->featured_image), $portfolio->featured_image)) }} 300w,
                                             {{ asset($portfolio->featured_image) }} 800w"
                                     sizes="(max-width: 576px) 100vw,
                                            (max-width: 768px) 50vw,
                                            33vw"
                                     alt="{{ $portfolio->title }}" 
                                     class="lazy">
                                <div class="portfolio-hover">
                                    <div class="portfolio-content">
                                        <h3>
                                            <a href="{{ route('portfolio.show', $portfolio->slug) }}">
                                                {{ $portfolio->title }}
                                            </a>
                                        </h3>
                                        <span>{{ ucfirst(str_replace('_', ' ', $portfolio->category)) }}</span>
                                        <a href="{{ asset($portfolio->featured_image) }}" class="portfolio-btn">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-area">
                {{ $portfolios->links('vendor.pagination.montoya') }}
            </div>
        </div>
    </section>

    <!-- Stats Area -->
    <div class="fun-facts-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="single-fun-facts">
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="850">00</span>
                            <span class="sign">+</span>
                        </h3>
                        <p>Completed Projects</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="single-fun-facts">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="500">00</span>
                            <span class="sign">+</span>
                        </h3>
                        <p>Happy Clients</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="single-fun-facts">
                        <div class="icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="25">00</span>
                            <span class="sign">+</span>
                        </h3>
                        <p>Awards Won</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="single-fun-facts">
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>
                            <span class="odometer" data-count="100">00</span>
                            <span class="sign">%</span>
                        </h3>
                        <p>Client Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .portfolio-filter {
        text-align: center;
        margin-bottom: 40px;
    }
    .portfolio-filter ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .portfolio-filter ul li {
        display: inline-block;
        margin: 0 5px;
        padding: 8px 20px;
        cursor: pointer;
        border-radius: 30px;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    .portfolio-filter ul li.active,
    .portfolio-filter ul li:hover {
        background-color: var(--primary-color);
        color: #fff;
    }
    .portfolio-box {
        margin-bottom: 30px;
        position: relative;
        border-radius: 5px;
        overflow: hidden;
    }
    .portfolio-image {
        position: relative;
        overflow: hidden;
    }
    .portfolio-image img {
        width: 100%;
        transition: all 0.3s ease;
    }
    .portfolio-hover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 93, 34, 0.9);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .portfolio-content {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        text-align: center;
        padding: 20px;
    }
    .portfolio-content h3 {
        margin-bottom: 10px;
    }
    .portfolio-content h3 a {
        color: #fff;
        font-size: 22px;
    }
    .portfolio-content span {
        color: #fff;
        font-size: 15px;
    }
    .portfolio-btn {
        width: 45px;
        height: 45px;
        line-height: 45px;
        background-color: #fff;
        color: var(--primary-color);
        border-radius: 50%;
        display: inline-block;
        margin-top: 15px;
        transition: all 0.3s ease;
    }
    .portfolio-box:hover .portfolio-image img {
        transform: scale(1.1);
    }
    .portfolio-box:hover .portfolio-hover {
        opacity: 1;
        visibility: visible;
    }
    .portfolio-btn:hover {
        background-color: var(--dark-color);
        color: #fff;
    }
    .single-fun-facts {
        text-align: center;
        margin-bottom: 30px;
    }
    .single-fun-facts .icon {
        font-size: 45px;
        color: var(--primary-color);
        margin-bottom: 15px;
    }
    .single-fun-facts h3 {
        font-size: 42px;
        margin-bottom: 10px;
    }
    .single-fun-facts p {
        font-size: 16px;
        margin: 0;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/magnific-popup.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize WOW.js
    new WOW().init();

    // Initialize Isotope
    var $grid = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'masonry'
    });

    // Filter items on button click
    $('.portfolio-filter').on('click', 'li', function() {
        var filterValue = $(this).attr('data-filter');
        $('.portfolio-filter li').removeClass('active');
        $(this).addClass('active');
        $grid.isotope({ filter: filterValue === 'all' ? '*' : '.' + filterValue });
    });

    // Initialize Magnific Popup
    $('.portfolio-btn').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    // Initialize Odometer
    $('.odometer').each(function() {
        var $this = $(this);
        var count = $this.data('count');
        
        $this.appear(function() {
            setTimeout(function() {
                $this.html(count);
            }, 500);
        });
    });

    // Initialize lazy loading
    var lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });
});
</script>
@endpush
