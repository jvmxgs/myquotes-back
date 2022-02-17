<?php

namespace App\Providers;

use App\Services\QuoteService;
use Illuminate\Support\ServiceProvider;

class QuoteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(QuoteService::class, function ($app) {
            return new QuoteService();
        });
    }
}
