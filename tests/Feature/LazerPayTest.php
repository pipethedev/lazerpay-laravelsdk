<?php

namespace Pipedev\Lazerpay\Test\Feature;

use Pipedev\Lazerpay\Lazerpay;

beforeEach(function () {
    $this->lazerpay = new Lazerpay();
    $this->transaction = $this->lazerpay->initializePayment([
        "customer_name" => "iamnotstatic.eth",
        "customer_email" => "abdulfataisuleiman67@gmail.com",
        "coin" => "USDC",
        "currency" => "USD",
        "amount" => 100,
        "fiatAmount" => "100",
        "accept_partial_payment" => true
    ]);
});

test('returns supported coins', function () {
    $result = $this->lazerpay->getAcceptedCoins();

    expect($result->status)->toBe('success');
});

test('it should initialize a payment', function () {
    expect($this->transaction->status)->toBe('success');
});

test('confirm a payment', function () {
    $result = $this->lazerpay->confirmPayment($this->transaction->data->address);

    expect($result->status)->toBe('success');
});

test('create a payment link', function () {
    $result = $this->lazerpay->generatePaymentLink([
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
    $result = $this->lazerpay->getSinglePaymentLink("jgidgd");

    expect($result->status)->toBe('success');
});

test('should update a payment link using reference', function () {
    $result = $this->lazerpay->updatePaymentLink([
        "status" => "active"
    ], "jgidgd");

    expect($result->status)->toBe('success');
});

test('should return all payment links', function () {
    $result = $this->lazerpay->allPaymentLinks();
    
    expect($result->status)->toBe('success');
});

test('Get crypto out amount', function() {
    $result = $this->lazerpay->swapCrypto([
        "amount" => 100,
        "fromCoin" => 'BUSD',
        "toCoin" => 'USDT',
        "blockchain" => 'Binance Smart Chain'
    ]);

    expect($result->status)->toBe('success');
});
