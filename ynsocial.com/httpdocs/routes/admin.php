<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are protected by the admin middleware group and require proper
| authentication and authorization.
|
*/

Route::middleware(['auth:admin', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::post('cache/clear', [DashboardController::class, 'clearCache'])->name('dashboard.clear-cache');

    // Portfolio Management
    Route::prefix('portfolios')->name('portfolios.')->group(function () {
        Route::post('reorder', [PortfolioController::class, 'reorder'])->name('reorder');
        Route::post('generate-slug', [PortfolioController::class, 'generateSlug'])->name('generate-slug');
    });
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('portfolios.categories', PortfolioCategoryController::class);

    // Service Management
    Route::prefix('services')->name('services.')->group(function () {
        Route::post('reorder', [ServiceController::class, 'reorder'])->name('reorder');
        Route::post('generate-slug', [ServiceController::class, 'generateSlug'])->name('generate-slug');
    });
    Route::resource('services', ServiceController::class);

    // Blog Management
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::post('publish/{blog}', [BlogController::class, 'publish'])->name('publish');
        Route::post('unpublish/{blog}', [BlogController::class, 'unpublish'])->name('unpublish');
        Route::post('generate-slug', [BlogController::class, 'generateSlug'])->name('generate-slug');
    });
    Route::resource('blogs', BlogController::class);

    // Team Management
    Route::prefix('team')->name('team.')->group(function () {
        Route::post('reorder', [TeamController::class, 'reorder'])->name('reorder');
        Route::post('toggle-active/{team}', [TeamController::class, 'toggleActive'])->name('toggle-active');
    });
    Route::resource('team', TeamController::class);

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::post('toggle-active/{user}', [UserController::class, 'toggleActive'])->name('toggle-active');
        Route::post('reset-password/{user}', [UserController::class, 'resetPassword'])->name('reset-password');
    });
    Route::resource('users', UserController::class);

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('update', [SettingController::class, 'update'])->name('update');
        Route::post('clear-cache', [SettingController::class, 'clearCache'])->name('clear-cache');
        
        // SEO Settings
        Route::get('seo', [SettingController::class, 'seo'])->name('seo');
        Route::post('seo/update', [SettingController::class, 'updateSeo'])->name('seo.update');
        
        // Social Media Settings
        Route::get('social', [SettingController::class, 'social'])->name('social');
        Route::post('social/update', [SettingController::class, 'updateSocial'])->name('social.update');
        
        // Contact Information
        Route::get('contact', [SettingController::class, 'contact'])->name('contact');
        Route::post('contact/update', [SettingController::class, 'updateContact'])->name('contact.update');
    });
});

// Admin Authentication Routes
Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout')->withoutMiddleware('guest:admin');
    
    // Password Reset
    Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('password.update');
});
