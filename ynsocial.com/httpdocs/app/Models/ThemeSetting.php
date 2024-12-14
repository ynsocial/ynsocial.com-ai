<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = [
        'logo',
        'colors',
        'typography',
        'header',
        'footer',
        'portfolio',
        'blog',
        'homepage',
        'social_media',
        'custom_css',
        'custom_js',
        'layout'
    ];

    protected $casts = [
        'colors' => 'array',
        'typography' => 'array',
        'header' => 'array',
        'footer' => 'array',
        'portfolio' => 'array',
        'blog' => 'array',
        'homepage' => 'array',
        'social_media' => 'array'
    ];

    public static function getDefaults()
    {
        return [
            'colors' => [
                'primary' => '#8c6144',
                'secondary' => '#171717',
                'text' => '#444444',
                'background' => '#ffffff'
            ],
            'typography' => [
                'heading_font' => 'Six Caps',
                'body_font' => 'Poppins',
                'font_sizes' => [
                    'base' => '16px',
                    'h1' => '3.5rem',
                    'h2' => '2.5rem',
                    'h3' => '2rem',
                    'h4' => '1.5rem',
                    'h5' => '1.25rem',
                    'h6' => '1rem'
                ]
            ],
            'header' => [
                'style' => 'default',
                'sticky' => true,
                'transparent' => false,
                'show_search' => true,
                'show_social' => true
            ],
            'footer' => [
                'style' => 'default',
                'columns' => 4,
                'show_newsletter' => true,
                'show_social' => true,
                'show_back_to_top' => true
            ],
            'portfolio' => [
                'layout' => 'grid',
                'items_per_page' => 9,
                'show_filters' => true,
                'show_search' => true
            ],
            'blog' => [
                'layout' => 'standard',
                'sidebar' => true,
                'posts_per_page' => 10,
                'show_author' => true,
                'show_date' => true,
                'show_categories' => true
            ],
            'homepage' => [
                'sections' => [
                    'hero' => true,
                    'about' => true,
                    'services' => true,
                    'portfolio' => true,
                    'testimonials' => true,
                    'blog' => true,
                    'contact' => true
                ]
            ],
            'social_media' => [
                'facebook' => '',
                'twitter' => '',
                'instagram' => '',
                'linkedin' => ''
            ],
            'custom_css' => '',
            'custom_js' => '',
            'layout' => 'default'
        ];
    }

    public function getSettingValue($key, $default = null)
    {
        $parts = explode('.', $key);
        $value = $this->attributes;

        foreach ($parts as $part) {
            if (!isset($value[$part])) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Ensure arrays are properly formatted
            foreach ($model->casts as $key => $type) {
                if ($type === 'array' && !is_array($model->$key)) {
                    $model->$key = [];
                }
            }
        });
    }
} 