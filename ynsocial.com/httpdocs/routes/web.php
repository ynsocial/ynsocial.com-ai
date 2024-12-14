<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\PortfolioController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\FeedController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\LegalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Global Route Patterns
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('year', '[0-9]{4}');
Route::pattern('month', '[0-9]{2}');

// Public Routes with Basic Caching
Route::middleware(['web', 'cache.headers:public;max_age=3600;etag'])->group(function () {
    // Home Page
    Route::get('/', [HomeController::class, 'index'])
        ->name('home')
        ->middleware('cache.headers:public;max_age=1800;etag'); // 30 minutes cache
    
    // About Pages
    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('team', [AboutController::class, 'team'])->name('team');
        Route::get('testimonials', [AboutController::class, 'testimonials'])->name('testimonials');
    });
});

// Dynamic Content Routes with Smart Caching
Route::middleware(['web'])->group(function () {
    // Portfolio
    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::get('/', [PortfolioController::class, 'index'])
            ->name('index')
            ->middleware('cache.headers:public;max_age=3600;etag');
        
        Route::get('category/{category:slug}', [PortfolioController::class, 'category'])
            ->name('category')
            ->middleware('cache.headers:public;max_age=3600;etag');
        
        Route::get('{portfolio:slug}', [PortfolioController::class, 'show'])
            ->name('show')
            ->middleware(['track.views', 'cache.headers:public;max_age=86400;etag']);
    });
    
    // Services
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])
            ->name('index')
            ->middleware('cache.headers:public;max_age=3600;etag');
        
        Route::get('{service:slug}', [ServiceController::class, 'show'])
            ->name('show')
            ->middleware('cache.headers:public;max_age=86400;etag');
    });
    
    // Blog
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])
            ->name('index')
            ->middleware('cache.headers:public;max_age=1800;etag');
        
        Route::get('category/{category:slug}', [BlogController::class, 'category'])
            ->name('category')
            ->middleware('cache.headers:public;max_age=3600;etag');
        
        Route::get('tag/{tag:slug}', [BlogController::class, 'tag'])
            ->name('tag')
            ->middleware('cache.headers:public;max_age=3600;etag');
        
        Route::get('author/{author:username}', [BlogController::class, 'author'])
            ->name('author')
            ->middleware('cache.headers:public;max_age=3600;etag');
        
        Route::get('{year}/{month}', [BlogController::class, 'archive'])
            ->name('archive')
            ->middleware('cache.headers:public;max_age=86400;etag');
        
        Route::get('{post:slug}', [BlogController::class, 'show'])
            ->name('show')
            ->middleware(['track.views', 'cache.headers:public;max_age=3600;etag']);
    });
});

// Contact & Forms (No Caching)
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])
        ->name('store')
        ->middleware(['throttle:3,1']); // Limit contact form submissions
});

// Newsletter Subscription
Route::post('newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe')
    ->middleware(['throttle:3,1']);

// Search Functionality
Route::get('search', [SearchController::class, 'index'])
    ->name('search')
    ->middleware('throttle:60,1');

// SEO Routes
Route::prefix('seo')->name('seo.')->middleware('cache.headers:public;max_age=86400;etag')->group(function () {
    // Sitemap
    Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
    Route::get('sitemap-{type}.xml', [SitemapController::class, 'show'])->name('sitemap.show');
    
    // RSS Feeds
    Route::get('feed', [FeedController::class, 'index'])->name('feed');
    Route::get('feed/portfolio', [FeedController::class, 'portfolio'])->name('feed.portfolio');
    Route::get('feed/blog', [FeedController::class, 'blog'])->name('feed.blog');
    
    // Robots.txt
    Route::get('robots.txt', [SitemapController::class, 'robots'])->name('robots');
});

// Legal Pages
Route::prefix('legal')->name('legal.')->middleware('cache.headers:public;max_age=86400;etag')->group(function () {
    Route::get('privacy-policy', [LegalController::class, 'privacy'])->name('privacy');
    Route::get('terms-of-service', [LegalController::class, 'terms'])->name('terms');
    Route::get('cookie-policy', [LegalController::class, 'cookies'])->name('cookies');
});

// Authentication Routes
Auth::routes(['verify' => true, 'register' => false]);

// Error Pages
Route::fallback(function () {
    if (request()->expectsJson()) {
        return response()->json(['message' => 'Page Not Found'], 404);
    }
    
    return response()
        ->view('errors.404', [], 404)
        ->header('Cache-Control', 'public, max-age=3600');
});
