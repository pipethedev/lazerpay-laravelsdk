<?php

namespace Pipedev\Lazerpay;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Pipedev\Lazerpay\helpers\Helper;
use PipeDev\Lazerpay\helpers\LazerpayAPI;

class Lazerpay extends Helper
{

    /**
     * @throws RequestException
     */
    public function initializePayment(array $data): JsonResponse
    {

        $result = LazerpayAPI::url()->post($this->urlWrapper(Action::INIT_TRANSACTION), array_merge($data, [
            'reference' => $this->generateReference(12)
        ]))->throw();

        return json_decode($result);
    }

    public function confirmPayment(string $identifier): JsonResponse
    {
        $result = LazerpayAPI::url()->get($this->urlWrapper(Action::CONFIRM_TRANSACTION,$identifier))->throw();

        return json_decode($result);
    }


    /**
     * @throws RequestException
     */
    public function generatePaymentLink(array $data): JsonResponse
    {
        $result = LazerpayAPI::url()->post($this->urlWrapper(Action::PAYMENT_LINK), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function getSinglePaymentLink(string $identifier): JsonResponse
    {
        $result = LazerpayAPI::url()->get($this->urlWrapper(Action::PAYMENT_LINK, $identifier))->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function updatePaymentLink(array $data, string $identifier): JsonResponse
    {
        $result = LazerpayAPI::url()->post($this->urlWrapper(Action::PAYMENT_LINK, $identifier), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function allPaymentLinks(): JsonResponse
    {
        $result = LazerpayAPI::url()->get($this->urlWrapper(Action::PAYMENT_LINK))->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function transferFunds(array $data): JsonResponse
    {
        $result =  LazerpayAPI::url(true)->post($this->urlWrapper(Action::TRANSFER_FUNDS), $data)->throw();

        return json_decode($result);
    }

    /**
     * @throws RequestException
     */
    public function getAcceptedCoins(): JsonResponse
    {
        $result = LazerpayAPI::url()->get($this->urlWrapper(Action::GET_ACCEPTED_COINS))->throw();

        return json_decode($result);
    }
}
