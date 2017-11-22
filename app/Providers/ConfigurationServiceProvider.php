<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        config()->set('configuration', \App\Setting::pluck('value', 'code')->all());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}