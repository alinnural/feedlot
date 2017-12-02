<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        */
        if (Schema::hasTable('settings')) {
            config()->set('configuration', \App\Setting::pluck('value', 'code')->all());
        }
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