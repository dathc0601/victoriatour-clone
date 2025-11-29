<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set fallback locale
        app()->setFallbackLocale('en');

        // Share languages with all views
        View::composer('*', function ($view) {
            $view->with('languages', \App\Models\Language::active()->ordered()->get());
        });
    }
}
