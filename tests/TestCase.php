<?php

namespace Tests;

use Pipedev\Lazerpay\LazerPayServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected $loadEnvironmentVariables = true;
    
    protected function getPackageProviders($app)
    {
        return [LazerPayServiceProvider::class];
    }
}
