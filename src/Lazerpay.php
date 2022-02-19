<?php

namespace Pipedev\Lazerpay;

use Illuminate\Http\Client\RequestException;
use Pipedev\Lazerpay\helpers\Helper;
use PipeDev\Lazerpay\helpers\LazerpayAPI;


class Lazerpay extends Helper
{

    public $url;

    const INIT_TRANSACTION = "transaction/initialize";
    const CONFIRM_TRANSACTION = "transaction/verify";
    const GET_ACCEPTED_COINS = "coins";
    const TRANSFER_FUNDS = "transfer";

    public function __construct()
    {
        $this->url = 'https://api.lazerpay.engineering/api/v1';
    }


    /**
     * @throws RequestException
     */
    public function initializePayment(array $data)
    {
        $result = (new helpers\LazerpayAPI)->worker()->post($this->url."/".self::INIT_TRANSACTION, array_merge($data, [
            'reference' => $this->generateReference(12)
        ]))->throw();

        return json_decode($result);
    }

    public function confirmPayment(string $identifier)
    {
        $result =  (new helpers\LazerpayAPI)->worker()->get($this->url."/".self::CONFIRM_TRANSACTION."/".$identifier)->throw();

        return json_decode($result);
    }

    public function getAcceptedCoins()
    {
        $result = (new helpers\LazerpayAPI)->worker()->get($this->url."/".self::GET_ACCEPTED_COINS, [])->throw();

        return json_decode($result);
    }

    public function transferFunds(array $data)
    {
        echo $this->url."/".self::TRANSFER_FUNDS;
        $result = (new helpers\LazerpayAPI)->worker()->post($this->url."/".self::TRANSFER_FUNDS, $data)->throw();

        return json_decode($result);
    }
}
