<?php

namespace Mumutou\LaravelYTXVoip;

use Mumutou\YTXVoip\REST;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/config.php' => config_path('ytx.php'),
            ], 'config');
        }   
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'ytx'
        );  

        $this->app->singleton(['ytx'], function($app){
            return new REST(config('ytx'));
        }); 
    }
}
