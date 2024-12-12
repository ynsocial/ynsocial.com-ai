@extends('montoya.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="page-hero bg-dark text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 mb-3">About Us</h1>
                    <p class="lead mb-4">We are a creative digital agency focused on growing brands through innovative solutions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main About Section -->
    @include('montoya.sections.about', [
        'content' => [
            'style' => 'with_stats',
            'title' => 'Who We Are',
            'subtitle' => 'Your Digital Success Partner',
            'description' => 'We are a team of passionate digital experts committed to delivering exceptional results for our clients. With years of experience in digital marketing, web development, and creative design, we help businesses thrive in the digital world.',
            'image' => '/assets/montoya/images/about/team.jpg',
            'stats' => [
                ['label' => 'Projects Completed', 'value' => '500+'],
                ['label' => 'Happy Clients', 'value' => '200+'],
                ['label' => 'Team Members', 'value' => '50+'],
                ['label' => 'Years Experience', 'value' => '10+']
            ],
            'mission' => 'To empower businesses with innovative digital solutions that drive growth and create lasting impact.',
            'vision' => 'To be the leading digital agency known for creativity, innovation, and exceptional client results.',
            'values' => 'Innovation, Excellence, Integrity, Collaboration, Client Success'
        ]
    ])

    <!-- Team Section -->
    @include('montoya.sections.team', [
        'content' => [
            'style' => 'grid',
            'title' => 'Meet Our Team',
            'subtitle' => 'The Experts Behind Our Success',
            'description' => 'Our talented team of digital marketing professionals brings diverse expertise and passion to every project.',
            'show_social_links' => true,
            'show_position' => true,
            'show_bio' => true,
            'members' => [
                [
                    'name' => 'John Doe',
                    'position' => 'CEO & Founder',
                    'photo' => '/assets/montoya/images/team/1.jpg',
                    'bio' => 'Over 15 years of experience in digital marketing and business strategy.',
                    'social' => [
                        'linkedin' => '#',
                        'twitter' => '#'
                    ]
                ],
                [
                    'name' => 'Jane Smith',
                    'position' => 'Creative Director',
                    'photo' => '/assets/montoya/images/team/2.jpg',
                    'bio' => 'Award-winning designer with a passion for creating beautiful user experiences.',
                    'social' => [
                        'linkedin' => '#',
                        'twitter' => '#'
                    ]
                ],
                [
                    'name' => 'Mike Johnson',
                    'position' => 'Technical Lead',
                    'photo' => '/assets/montoya/images/team/3.jpg',
                    'bio' => 'Full-stack developer with expertise in modern web technologies.',
                    'social' => [
                        'linkedin' => '#',
                        'github' => '#'
                    ]
                ],
                [
                    'name' => 'Sarah Wilson',
                    'position' => 'Marketing Manager',
                    'photo' => '/assets/montoya/images/team/4.jpg',
                    'bio' => 'Digital marketing expert specializing in growth strategies.',
                    'social' => [
                        'linkedin' => '#',
                        'twitter' => '#'
                    ]
                ]
            ]
        ]
    ])

    <!-- Process Section -->
    <section class="process-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h5 class="text-primary text-uppercase mb-3">Our Process</h5>
                    <h2 class="display-5 mb-4">How We Work</h2>
                    <p class="lead text-muted">Our proven process ensures consistent results and success for every project.</p>
                </div>
            </div>

            <div class="row g-4">
                @php
                    $steps = [
                        [
                            'icon' => 'fas fa-lightbulb',
                            'title' => 'Discovery',
                            'description' => 'We start by understanding your business, goals, and challenges.'
                        ],
                        [
                            'icon' => 'fas fa-chart-line',
                            'title' => 'Strategy',
                            'description' => 'Develop a customized plan aligned with your objectives.'
                        ],
                        [
                            'icon' => 'fas fa-code',
                            'title' => 'Implementation',
                            'description' => 'Execute the strategy with precision and expertise.'
                        ],
                        [
                            'icon' => 'fas fa-rocket',
                            'title' => 'Growth',
                            'description' => 'Monitor, optimize, and scale for continued success.'
                        ]
                    ];
                @endphp

                @foreach($steps as $index => $step)
                    <div class="col-md-6 col-lg-3">
                        <div class="process-card text-center p-4">
                            <div class="process-icon mb-4">
                                <i class="{{ $step['icon'] }} fa-2x text-primary"></i>
                            </div>
                            <h4 class="h5 mb-3">{{ $step['title'] }}</h4>
                            <p class="text-muted mb-0">{{ $step['description'] }}</p>
                            <div class="step-number">{{ $index + 1 }}</div>
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
                    <h2 class="display-5 mb-4">Ready to Start Your Project?</h2>
                    <p class="lead mb-4">Let's create something amazing together.</p>
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Get in Touch</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/assets/montoya/images/about/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
    }

    .process-card {
        background: white;
        border-radius: 12px;
        position: relative;
        transition: all 0.3s ease;
    }

    .process-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
    }

    .process-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        background: rgba(var(--bs-primary-rgb), 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .step-number {
        position: absolute;
        top: -15px;
        right: -15px;
        width: 40px;
        height: 40px;
        background: var(--bs-primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .cta-section {
        background: linear-gradient(45deg, var(--bs-primary), darken(var(--bs-primary), 10%));
    }
</style>
@endpush 