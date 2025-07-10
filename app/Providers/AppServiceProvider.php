<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // if (env('APP_ENV') !== 'local') {
        //     URL::forceScheme('http');
        // } else {
        //     URL::forceScheme('https');
        // }
        if (str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        } else {
            URL::forceScheme('http');
        }
    }
}
