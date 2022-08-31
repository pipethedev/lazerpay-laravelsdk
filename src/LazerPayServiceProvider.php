<?php

namespace Pipedev\Lazerpay;

use Illuminate\Support\ServiceProvider;

class LazerPayServiceProvider extends ServiceProvider
{
    public $path;

    protected $defer = false;

    public function __construct($app)
    {
        $this->path = dirname(__DIR__) . '/config/lazerpay.php';

        parent::__construct($app);
    }

    public function register()
    {
        $this->mergeConfigFrom($this->path, 'lazerpay');

        $this->app->bind('lazerpay', function () {
            return new Lazerpay;
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->path => config_path('lazerpay.php'),
            ], 'lazerpay');
        }
    }

    public function provides(): array
    {
        return ['lazerpay'];
    }
}
