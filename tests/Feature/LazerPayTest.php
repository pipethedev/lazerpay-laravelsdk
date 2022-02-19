<?php

namespace Pipedev\Lazerpay\Test\Feature;

use Illuminate\Http\Client\RequestException;
use Pipedev\Lazerpay\Lazerpay;

test('it returns supported coins', function () {
    $lazerpay = new Lazerpay();
    $result = $lazerpay->getAcceptedCoins();
    expect($result->message)->toBe('Retrive accepted coins');
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

test('it should confirm a payment', function () {
    $lazerpay = new Lazerpay();
    $result = $lazerpay->confirmPayment('Kib2dH0KMbvG');
    expect($result->status)->toBe('success');
});


test('it should transfer funds [payout]', function () {
    $lazerpay = new Lazerpay();
    $result = $lazerpay->transferFunds([
        "amount" =>  1,
        "recipient" => "0x0B4d358D349809037003F96A3593ff9015E89efA",
        "coin" => 'BUSD',
        "blockchain" => 'Binance Smart Chain',
    ]);
    expect($result->status)->toBe('success');
});
