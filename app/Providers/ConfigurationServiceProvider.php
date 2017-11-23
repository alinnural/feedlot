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
        /*
        information : https://stackoverflow.com/questions/40794966/laravel-settings-service-provider-database-migration
        baris ini dikomentari dulu saat mau migrate karena akan ada pesan error
        */
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