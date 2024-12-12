<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('@panel')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Portfolio Categories
    Route::resource('portfolio-categories', PortfolioCategoryController::class);
    Route::resource('portfolio', PortfolioController::class);
    Route::post('portfolio/reorder', [PortfolioController::class, 'reorder'])->name('portfolio.reorder');
    Route::get('portfolio-categories', [PortfolioController::class, 'categories'])->name('portfolio.categories');
    Route::post('portfolio-categories/reorder', [PortfolioController::class, 'reorderCategories'])->name('portfolio.categories.reorder');
    Route::resource('blog', BlogController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('settings', SettingController::class);
});
