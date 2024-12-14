<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionsSeeder extends Seeder
{
    public function run()
    {
        $sections = [
            // Hero Sections
            [
                'name' => 'Main Hero with CTA',
                'type' => 'hero',
                'content' => [
                    'style' => 'main',
                    'title' => 'Grow Your Business with Digital Excellence',
                    'subtitle' => 'Strategic digital solutions to transform your brand and drive results',
                    'description' => 'We help businesses thrive in the digital world through innovative marketing strategies, creative design, and cutting-edge technology.',
                    'primary_button' => [
                        'text' => 'Get Started',
                        'url' => '/contact',
                    ],
                    'secondary_button' => [
                        'text' => 'Our Work',
                        'url' => '/portfolio',
                    ],
                    'background_type' => 'gradient', // gradient, image, video
                    'background_overlay' => true,
                ],
                'active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Video Hero',
                'type' => 'hero',
                'content' => [
                    'style' => 'video',
                    'title' => 'Creating Digital Success Stories',
                    'subtitle' => 'Award-winning digital marketing agency',
                    'video_url' => 'https://example.com/video.mp4',
                    'video_poster' => '/images/video-poster.jpg',
                ],
                'active' => true,
                'order' => 2,
            ],

            // Service Sections
            [
                'name' => 'Services Grid with Icons',
                'type' => 'services',
                'content' => [
                    'style' => 'grid',
                    'title' => 'Our Services',
                    'subtitle' => 'Comprehensive Digital Solutions',
                    'description' => 'We offer a full range of digital marketing services to help your business grow.',
                    'columns' => 3,
                    'show_icons' => true,
                    'show_description' => true,
                    'show_link' => true,
                ],
                'active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Featured Service with Image',
                'type' => 'services',
                'content' => [
                    'style' => 'featured',
                    'title' => 'Featured Service',
                    'image_position' => 'right', // left, right
                    'show_stats' => true,
                ],
                'active' => true,
                'order' => 4,
            ],

            // About Sections
            [
                'name' => 'About Us with Stats',
                'type' => 'about',
                'content' => [
                    'style' => 'with_stats',
                    'title' => 'Who We Are',
                    'subtitle' => 'Your Digital Success Partner',
                    'description' => 'We are a team of passionate digital experts committed to delivering exceptional results.',
                    'image' => '/images/about/team.jpg',
                    'stats' => [
                        ['label' => 'Projects Completed', 'value' => '500+'],
                        ['label' => 'Happy Clients', 'value' => '200+'],
                        ['label' => 'Team Members', 'value' => '50+'],
                        ['label' => 'Years Experience', 'value' => '10+'],
                    ],
                ],
                'active' => true,
                'order' => 5,
            ],

            // Process Sections
            [
                'name' => 'Work Process Steps',
                'type' => 'process',
                'content' => [
                    'style' => 'steps',
                    'title' => 'How We Work',
                    'subtitle' => 'Our Proven Process',
                    'steps' => [
                        [
                            'title' => 'Discovery',
                            'description' => 'We analyze your business needs and market opportunities.',
                            'icon' => 'fas fa-search',
                        ],
                        [
                            'title' => 'Strategy',
                            'description' => 'We create a customized digital strategy for your success.',
                            'icon' => 'fas fa-chess',
                        ],
                        [
                            'title' => 'Implementation',
                            'description' => 'We execute the plan with precision and expertise.',
                            'icon' => 'fas fa-rocket',
                        ],
                        [
                            'title' => 'Optimization',
                            'description' => 'We continuously monitor and improve performance.',
                            'icon' => 'fas fa-chart-line',
                        ],
                    ],
                ],
                'active' => true,
                'order' => 6,
            ],

            // Portfolio Sections
            [
                'name' => 'Portfolio Grid',
                'type' => 'portfolio',
                'content' => [
                    'style' => 'grid',
                    'title' => 'Our Work',
                    'subtitle' => 'Recent Projects',
                    'description' => 'Explore our latest success stories and client projects.',
                    'items_per_row' => 3,
                    'max_items' => 6,
                    'show_filters' => true,
                    'show_categories' => true,
                ],
                'active' => true,
                'order' => 7,
            ],

            // Testimonial Sections
            [
                'name' => 'Client Testimonials Slider',
                'type' => 'testimonials',
                'content' => [
                    'style' => 'slider',
                    'title' => 'What Our Clients Say',
                    'subtitle' => 'Success Stories',
                    'show_company_logos' => true,
                    'show_ratings' => true,
                    'autoplay' => true,
                    'interval' => 5000,
                ],
                'active' => true,
                'order' => 8,
            ],

            // Team Sections
            [
                'name' => 'Team Members Grid',
                'type' => 'team',
                'content' => [
                    'style' => 'grid',
                    'title' => 'Meet Our Team',
                    'subtitle' => 'The Experts Behind Our Success',
                    'description' => 'Our talented team of digital marketing professionals.',
                    'show_social_links' => true,
                    'show_position' => true,
                    'show_bio' => true,
                ],
                'active' => true,
                'order' => 9,
            ],

            // Blog Sections
            [
                'name' => 'Latest Blog Posts',
                'type' => 'blog',
                'content' => [
                    'style' => 'grid',
                    'title' => 'Latest Insights',
                    'subtitle' => 'Digital Marketing Tips & News',
                    'posts_per_row' => 3,
                    'max_posts' => 3,
                    'show_excerpt' => true,
                    'show_author' => true,
                    'show_date' => true,
                ],
                'active' => true,
                'order' => 10,
            ],

            // CTA Sections
            [
                'name' => 'Call to Action with Background',
                'type' => 'cta',
                'content' => [
                    'style' => 'background',
                    'title' => 'Ready to Grow Your Business?',
                    'subtitle' => 'Let\'s create something amazing together',
                    'description' => 'Get in touch with us to discuss your project and how we can help.',
                    'button_text' => 'Start Your Project',
                    'button_url' => '/contact',
                    'background_type' => 'gradient', // image, gradient, color
                    'show_stats' => false,
                ],
                'active' => true,
                'order' => 11,
            ],

            // Contact Sections
            [
                'name' => 'Contact Form with Map',
                'type' => 'contact',
                'content' => [
                    'style' => 'with_map',
                    'title' => 'Get in Touch',
                    'subtitle' => 'We\'d Love to Hear from You',
                    'description' => 'Reach out to us for a free consultation about your project.',
                    'show_map' => true,
                    'show_social_links' => true,
                    'show_office_hours' => true,
                    'form_fields' => [
                        'name' => ['type' => 'text', 'required' => true],
                        'email' => ['type' => 'email', 'required' => true],
                        'phone' => ['type' => 'tel', 'required' => false],
                        'service' => ['type' => 'select', 'required' => true],
                        'message' => ['type' => 'textarea', 'required' => true],
                    ],
                ],
                'active' => true,
                'order' => 12,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::create($section);
        }
    }
} 