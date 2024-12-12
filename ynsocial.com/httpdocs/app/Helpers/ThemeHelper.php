<?php

namespace App\Helpers;

use App\Models\ThemeSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ThemeHelper
{
    /**
     * Get the Google Fonts URL based on theme settings
     */
    public static function getGoogleFontsUrl($theme)
    {
        $fonts = [];
        
        if (isset($theme->typography['heading_font'])) {
            $fonts[] = str_replace(' ', '+', $theme->typography['heading_font']);
        }
        
        if (isset($theme->typography['body_font'])) {
            $fonts[] = str_replace(' ', '+', $theme->typography['body_font']);
        }
        
        if (empty($fonts)) {
            return null;
        }
        
        return 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $fonts) . '&display=swap';
    }

    /**
     * Generate custom CSS based on theme settings
     */
    public static function generateCustomCSS($theme, $preview = false)
    {
        $css = [];
        
        // Colors
        if (isset($theme->colors)) {
            $css[] = ":root {";
            foreach ($theme->colors as $key => $value) {
                $css[] = "    --color-{$key}: {$value};";
            }
            $css[] = "}";
        }

        // Typography
        if (isset($theme->typography)) {
            $css[] = "body {";
            if (isset($theme->typography['body_font'])) {
                $css[] = "    font-family: '{$theme->typography['body_font']}', sans-serif;";
            }
            if (isset($theme->typography['font_sizes']['base'])) {
                $css[] = "    font-size: {$theme->typography['font_sizes']['base']};";
            }
            $css[] = "}";

            if (isset($theme->typography['heading_font'])) {
                $css[] = "h1, h2, h3, h4, h5, h6 {";
                $css[] = "    font-family: '{$theme->typography['heading_font']}', sans-serif;";
                $css[] = "}";
            }

            // Font sizes
            if (isset($theme->typography['font_sizes'])) {
                foreach (['h1', 'h2', 'h3', 'h4', 'h5', 'h6'] as $heading) {
                    if (isset($theme->typography['font_sizes'][$heading])) {
                        $css[] = "{$heading} {";
                        $css[] = "    font-size: {$theme->typography['font_sizes'][$heading]};";
                        $css[] = "}";
                    }
                }
            }
        }

        // Animations
        if (isset($theme->animations) && $theme->animations['enabled']) {
            // Scroll Reveal
            if ($theme->animations['scroll_reveal']['enabled']) {
                $css[] = "[data-scroll-reveal] {";
                $css[] = "    opacity: 0;";
                $css[] = "    transition: all {$theme->animations['scroll_reveal']['duration']}ms ease;";
                $css[] = "    transform: translateY({$theme->animations['scroll_reveal']['distance']});";
                $css[] = "}";
                $css[] = "[data-scroll-reveal].revealed {";
                $css[] = "    opacity: 1;";
                $css[] = "    transform: translateY(0);";
                $css[] = "}";
            }

            // Hover Effects
            if ($theme->animations['hover_effects']['enabled']) {
                $css[] = ".hover-zoom {";
                $css[] = "    transition: transform {$theme->animations['hover_effects']['duration']}ms ease;";
                $css[] = "}";
                $css[] = ".hover-zoom:hover {";
                $css[] = "    transform: scale(1.05);";
                $css[] = "}";
            }

            // Page Transitions
            if ($theme->animations['page_transitions']['enabled']) {
                $css[] = ".page-transition {";
                $css[] = "    transition: opacity 300ms ease;";
                $css[] = "}";
                $css[] = ".page-transition.entering {";
                $css[] = "    opacity: 0;";
                $css[] = "}";
                $css[] = ".page-transition.entered {";
                $css[] = "    opacity: 1;";
                $css[] = "}";
            }
        }

        // Layout-specific styles
        $currentLayout = $theme->layout ?? 'default';
        $layouts = config('theme.layouts');
        
        if (isset($layouts[$currentLayout])) {
            $layout = $layouts[$currentLayout];
            
            // Add layout-specific styles
            $css[] = ".theme-{$currentLayout} {";
            
            if (isset($layout['styles'])) {
                foreach ($layout['styles'] as $property => $value) {
                    $css[] = "    --{$property}: {$value};";
                }
            }
            
            $css[] = "}";
        }

        // Preview-specific styles
        if ($preview) {
            $css[] = ".preview-frame {";
            $css[] = "    border: none;";
            $css[] = "    width: 100%;";
            $css[] = "    height: 100%;";
            $css[] = "    transition: all 0.3s ease;";
            $css[] = "}";
            
            $css[] = ".preview-frame.desktop {";
            $css[] = "    max-width: 100%;";
            $css[] = "}";
            
            $css[] = ".preview-frame.tablet {";
            $css[] = "    max-width: 768px;";
            $css[] = "}";
            
            $css[] = ".preview-frame.mobile {";
            $css[] = "    max-width: 375px;";
            $css[] = "}";
        }

        // Add custom CSS
        if (!empty($theme->custom_css)) {
            $css[] = $theme->custom_css;
        }

        return implode("\n", $css);
    }

    /**
     * Generate custom JavaScript based on theme settings
     */
    public static function generateCustomJS($theme, $preview = false)
    {
        $js = [];
        
        // Scroll Reveal
        if (isset($theme->animations) && $theme->animations['scroll_reveal']['enabled']) {
            $js[] = "document.addEventListener('DOMContentLoaded', function() {";
            $js[] = "    const observerOptions = {";
            $js[] = "        threshold: 0.1,";
            $js[] = "        rootMargin: '50px'";
            $js[] = "    };";
            $js[] = "    const observer = new IntersectionObserver(function(entries) {";
            $js[] = "        entries.forEach(entry => {";
            $js[] = "            if (entry.isIntersecting) {";
            $js[] = "                entry.target.classList.add('revealed');";
            $js[] = "                observer.unobserve(entry.target);";
            $js[] = "            }";
            $js[] = "        });";
            $js[] = "    }, observerOptions);";
            $js[] = "    document.querySelectorAll('[data-scroll-reveal]').forEach(el => observer.observe(el));";
            $js[] = "});";
        }

        // Page Transitions
        if (isset($theme->animations) && $theme->animations['page_transitions']['enabled']) {
            $js[] = "document.addEventListener('DOMContentLoaded', function() {";
            $js[] = "    document.body.classList.add('page-transition', 'entered');";
            $js[] = "    document.querySelectorAll('a').forEach(link => {";
            $js[] = "        link.addEventListener('click', function(e) {";
            $js[] = "            if (this.hostname === window.location.hostname) {";
            $js[] = "                e.preventDefault();";
            $js[] = "                document.body.classList.remove('entered');";
            $js[] = "                document.body.classList.add('entering');";
            $js[] = "                setTimeout(() => {";
            $js[] = "                    window.location = this.href;";
            $js[] = "                }, 300);";
            $js[] = "            }";
            $js[] = "        });";
            $js[] = "    });";
            $js[] = "});";
        }

        // Preview functionality
        if ($preview) {
            $js[] = "class ThemePreview {";
            $js[] = "    constructor() {";
            $js[] = "        this.frame = document.querySelector('.preview-frame');";
            $js[] = "        this.deviceButtons = document.querySelectorAll('[data-device]');";
            $js[] = "        this.pageButtons = document.querySelectorAll('[data-preview-page]');";
            $js[] = "        this.init();";
            $js[] = "    }";
            $js[] = "    init() {";
            $js[] = "        this.deviceButtons.forEach(btn => {";
            $js[] = "            btn.addEventListener('click', () => this.changeDevice(btn.dataset.device));";
            $js[] = "        });";
            $js[] = "        this.pageButtons.forEach(btn => {";
            $js[] = "            btn.addEventListener('click', () => this.changePage(btn.dataset.previewPage));";
            $js[] = "        });";
            $js[] = "    }";
            $js[] = "    changeDevice(device) {";
            $js[] = "        this.frame.className = 'preview-frame ' + device;";
            $js[] = "        this.deviceButtons.forEach(btn => btn.classList.toggle('active', btn.dataset.device === device));";
            $js[] = "    }";
            $js[] = "    changePage(page) {";
            $js[] = "        this.frame.src = page;";
            $js[] = "        this.pageButtons.forEach(btn => btn.classList.toggle('active', btn.dataset.previewPage === page));";
            $js[] = "    }";
            $js[] = "}";
            $js[] = "new ThemePreview();";
        }

        // Add custom JavaScript
        if (!empty($theme->custom_js)) {
            $js[] = $theme->custom_js;
        }

        return implode("\n", $js);
    }

    /**
     * Get the URL for a theme asset
     */
    public static function asset($path)
    {
        return asset('montoya/' . ltrim($path, '/'));
    }

    /**
     * Get current theme settings
     */
    public static function getThemeSettings()
    {
        return Cache::remember('theme_settings', config('theme.performance.cache_duration', 3600), function () {
            return ThemeSetting::first() ?? ThemeSetting::create(ThemeSetting::getDefaults());
        });
    }

    /**
     * Clear theme cache
     */
    public static function clearCache()
    {
        Cache::forget('theme_settings');
    }

    /**
     * Get available layouts for a specific page type
     */
    public static function getAvailableLayouts($pageType)
    {
        $layouts = config("theme.layouts.{$pageType}");
        return $layouts ? $layouts['styles'] ?? [] : [];
    }

    /**
     * Get layout configuration
     */
    public static function getLayoutConfig($pageType, $layout)
    {
        return config("theme.layouts.{$pageType}.styles.{$layout}") ?? null;
    }

    /**
     * Generate preview URL for a specific page
     */
    public static function getPreviewUrl($pageType, $layout = null)
    {
        $url = route($pageType . '.index');
        if ($layout) {
            $url .= "?preview=1&layout={$layout}";
        }
        return $url;
    }
} 