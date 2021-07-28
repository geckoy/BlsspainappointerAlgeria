<?php

namespace App\Providers; //App\Providers\postrequestServiceProvider::class
/**
 * @Dependencies
 */
use Illuminate\Support\ServiceProvider;
use App\lib\providers\postrequestProvider;
use App\lib\recommendations\postrequest;

class postrequestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(postrequest::class, postrequestProvider::class);
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
        return [postrequest::class];
    }
}
