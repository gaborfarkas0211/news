<?php

namespace App\Providers;

use App\Services\NewsdataApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsdataApiService::class, function ($app) {
            return new NewsdataApiService(config('services.newsdata.api_key'));
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
