<?php

namespace App\Providers;

use App\Services\NewsdataApiService;
use App\Services\NewsDescriptionAnalyzer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsdataApiService::class, function ($app): NewsdataApiService {
            return new NewsdataApiService(config('services.newsdata.api_key'));
        });

        $this->app->bind(NewsDescriptionAnalyzer::class, function ($app, $parameters): NewsDescriptionAnalyzer {
            return new NewsDescriptionAnalyzer($parameters[0]);
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
