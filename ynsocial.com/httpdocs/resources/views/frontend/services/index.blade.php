@extends('layouts.frontend')

@section('title', 'Our Services - ' . config('app.name'))
@section('meta_description', 'Explore our comprehensive digital marketing services designed to help your business grow online.')

@section('content')
    <!-- Page Title -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>Our Services</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Services</li>
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

    <!-- Services Area -->
    <section class="services-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">What We Offer</span>
                <h2>Our Digital Marketing Services</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="row">
                @foreach(config('theme.demo.services') as $service)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-services-box wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                            <div class="icon">
                                <i class="{{ $service['icon'] }}"></i>
                                <div class="icon-bg">
                                    <img src="{{ asset('assets/frontend/images/icon-bg.png') }}" alt="icon-bg">
                                </div>
                            </div>
                            <h3>
                                <a href="{{ route('services.show', Str::slug($service['title'])) }}">
                                    {{ $service['title'] }}
                                </a>
                            </h3>
                            <p>{{ $service['description'] }}</p>
                            <ul class="features-list">
                                @foreach($service['features'] as $feature)
                                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                            <a href="{{ route('services.show', Str::slug($service['title'])) }}" class="read-more-btn">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Area -->
    <section class="cta-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="cta-content">
                        <h2>Ready to Get Started?</h2>
                        <p>Take your business to the next level with our digital marketing expertise.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="cta-btn-box">
                        <a href="{{ route('quote.request') }}" class="default-btn">
                            Request a Quote <span></span>
                        </a>
                        <a href="{{ route('contact') }}" class="optional-btn">
                            Contact Us <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Area -->
    <section class="process-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">How It Works</span>
                <h2>Our Working Process</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-process-box wow fadeInUp">
                        <div class="number">1</div>
                        <div class="icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Research & Analysis</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-process-box wow fadeInUp" data-wow-delay="0.2s">
                        <div class="number">2</div>
                        <div class="icon">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <h3>Strategy & Planning</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-process-box wow fadeInUp" data-wow-delay="0.3s">
                        <div class="number">3</div>
                        <div class="icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3>Implementation</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="single-process-box wow fadeInUp" data-wow-delay="0.4s">
                        <div class="number">4</div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Testing & Delivery</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Area -->
    <section class="faq-area pb-100">
        <div class="container">
            <div class="section-title">
                <span class="sub-title">FAQ</span>
                <h2>Frequently Asked Questions</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="faq-accordion">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        What services do you offer?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>We offer a comprehensive range of digital marketing services including SEO, social media marketing, content marketing, PPC advertising, email marketing, and web development.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        How long does it take to see results?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>Results vary depending on the service and your goals. SEO typically takes 3-6 months, while PPC can show immediate results. We'll provide regular updates and reports on your campaign's progress.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Do you offer custom packages?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>Yes, we create custom packages tailored to your specific needs and budget. Contact us to discuss your requirements and get a personalized quote.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="faq-image wow fadeInUp">
                        <img src="{{ asset('assets/frontend/images/faq.png') }}" alt="faq">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .single-services-box {
        padding: 30px;
        border-radius: 5px;
        transition: all 0.3s ease;
        margin-bottom: 30px;
        box-shadow: 0 0 40px 3px rgba(0, 0, 0, 0.05);
    }
    .single-services-box:hover {
        transform: translateY(-10px);
    }
    .single-process-box {
        text-align: center;
        margin-bottom: 30px;
    }
    .single-process-box .number {
        width: 35px;
        height: 35px;
        line-height: 35px;
        background-color: var(--primary-color);
        color: #fff;
        font-size: 16px;
        border-radius: 50%;
        margin: 0 auto 20px;
    }
    .cta-area {
        padding: 100px 0;
        background-color: var(--primary-color);
        color: #fff;
        position: relative;
        z-index: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize WOW.js
        new WOW().init();
    });
</script>
@endpush
