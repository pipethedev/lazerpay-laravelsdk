<?php

namespace Pipedev\Lazerpay;

use Illuminate\Http\Client\RequestException;
use Pipedev\Lazerpay\helpers\Helper;

class Lazerpay extends Helper
{
    /**
     * @throws RequestException
     */
    public function initializePayment(array $data): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->post($this->urlWrapper(Action::INIT_TRANSACTION), array_merge($data, [
            'reference' => $this->generateReference(12)
        ]))->throw();

        return json_decode($result);
    }

    public function confirmPayment(string $identifier): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->get($this->urlWrapper(Action::CONFIRM_TRANSACTION,$identifier))->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function generatePaymentLink(array $data): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->post($this->urlWrapper(Action::PAYMENT_LINK), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function getSinglePaymentLink(string $identifier): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->get($this->urlWrapper(Action::PAYMENT_LINK, $identifier))->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function updatePaymentLink(array $data, string $identifier): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->put($this->urlWrapper(Action::PAYMENT_LINK, $identifier), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function allPaymentLinks(): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->get($this->urlWrapper(Action::PAYMENT_LINK))->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function transferFunds(array $data): mixed
    {
        $result =  (new helpers\LazerpayAPI)->url(true)->post($this->urlWrapper(Action::TRANSFER_FUNDS), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function getAcceptedCoins(): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->get($this->urlWrapper(Action::GET_ACCEPTED_COINS))->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function swapCrypto(array $data): mixed
    {
        $result = (new helpers\LazerpayAPI)->url()->post($this->urlWrapper(Action::GET_CRYPTO_AMOUNT), $data)->throw();

        return json_decode($result);
    }
}
