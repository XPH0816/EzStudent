<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (!$this->app->environment('production')) {
            $this->app->register('App\Providers\FakerServiceProvider');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('superadmin', function () {
            return auth()->check() && auth()->user()->isSuperAdmin();
        });

        RateLimiter::for('web', function ($request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip())->response(function ($request) {
                logger("Too Many Attempts from IP: " . $request->ip() . " Device: " . $request->userAgent());
                return abort(429, 'Too Many Attempts.');
            });
        });

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
