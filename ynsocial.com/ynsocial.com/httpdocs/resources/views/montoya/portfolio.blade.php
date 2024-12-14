@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">Our Portfolio</h1>
                    <p class="lead mb-4">Discover our latest work and creative solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid -->
    @include('montoya.sections.portfolio', [
        'content' => [
            'style' => 'grid',
            'title' => 'Featured Projects',
            'subtitle' => 'Our Latest Work',
            'description' => 'Explore our diverse portfolio of successful digital projects and creative solutions.',
            'columns' => 3,
            'show_filters' => true,
            'categories' => ['All', 'Web Design', 'Digital Marketing', 'Branding', 'Social Media'],
            'items' => [
                [
                    'title' => 'Modern E-commerce Platform',
                    'category' => 'Web Design',
                    'image' => '/assets/montoya/images/portfolio/1.jpg',
                    'description' => 'A fully responsive e-commerce website with modern design and seamless user experience.',
                    'client' => 'Fashion Retailer',
                    'link' => '/portfolio/modern-ecommerce'
                ],
                [
                    'title' => 'Brand Identity Design',
                    'category' => 'Branding',
                    'image' => '/assets/montoya/images/portfolio/2.jpg',
                    'description' => 'Complete brand identity redesign including logo, color palette, and brand guidelines.',
                    'client' => 'Tech Startup',
                    'link' => '/portfolio/brand-identity'
                ],
                [
                    'title' => 'Social Media Campaign',
                    'category' => 'Social Media',
                    'image' => '/assets/montoya/images/portfolio/3.jpg',
                    'description' => 'Successful social media campaign that increased engagement by 200%.',
                    'client' => 'Lifestyle Brand',
                    'link' => '/portfolio/social-campaign'
                ],
                [
                    'title' => 'SEO Optimization',
                    'category' => 'Digital Marketing',
                    'image' => '/assets/montoya/images/portfolio/4.jpg',
                    'description' => 'Comprehensive SEO strategy that improved search rankings and organic traffic.',
                    'client' => 'Local Business',
                    'link' => '/portfolio/seo-optimization'
                ],
                [
                    'title' => 'Corporate Website',
                    'category' => 'Web Design',
                    'image' => '/assets/montoya/images/portfolio/5.jpg',
                    'description' => 'Professional corporate website with custom features and content management system.',
                    'client' => 'Investment Firm',
                    'link' => '/portfolio/corporate-website'
                ],
                [
                    'title' => 'Digital Marketing Strategy',
                    'category' => 'Digital Marketing',
                    'image' => '/assets/montoya/images/portfolio/6.jpg',
                    'description' => 'Integrated digital marketing strategy that doubled conversion rates.',
                    'client' => 'E-learning Platform',
                    'link' => '/portfolio/marketing-strategy'
                ]
            ]
        ]
    ])

    <!-- Case Studies -->
    <section class="case-studies-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h5 class="text-primary text-uppercase mb-3">Case Studies</h5>
                    <h2 class="display-5 mb-4">Success Stories</h2>
                    <p class="lead text-muted">Detailed insights into our most impactful projects</p>
                </div>
            </div>

            <div class="row g-4">
                @php
                    $caseStudies = [
                        [
                            'title' => 'E-commerce Revenue Growth',
                            'client' => 'Fashion Retailer',
                            'image' => '/assets/montoya/images/case-studies/1.jpg',
                            'results' => [
                                'Revenue Increase' => '150%',
                                'Conversion Rate' => '3.5%',
                                'Mobile Traffic' => '65%'
                            ]
                        ],
                        [
                            'title' => 'Brand Awareness Campaign',
                            'client' => 'Tech Startup',
                            'image' => '/assets/montoya/images/case-studies/2.jpg',
                            'results' => [
                                'Social Engagement' => '+200%',
                                'Brand Mentions' => '+180%',
                                'Website Traffic' => '+250%'
                            ]
                        ],
                        [
                            'title' => 'Local SEO Success',
                            'client' => 'Restaurant Chain',
                            'image' => '/assets/montoya/images/case-studies/3.jpg',
                            'results' => [
                                'Local Rankings' => 'Top 3',
                                'Organic Traffic' => '+120%',
                                'Lead Generation' => '+85%'
                            ]
                        ]
                    ];
                @endphp

                @foreach($caseStudies as $study)
                    <div class="col-md-6 col-lg-4">
                        <div class="case-study-card bg-white rounded-3 h-100">
                            <img src="{{ $study['image'] }}" alt="{{ $study['title'] }}" class="card-img-top">
                            <div class="card-body p-4">
                                <h4 class="h5 mb-3">{{ $study['title'] }}</h4>
                                <p class="text-muted mb-4">{{ $study['client'] }}</p>
                                <div class="results">
                                    @foreach($study['results'] as $metric => $value)
                                        <div class="result-item mb-3">
                                            <small class="text-muted d-block">{{ $metric }}</small>
                                            <span class="h6 mb-0 text-primary">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="#" class="btn btn-outline-primary mt-3">View Case Study</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row g-4">
                @php
                    $stats = [
                        ['label' => 'Projects Completed', 'value' => '500+'],
                        ['label' => 'Happy Clients', 'value' => '200+'],
                        ['label' => 'Awards Won', 'value' => '50+'],
                        ['label' => 'Team Members', 'value' => '25+']
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="col-6 col-md-3">
                        <div class="text-center">
                            <h3 class="display-4 fw-bold mb-2">{{ $stat['value'] }}</h3>
                            <p class="mb-0">{{ $stat['label'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 mb-4">Start Your Project</h2>
                    <p class="lead mb-4">Ready to create something amazing together?</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Get in Touch</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/portfolio/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .case-study-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,.1);
    }

    .case-study-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    }

    .case-study-card img {
        height: 200px;
        object-fit: cover;
    }

    .stats-section {
        background: linear-gradient(45deg, var(--bs-primary), darken(var(--bs-primary), 10%));
    }

    .result-item {
        border-left: 3px solid var(--bs-primary);
        padding-left: 1rem;
    }
</style>
@endpush 