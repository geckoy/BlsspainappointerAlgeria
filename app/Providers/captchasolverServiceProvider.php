<?php

namespace App\Providers; // App\Providers\captchasolverServiceProvider::class
/**
 * Dependencies
 */
use Illuminate\Support\ServiceProvider;
use App\lib\providers\captchasolverProvider;
use App\lib\recommendations\captchasolver;

class captchasolverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(captchasolver::class, captchasolverProvider::class);
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
        return [captchasolver::class];
    }
}
