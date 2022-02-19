<?php

namespace Pipedev\Lazerpay\helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;


class LazerpayAPI
{
    public function worker(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::retry(3, 100)->withHeaders([
            'x-api-key' => Config::get('lazerpay.lazer_public_key')
        ]);
    }
}
