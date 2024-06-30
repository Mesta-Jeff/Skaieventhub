<?php

namespace App\Providers;

use App\Services\ArkeselSmsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Arkesel Sms
        $this->app->singleton(ArkeselSmsService::class, function ($app) {
            return new ArkeselSmsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        
    }
}
