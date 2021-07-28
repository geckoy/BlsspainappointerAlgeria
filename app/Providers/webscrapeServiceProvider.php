<?php

namespace App\Providers; // App\Providers\webscrapeServiceProvider::class

/**
 * @Dependencies 
 */
use Illuminate\Support\ServiceProvider;
use App\lib\providers\webscrapeProvider;
use App\lib\recommendations\webscrape;

class webscrapeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(webscrape::class, webscrapeProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [webscrape::class];
    }
}
