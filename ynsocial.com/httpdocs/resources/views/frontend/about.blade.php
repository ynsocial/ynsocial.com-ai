@extends('layouts.frontend')

@section('title', 'About Us - ' . config('app.name'))
@section('meta_description', 'Learn about our digital marketing agency and our commitment to helping businesses grow their online presence.')

@section('content')
    <!-- Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>About Us</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
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

    <!-- About Area -->
    <section class="about-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-image">
                        <img src="{{ asset('assets/frontend/images/about/about1.jpg') }}" alt="about" class="wow fadeInLeft">
                        <div class="shape9"><img src="{{ asset('assets/frontend/images/shape/shape9.png') }}" alt="shape"></div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-content wow fadeInRight">
                        <div class="section-title">
                            <span class="sub-title">About Us</span>
                            <h2>We Are Digital Marketing Experts</h2>
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>

                        <div class="about-text">
                            <h4>Who We Are</h4>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        </div>

                        <div class="about-text">
                            <h4>Our Mission</h4>
                            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth.</p>
                        </div>

                        <div class="about-text">
                            <h4>Our Vision</h4>
                            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fun Facts -->
    <section class="funfacts-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-6">
                    <div class="funfacts-box">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="odometer" data-count="500">00</h3>
                        <p>Happy Clients</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="funfacts-box">
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <h3 class="odometer" data-count="850">00</h3>
                        <p>Completed Projects</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="funfacts-box">
                        <div class="icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="odometer" data-count="25">00</h3>
                        <p>Awards Won</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-6">
                    <div class="funfacts-box">
                        <div class="icon">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <h3 class="odometer" data-count="750">00</h3>
                        <p>Cups of Coffee</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Area -->
    <section class="team-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Our Team</span>
                <h2>Meet Our Expert Team</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team-box wow fadeInUp">
                        <div class="image">
                            <img src="{{ asset('assets/frontend/images/team/team1.jpg') }}" alt="team">
                            <div class="social">
                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="content">
                            <h3>John Smith</h3>
                            <span>CEO & Founder</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team-box wow fadeInUp" data-wow-delay="0.2s">
                        <div class="image">
                            <img src="{{ asset('assets/frontend/images/team/team2.jpg') }}" alt="team">
                            <div class="social">
                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="content">
                            <h3>Sarah Taylor</h3>
                            <span>Marketing Lead</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team-box wow fadeInUp" data-wow-delay="0.3s">
                        <div class="image">
                            <img src="{{ asset('assets/frontend/images/team/team3.jpg') }}" alt="team">
                            <div class="social">
                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="content">
                            <h3>James Anderson</h3>
                            <span>Web Developer</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team-box wow fadeInUp" data-wow-delay="0.4s">
                        <div class="image">
                            <img src="{{ asset('assets/frontend/images/team/team4.jpg') }}" alt="team">
                            <div class="social">
                                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="content">
                            <h3>Emma Wilson</h3>
                            <span>Creative Director</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-area ptb-100 bg-f8f8f8">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">Testimonials</span>
                <h2>What Our Clients Say</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="testimonials-slides owl-carousel owl-theme">
                @foreach(config('theme.demo.testimonials') as $testimonial)
                    <div class="single-testimonials-item">
                        <div class="client-info">
                            <img src="{{ asset('assets/frontend/images/clients/' . $testimonial['image']) }}" alt="{{ $testimonial['name'] }}">
                            <h3>{{ $testimonial['name'] }}</h3>
                            <span>{{ $testimonial['position'] }}</span>
                        </div>
                        <p>{{ $testimonial['content'] }}</p>
                        <div class="icon">
                            <i class="fas fa-quote-right"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partner Area -->
    <div class="partner-area pt-100 pb-70">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-2 col-6 col-sm-4">
                    <div class="single-partner wow fadeInUp">
                        <img src="{{ asset('assets/frontend/images/partner1.png') }}" alt="partner">
                    </div>
                </div>
                <div class="col-lg-2 col-6 col-sm-4">
                    <div class="single-partner wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{ asset('assets/frontend/images/partner2.png') }}" alt="partner">
                    </div>
                </div>
                <div class="col-lg-2 col-6 col-sm-4">
                    <div class="single-partner wow fadeInUp" data-wow-delay="0.3s">
                        <img src="{{ asset('assets/frontend/images/partner3.png') }}" alt="partner">
                    </div>
                </div>
                <div class="col-lg-2 col-6 col-sm-4">
                    <div class="single-partner wow fadeInUp" data-wow-delay="0.4s">
                        <img src="{{ asset('assets/frontend/images/partner4.png') }}" alt="partner">
                    </div>
                </div>
                <div class="col-lg-2 col-6 col-sm-4">
                    <div class="single-partner wow fadeInUp" data-wow-delay="0.5s">
                        <img src="{{ asset('assets/frontend/images/partner5.png') }}" alt="partner">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .about-image {
        position: relative;
    }
    .about-image img {
        border-radius: 5px;
    }
    .about-content .about-text {
        margin-top: 25px;
    }
    .about-content .about-text h4 {
        margin-bottom: 15px;
        font-size: 24px;
    }
    .funfacts-box {
        text-align: center;
        margin-bottom: 30px;
    }
    .funfacts-box .icon {
        margin-bottom: 15px;
    }
    .funfacts-box .icon i {
        font-size: 45px;
        color: var(--primary-color);
    }
    .funfacts-box h3 {
        font-size: 36px;
        margin-bottom: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize WOW.js
        new WOW().init();

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

        // Initialize Testimonials Carousel
        $('.testimonials-slides').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            autoplay: true,
            smartSpeed: 500,
            margin: 30,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
    });
</script>
@endpush
