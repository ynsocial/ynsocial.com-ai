<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PublishThemeAssets extends Command
{
    protected $signature = 'theme:publish';
    protected $description = 'Publish theme assets to the public directory';

    public function handle()
    {
        $this->info('Publishing theme assets...');

        // Create theme directories if they don't exist
        $directories = [
            'css',
            'js',
            'images',
            'fonts'
        ];

        foreach ($directories as $dir) {
            $path = public_path("montoya/{$dir}");
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }

        // Copy theme assets
        $sourcePath = resource_path('themes/montoya');
        $destinationPath = public_path('montoya');

        if (File::exists($sourcePath)) {
            File::copyDirectory($sourcePath, $destinationPath);
            $this->info('Theme assets published successfully!');
        } else {
            $this->error('Theme assets source directory not found!');
            
            // Create basic CSS file
            $cssPath = public_path('montoya/css/style.css');
            if (!File::exists($cssPath)) {
                File::put($cssPath, $this->getDefaultCSS());
                $this->info('Created default CSS file.');
            }

            // Create basic JS file
            $jsPath = public_path('montoya/js/theme.js');
            if (!File::exists($jsPath)) {
                File::put($jsPath, $this->getDefaultJS());
                $this->info('Created default JavaScript file.');
            }
        }
    }

    protected function getDefaultCSS()
    {
        return <<<CSS
/* Base styles */
:root {
    --color-primary: #8c6144;
    --color-secondary: #171717;
    --color-text: #444444;
    --color-background: #ffffff;
}

/* Typography */
body {
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    line-height: 1.6;
    color: var(--color-text);
    background-color: var(--color-background);
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Six Caps', sans-serif;
    line-height: 1.2;
    color: var(--color-secondary);
}

/* Header */
.site-header {
    background: var(--color-background);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.navbar-brand {
    font-size: 1.5rem;
    font-weight: bold;
}

.nav-link {
    color: var(--color-text);
    transition: color 0.3s ease;
}

.nav-link:hover,
.nav-link.active {
    color: var(--color-primary);
}

/* Footer */
.site-footer {
    background: var(--color-secondary);
    color: var(--color-background);
    padding: var(--footer-padding) 0;
}

.footer-widget {
    margin-bottom: 30px;
}

.footer-widget h4 {
    color: var(--color-background);
    margin-bottom: 20px;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links a {
    color: var(--color-background);
    text-decoration: none;
    transition: opacity 0.3s ease;
}

.footer-links a:hover {
    opacity: 0.8;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icon {
    color: var(--color-background);
    font-size: 1.2rem;
    transition: opacity 0.3s ease;
}

.social-icon:hover {
    opacity: 0.8;
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: var(--color-primary);
    color: var(--color-background);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.back-to-top.visible {
    opacity: 1;
}

/* Responsive */
@media (max-width: 768px) {
    .navbar-collapse {
        background: var(--color-background);
        padding: 1rem;
    }
    
    .social-icons {
        margin-top: 1rem;
    }
}
CSS;
    }

    protected function getDefaultJS()
    {
        return <<<JS
// Back to Top functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTop = document.querySelector('.back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 100) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});

// Mobile Navigation
document.addEventListener('DOMContentLoaded', function() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    if (navbarToggler && navbarCollapse) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!navbarCollapse.contains(event.target) && !navbarToggler.contains(event.target)) {
                navbarCollapse.classList.remove('show');
            }
        });
    }
});

// Smooth Scroll for anchor links
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});
JS;
    }
} 