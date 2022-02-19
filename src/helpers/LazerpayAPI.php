<?php

namespace Pipedev\Lazerpay\helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;


class LazerpayAPI
{
    public function worker(bool $isPayOut = false): \Illuminate\Http\Client\PendingRequest
    {
        $payOut = [];
        if($isPayOut){
            $secKey = Config::get('lazerpay.lazer_secret_key');
            $payOut = [
                'Authorization' => "Bearer $secKey"
            ];
        }
        return Http::retry(3, 100)->withHeaders(array_merge([
            'x-api-key' => Config::get('lazerpay.lazer_public_key')
        ], $payOut));
    }
}
