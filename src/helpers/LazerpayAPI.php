<?php

namespace Pipedev\Lazerpay\helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;


class LazerpayAPI
{
    public static function url(): \Illuminate\Http\Client\PendingRequest
    {
        $secKey = Config::get('lazerpay.lazer_secret_key');
        return Http::retry(3, 100)->withToken($secKey)->withHeaders([
            'x-api-key' => Config::get('lazerpay.lazer_public_key')
        ]);
    }
}
