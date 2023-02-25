<?php

namespace App\Providers;

use App\Services\NewsdataApiService;
use App\Services\TextAnalyzer;
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

        $this->app->bind(TextAnalyzer::class, function ($app, $parameters): TextAnalyzer {
            return new TextAnalyzer($parameters[0]);
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
