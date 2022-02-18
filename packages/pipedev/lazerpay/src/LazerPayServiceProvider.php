<?php

namespace Pipedev\Lazerpay;

use Illuminate\Support\ServiceProvider;

class LazerPayServiceProvider extends ServiceProvider
{
    /*
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('lazerpay', function () {

            return new Lazerpay();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = realpath(__DIR__.'/../config/config.php');

        $this->publishes([
            $config => config_path('lazerpay.php')
        ]);
    }

    /**
     * Get the services provided by the provider
     * @return array
     */
    public function provides(): array
    {
        return ['lazerpay'];
    }
}
