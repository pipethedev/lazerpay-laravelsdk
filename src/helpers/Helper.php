<?php

namespace Pipedev\Lazerpay\helpers;

use Illuminate\Support\Facades\Config;
use Pipedev\Lazerpay\Action;

class Helper {

    public $url;

    public function __construct()
    {
        $this->url = 'https://api.lazerpay.engineering/api/v1';
    }


    public function generateReference(int $len): string
    {

        $hex = md5(Config::get('lazerpay.lazer_secret_key'). uniqid("", true));

        $pack = pack('H*', $hex);
        $tmp =  base64_encode($pack);

        $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);

        $len = max(4, min(128, $len));

        while (strlen($uid) < $len)
            $uid .= $this->generateReference(22);

        return substr($uid, 0, $len);
    }

    public function urlWrapper(string $type, string $path = ''): string {
        $label = "";
        switch ($type) {
            case Action::INIT_TRANSACTION:
                $label = "/transaction/initialize";
            break;
            case Action::CONFIRM_TRANSACTION:
                $label = "/transaction/verify";
            break;
            case Action::GET_ACCEPTED_COINS:
                $label = "/coins";
            break;
            case Action::TRANSFER_FUNDS:
                $label = "/transfer";
            break;
            case Action::PAYMENT_LINK:
                $label = "/payment-links";
            break;
        };
        if($path !== ''){
            return $this->url.$label."/".$path;
        }
        return $this->url.$label;
    }
}
