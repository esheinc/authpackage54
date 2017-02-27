<?php

namespace Esheinc\AuthPackage;

use Config;
use Illuminate\Support\ServiceProvider;

class AuthPackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/AuthPackage'),
            __DIR__.'/assets' => base_path('public/assets'),
            __DIR__.'/migrations' => base_path('database/migrations'),
            __DIR__.'/seeds' => base_path('database/seeds'),
            __DIR__.'/authpackage.php' => config_path('authpackage.php'),
        ]);

        // load view
        if (is_dir(base_path() . '/resources/views/vendor/AuthPackage')) {
            // The package views have been published - use those views.
            $this->loadViewsFrom(base_path() . '/resources/views/vendor/AuthPackage', 'AuthView');
        } else {
            // The package views have not been published. Use the defaults.
            $this->loadViewsFrom(__DIR__.'/views', 'AuthView');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // service providers
        $this->app->register('Torann\GeoIP\GeoIPServiceProvider');
        $this->app->register('Jenssegers\Agent\AgentServiceProvider');

        Config::set('auth.providers.users.model', Config::get('authpackage.users.model'));
        Config::set('geoip.cache_tags', Config::get('authpackage.geoip.cache_tags'));


        //command
        $this->commands([
                Console\Install::class
            ]);
    }
}
