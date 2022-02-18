<?php

namespace Pipedev\Lazerpay;

use Illuminate\Support\ServiceProvider;

class LazerPayServiceProvider extends ServiceProvider
{
    public $path;

    public function __construct($app)
    {
        $this->path = dirname(__DIR__) . '/config/lazerpay.php';
        parent::__construct($app);
    }

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
        $this->mergeConfigFrom($this->path, 'lazerpay');

        $this->app->bind('lazerpay', function () {

            return new Lazerpay;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootPublishing();
    }


    protected function bootPublishing()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes(
                [
                    $this->path => config_path('lazerpay.php'),
                ],
                'lazerpay'
            );
        }
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
