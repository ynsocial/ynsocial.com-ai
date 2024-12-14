@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">Our Services</h1>
                    <p class="lead mb-4">Comprehensive digital solutions to help your business grow and succeed online.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Services Grid -->
    @include('montoya.sections.services', [
        'content' => [
            'style' => 'grid',
            'title' => 'What We Offer',
            'subtitle' => 'Digital Solutions',
            'description' => 'We provide a full range of digital services to help your business thrive in the modern digital landscape.',
            'columns' => 3,
            'show_icons' => true,
            'show_description' => true,
            'show_link' => true,
            'services' => [
                [
                    'title' => 'Web Design & Development',
                    'icon' => 'fas fa-laptop-code',
                    'description' => 'Custom website design and development using the latest technologies and best practices.',
                    'link' => '/services/web-development'
                ],
                [
                    'title' => 'Digital Marketing',
                    'icon' => 'fas fa-chart-line',
                    'description' => 'Strategic digital marketing solutions to increase your online presence and drive growth.',
                    'link' => '/services/digital-marketing'
                ],
                [
                    'title' => 'Brand Strategy',
                    'icon' => 'fas fa-lightbulb',
                    'description' => 'Develop a strong brand identity and strategy that resonates with your target audience.',
                    'link' => '/services/brand-strategy'
                ],
                [
                    'title' => 'SEO Optimization',
                    'icon' => 'fas fa-search',
                    'description' => 'Improve your search engine rankings and drive organic traffic to your website.',
                    'link' => '/services/seo'
                ],
                [
                    'title' => 'Social Media Management',
                    'icon' => 'fas fa-share-alt',
                    'description' => 'Engage with your audience and build your brand presence on social media platforms.',
                    'link' => '/services/social-media'
                ],
                [
                    'title' => 'Content Creation',
                    'icon' => 'fas fa-pen-fancy',
                    'description' => 'Create compelling content that tells your story and connects with your audience.',
                    'link' => '/services/content-creation'
                ]
            ]
        ]
    ])

    <!-- Features Section -->
    <section class="features-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h5 class="text-primary text-uppercase mb-3">Why Choose Us</h5>
                    <h2 class="display-5 mb-4">The YN Social Advantage</h2>
                    <p class="lead text-muted">What sets us apart from the competition</p>
                </div>
            </div>

            <div class="row g-4">
                @php
                    $features = [
                        [
                            'icon' => 'fas fa-users',
                            'title' => 'Expert Team',
                            'description' => 'Our team of experts brings years of experience and diverse expertise to every project.'
                        ],
                        [
                            'icon' => 'fas fa-rocket',
                            'title' => 'Fast Delivery',
                            'description' => 'We work efficiently to deliver high-quality results within your timeline.'
                        ],
                        [
                            'icon' => 'fas fa-cog',
                            'title' => 'Custom Solutions',
                            'description' => 'Every solution is tailored to meet your specific business needs and goals.'
                        ],
                        [
                            'icon' => 'fas fa-headset',
                            'title' => '24/7 Support',
                            'description' => 'We provide ongoing support to ensure your continued success.'
                        ]
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-card text-center p-4 bg-white rounded-3 h-100">
                            <div class="feature-icon mb-4">
                                <i class="{{ $feature['icon'] }} fa-2x text-primary"></i>
                            </div>
                            <h4 class="h5 mb-3">{{ $feature['title'] }}</h4>
                            <p class="text-muted mb-0">{{ $feature['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h5 class="text-primary text-uppercase mb-3">Pricing Plans</h5>
                    <h2 class="display-5 mb-4">Choose Your Plan</h2>
                    <p class="lead text-muted">Flexible pricing options to suit your business needs</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                @php
                    $plans = [
                        [
                            'name' => 'Starter',
                            'price' => '999',
                            'description' => 'Perfect for small businesses',
                            'features' => [
                                'Basic Website Design',
                                'SEO Optimization',
                                'Social Media Setup',
                                'Email Support'
                            ],
                            'featured' => false
                        ],
                        [
                            'name' => 'Professional',
                            'price' => '1999',
                            'description' => 'Ideal for growing companies',
                            'features' => [
                                'Advanced Website Design',
                                'Content Management System',
                                'Digital Marketing Strategy',
                                'Priority Support'
                            ],
                            'featured' => true
                        ],
                        [
                            'name' => 'Enterprise',
                            'price' => '3999',
                            'description' => 'For large organizations',
                            'features' => [
                                'Custom Web Development',
                                'Full Digital Marketing Suite',
                                'Dedicated Account Manager',
                                '24/7 Premium Support'
                            ],
                            'featured' => false
                        ]
                    ];
                @endphp

                @foreach($plans as $plan)
                    <div class="col-md-6 col-lg-4">
                        <div class="pricing-card text-center p-4 bg-white rounded-3 {{ $plan['featured'] ? 'featured' : '' }}">
                            <h3 class="h4 mb-3">{{ $plan['name'] }}</h3>
                            <div class="price mb-4">
                                <span class="currency">$</span>
                                <span class="amount">{{ $plan['price'] }}</span>
                                <span class="period">/month</span>
                            </div>
                            <p class="text-muted mb-4">{{ $plan['description'] }}</p>
                            <ul class="features-list list-unstyled mb-4">
                                @foreach($plan['features'] as $feature)
                                    <li class="mb-2">
                                        <i class="fas fa-check text-primary me-2"></i>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('contact') }}" class="btn {{ $plan['featured'] ? 'btn-primary' : 'btn-outline-primary' }} btn-lg w-100">
                                Get Started
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 mb-4">Ready to Get Started?</h2>
                    <p class="lead mb-4">Contact us today for a free consultation about your project.</p>
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Get in Touch</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/services/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .feature-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,.1);
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        background: rgba(var(--bs-primary-rgb), 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pricing-card {
        border: 1px solid rgba(0,0,0,.1);
        transition: all 0.3s ease;
    }

    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    }

    .pricing-card.featured {
        transform: scale(1.05);
        border: 2px solid var(--bs-primary);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    }

    .pricing-card .price {
        color: var(--bs-primary);
    }

    .pricing-card .price .currency {
        font-size: 1.5rem;
        font-weight: 500;
        vertical-align: top;
        line-height: 1;
    }

    .pricing-card .price .amount {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .pricing-card .price .period {
        font-size: 1rem;
        color: var(--bs-gray);
    }

    .features-list li {
        color: var(--bs-gray-700);
    }

    .cta-section {
        background: linear-gradient(45deg, var(--bs-primary), darken(var(--bs-primary), 10%));
    }
</style>
@endpush 