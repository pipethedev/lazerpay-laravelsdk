<?php

namespace Pipedev\Lazerpay\Facades;

use Illuminate\Support\Facades\Facade;

class LazerpayFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'lazerpay';
    }

}
