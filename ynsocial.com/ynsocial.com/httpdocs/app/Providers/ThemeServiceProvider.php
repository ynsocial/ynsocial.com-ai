<?php

namespace App\Providers;

use App\Helpers\ThemeHelper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ThemeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share theme settings with all views
        View::composer('*', function ($view) {
            $view->with('theme', ThemeHelper::getThemeSettings());
        });

        // Register theme helper as a singleton
        $this->app->singleton('theme', function ($app) {
            return new ThemeHelper();
        });
    }
} 