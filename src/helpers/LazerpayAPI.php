<?php

namespace Pipedev\Lazerpay\helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class LazerpayAPI
{
    public static function url()
    {
        $publicKey = Config::get('lazerpay.key');
        $secretKey = Config::get('lazerpay.secret');

        return Http::retry(3, 100)->withToken($secretKey)->withHeaders([
            'x-api-key' => $publicKey
        ]);
    }
}
