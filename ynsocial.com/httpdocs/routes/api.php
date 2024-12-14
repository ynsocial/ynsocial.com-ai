<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\PortfolioController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\NewsletterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API Health Check
Route::get('health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'version' => '1.0',
        'environment' => config('app.env')
    ]);
});

// API Version 1 Routes
Route::prefix('v1')->group(function () {
    // Authentication Routes (Unprotected)
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('password.forgot');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
        
        // Protected Authentication Routes
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            Route::get('me', [AuthController::class, 'me'])->name('me');
            Route::put('profile', [AuthController::class, 'updateProfile'])->name('profile.update');
            Route::put('password', [AuthController::class, 'updatePassword'])->name('password.update');
        });
    });

    // Protected API Routes
    Route::middleware(['auth:sanctum', 'throttle:60,1', 'api.security'])->group(function () {
        // User Management
        Route::apiResource('users', UserController::class)
            ->middleware('role:admin');
        
        Route::prefix('users')->name('users.')->middleware('role:admin')->group(function () {
            Route::post('{user}/activate', [UserController::class, 'activate'])->name('activate');
            Route::post('{user}/deactivate', [UserController::class, 'deactivate'])->name('deactivate');
            Route::post('{user}/roles', [UserController::class, 'updateRoles'])->name('roles.update');
        });

        // Portfolio Management
        Route::apiResource('portfolios', PortfolioController::class);
        Route::prefix('portfolios')->name('portfolios.')->group(function () {
            Route::post('reorder', [PortfolioController::class, 'reorder'])->name('reorder');
            Route::post('generate-slug', [PortfolioController::class, 'generateSlug'])->name('generate-slug');
            Route::get('categories', [PortfolioController::class, 'categories'])->name('categories');
            Route::post('bulk-delete', [PortfolioController::class, 'bulkDelete'])->name('bulk-delete');
            Route::post('{portfolio}/toggle-featured', [PortfolioController::class, 'toggleFeatured'])->name('toggle-featured');
        });

        // Service Management
        Route::apiResource('services', ServiceController::class);
        Route::prefix('services')->name('services.')->group(function () {
            Route::post('reorder', [ServiceController::class, 'reorder'])->name('reorder');
            Route::post('generate-slug', [ServiceController::class, 'generateSlug'])->name('generate-slug');
            Route::post('bulk-delete', [ServiceController::class, 'bulkDelete'])->name('bulk-delete');
            Route::post('{service}/toggle-active', [ServiceController::class, 'toggleActive'])->name('toggle-active');
        });

        // Blog Management
        Route::apiResource('blogs', BlogController::class);
        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::post('generate-slug', [BlogController::class, 'generateSlug'])->name('generate-slug');
            Route::post('{blog}/publish', [BlogController::class, 'publish'])->name('publish');
            Route::post('{blog}/unpublish', [BlogController::class, 'unpublish'])->name('unpublish');
            Route::get('categories', [BlogController::class, 'categories'])->name('categories');
            Route::post('bulk-delete', [BlogController::class, 'bulkDelete'])->name('bulk-delete');
        });

        // Dashboard Statistics
        Route::prefix('dashboard')->name('dashboard.')->middleware('role:admin')->group(function () {
            Route::get('stats', [DashboardController::class, 'stats'])->name('stats');
            Route::get('analytics', [DashboardController::class, 'analytics'])->name('analytics');
            Route::get('recent-activities', [DashboardController::class, 'recentActivities'])->name('activities');
        });

        // Contact Management
        Route::apiResource('contacts', ContactController::class)->except(['update', 'store']);
        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::post('{contact}/mark-read', [ContactController::class, 'markRead'])->name('mark-read');
            Route::post('bulk-delete', [ContactController::class, 'bulkDelete'])->name('bulk-delete');
        });

        // Newsletter Management
        Route::apiResource('newsletters', NewsletterController::class)->except(['update']);
        Route::prefix('newsletters')->name('newsletters.')->group(function () {
            Route::post('subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe')
                ->withoutMiddleware(['auth:sanctum', 'throttle:60,1']);
            Route::post('unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('unsubscribe')
                ->withoutMiddleware(['auth:sanctum', 'throttle:60,1']);
            Route::post('bulk-delete', [NewsletterController::class, 'bulkDelete'])->name('bulk-delete');
        });
    });
});

// API Documentation
Route::get('docs', function () {
    return response()->json([
        'message' => 'API documentation available at ' . config('app.url') . '/api/documentation',
        'version' => '1.0',
        'last_updated' => '2024-03-20'
    ]);
});

// Fallback for undefined API routes
Route::fallback(function () {
    return response()->json([
        'message' => 'API endpoint not found. Please check the documentation.',
        'documentation_url' => config('app.url') . '/api/documentation'
    ], 404);
});
