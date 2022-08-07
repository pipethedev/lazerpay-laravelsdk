<?php

namespace Pipedev\Lazerpay\Test\Feature;

use Illuminate\Http\Client\RequestException;
use Pipedev\Lazerpay\Lazerpay;

    test('returns supported coins', function () {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->getAcceptedCoins();
        expect($result->status)->toBe('success');
    });

    test(/**
     * @throws RequestException
     */ 'it should initialize a payment', function () {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->initializePayment([
            "customer_name" => "iamnotstatic.eth",
            "customer_email" => "abdulfataisuleiman67@gmail.com",
            "coin" => "USDC",
            "currency" => "USD",
            "amount" => 100,
            "fiatAmount" => "100",
            "accept_partial_payment" => true
        ]);
        expect($result->status)->toBe('success');
    });

    test('confirm a payment', function () {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->confirmPayment('0xa5138755f3EC3F68a51f15C6b2832Da6d7E98122');
        expect($result->status)->toBe('success');
    });

    test('create a payment link', function () {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->generatePaymentLink([
            "title" => 'Njoku Test',
            "description" => 'Testing this sdk',
            "logo" => 'https://webhook.site/d1e815d0-0aa4-4bee-aeb5-a5eb0f62701a',
            "currency" => 'USD',
            "type" => 'standard',
            "amount" => 100
        ]);
        expect($result->status)->toBe('success');
    });


    test('should return a payment link using reference', function () {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->getSinglePaymentLink("jgidgd");
        expect($result->status)->toBe('success');
    });

    test('should update a payment link using reference', function () {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->updatePaymentLink([
            "status" => "active"
        ], "jgidgd");
        expect($result->status)->toBe('success');
    });


    test('should return all payment links', function () {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->allPaymentLinks();
        expect($result->status)->toBe('success');
    });

    test('Get crypto out amount', function() {
        $lazerpay = new Lazerpay();
        $result = $lazerpay->swapCrypto([
            "amount" => 100,
            "fromCoin" => 'BUSD',
            "toCoin" => 'USDT',
            "blockchain" => 'Binance Smart Chain'
        ]);
        expect($result->status)->toBe('success');
    });


//test('it should transfer funds [payout]', function () {
//    $lazerpay = new Lazerpay();
//    $result = $lazerpay->transferFunds([
//        "amount" =>  1,
//        "recipient" => "0x0B4d358D349809037003F96A3593ff9015E89efA",
//        "coin" => 'BUSD',
//        "blockchain" => 'Binance Smart Chain',
//    ]);
//    expect($result->status)->toBe('success');
//});
