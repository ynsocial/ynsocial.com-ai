<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Theme Configuration
    |--------------------------------------------------------------------------
    */

    'name' => 'Montoya',
    'version' => '1.0.0',

    /*
    |--------------------------------------------------------------------------
    | Page Layouts
    |--------------------------------------------------------------------------
    */
    'layouts' => [
        'home' => [
            'name' => 'Home Layout',
            'sections' => [
                'hero' => [
                    'enabled' => true,
                    'animations' => ['fade', 'slide', 'zoom'],
                    'overlay_options' => ['none', 'dark', 'light', 'gradient'],
                ],
                'about' => [
                    'enabled' => true,
                    'animations' => ['fade', 'slide-up'],
                ],
                'services' => [
                    'enabled' => true,
                    'animations' => ['fade', 'slide-up'],
                    'columns' => [2, 3, 4],
                ],
                'portfolio' => [
                    'enabled' => true,
                    'animations' => ['fade', 'slide-up'],
                    'items_per_row' => [2, 3, 4],
                ],
                'testimonials' => [
                    'enabled' => true,
                    'animations' => ['fade', 'slide'],
                    'style' => ['grid', 'slider'],
                ],
                'cta' => [
                    'enabled' => true,
                    'animations' => ['fade', 'zoom'],
                    'style' => ['centered', 'split', 'fullwidth'],
                ],
            ],
        ],
        'portfolio' => [
            'name' => 'Portfolio Layout',
            'styles' => [
                'grid' => [
                    'name' => 'Grid Layout',
                    'columns' => [2, 3, 4],
                    'spacing' => ['small', 'medium', 'large'],
                ],
                'masonry' => [
                    'name' => 'Masonry Layout',
                    'columns' => [2, 3, 4],
                ],
                'metro' => [
                    'name' => 'Metro Layout',
                    'preset' => ['style1', 'style2', 'style3'],
                ],
            ],
            'filters' => [
                'position' => ['top', 'side'],
                'style' => ['buttons', 'dropdown', 'minimal'],
            ],
            'animations' => [
                'item' => ['fade', 'slide-up', 'zoom'],
                'filter' => ['fade', 'slide'],
            ],
        ],
        'blog' => [
            'name' => 'Blog Layout',
            'styles' => [
                'grid' => [
                    'name' => 'Grid Layout',
                    'columns' => [1, 2, 3],
                ],
                'list' => [
                    'name' => 'List Layout',
                    'image_position' => ['left', 'right', 'alternate'],
                ],
                'masonry' => [
                    'name' => 'Masonry Layout',
                    'columns' => [2, 3],
                ],
            ],
            'sidebar' => [
                'position' => ['right', 'left', 'none'],
                'widgets' => [
                    'search' => true,
                    'categories' => true,
                    'recent_posts' => true,
                    'tags' => true,
                    'archives' => true,
                ],
            ],
            'animations' => [
                'post' => ['fade', 'slide-up'],
                'sidebar' => ['fade', 'slide'],
            ],
        ],
        'about' => [
            'name' => 'About Layout',
            'sections' => [
                'hero' => [
                    'enabled' => true,
                    'style' => ['centered', 'split', 'fullwidth'],
                    'animations' => ['fade', 'slide', 'parallax'],
                ],
                'team' => [
                    'enabled' => true,
                    'style' => ['grid', 'carousel'],
                    'columns' => [3, 4],
                ],
                'history' => [
                    'enabled' => true,
                    'style' => ['timeline', 'grid'],
                ],
                'values' => [
                    'enabled' => true,
                    'style' => ['grid', 'carousel'],
                    'columns' => [2, 3, 4],
                ],
            ],
        ],
        'contact' => [
            'name' => 'Contact Layout',
            'styles' => [
                'split' => [
                    'name' => 'Split Layout',
                    'info_position' => ['left', 'right'],
                ],
                'centered' => [
                    'name' => 'Centered Layout',
                ],
                'fullwidth' => [
                    'name' => 'Full Width Layout',
                    'map_position' => ['top', 'bottom'],
                ],
            ],
            'features' => [
                'map' => true,
                'contact_form' => true,
                'social_links' => true,
                'business_hours' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    */
    'components' => [
        'header' => [
            'styles' => [
                'default' => [
                    'name' => 'Default Header',
                    'logo_position' => ['left', 'center'],
                    'menu_position' => ['right', 'center'],
                ],
                'transparent' => [
                    'name' => 'Transparent Header',
                    'overlay' => ['none', 'light', 'dark'],
                ],
                'centered' => [
                    'name' => 'Centered Header',
                    'menu_alignment' => ['spread', 'stacked'],
                ],
            ],
            'features' => [
                'sticky' => true,
                'search' => true,
                'social_icons' => true,
                'cta_button' => true,
            ],
        ],
        'footer' => [
            'styles' => [
                'default' => [
                    'name' => 'Default Footer',
                    'columns' => [2, 3, 4],
                ],
                'minimal' => [
                    'name' => 'Minimal Footer',
                    'alignment' => ['left', 'center', 'right'],
                ],
                'centered' => [
                    'name' => 'Centered Footer',
                    'logo_position' => ['top', 'bottom'],
                ],
            ],
            'features' => [
                'newsletter' => true,
                'social_icons' => true,
                'back_to_top' => true,
                'business_hours' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Animation Settings
    |--------------------------------------------------------------------------
    */
    'animations' => [
        'enabled' => true,
        'scroll_reveal' => [
            'enabled' => true,
            'duration' => 800,
            'distance' => '50px',
            'interval' => 150,
        ],
        'hover_effects' => [
            'enabled' => true,
            'duration' => 300,
        ],
        'page_transitions' => [
            'enabled' => true,
            'type' => ['fade', 'slide', 'zoom'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Media Settings
    |--------------------------------------------------------------------------
    */
    'media' => [
        'image_sizes' => [
            'thumbnail' => [150, 150],
            'medium' => [300, 300],
            'large' => [1024, 1024],
            'hero' => [1920, 1080],
        ],
        'formats' => ['jpg', 'jpeg', 'png', 'webp'],
        'optimization' => [
            'enabled' => true,
            'quality' => 85,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Performance Settings
    |--------------------------------------------------------------------------
    */
    'performance' => [
        'lazy_loading' => true,
        'minify_assets' => true,
        'cache_enabled' => true,
        'cache_duration' => 3600,
    ],
]; 