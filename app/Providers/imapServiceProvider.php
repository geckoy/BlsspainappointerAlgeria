<?php

namespace App\Providers; // App\Providers\imapServiceProvider::class


use Illuminate\Support\ServiceProvider;
/**
 * Dependencies
 */
use App\lib\recommendations\imap;
use App\lib\providers\imapProvider;

class imapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(imap::class, imapProvider::class);
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
        return [imap::class];
    }
}
