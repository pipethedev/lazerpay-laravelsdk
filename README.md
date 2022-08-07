<p align="center">
    <img title="Termii" src="https://i.ibb.co/kgqq9Jp/image.png"/>
</p>

## Lazerpay Laravel Package
pipedev/lazerpay is a laravel sdk package that access to laravel api

[![Total Downloads](https://img.shields.io/packagist/dt/zeevx/lara-termii.svg?style=flat-square)](https://packagist.org/packages/pipedev/lazerpay)

## Installation

[PHP](https://php.net) 5.4+ and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Lazerpay, simply require it

```bash
composer require pipedev/lazerpay
```

Or add the following line to the require block of your `composer.json` file.

```
"pipedev/lazerpay": "*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.



Once Laravel Lazerpay is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

```php
'providers' => [
    ...
    Pipedev\Lazerpay\LazerPayServiceProvider::class,
    ...
]
```

> If you use **Laravel >= 5.5** you can skip this step and go to [**`configuration`**](https://github.com/unicodeveloper/laravel-paystack#configuration)

* `Pipedev\Lazerpay\LazerPayServiceProvider::class`

Also, register the Facade like so:

```php
'aliases' => [
    ...
    'Lazerpay' => Pipedev\Lazerpay\Facades\LazerpayFacade::class,
    ...
]
```

## Configuration

You can publish the configuration file using this command:

```bash
php artisan vendor:publish --provider="Pipedev\Lazerpay\LazerPayServiceProvider" --tag="lazerpay"
```

A configuration-file named `lazerpay.php` with some sensible defaults will be placed in your `config` directory:

```php
<?php

return [
    /**
     * Public Key From Lazerpay developer Dashboard
     *
     */

    'lazer_public_key' => env('LAZER_PUBLIC_KEY'),

    /**
     * Secret Key From Lazerpay developer Dashboard
     *
     */

    'lazer_secret_key' => env('LAZER_SECRET_KEY')
];
```



## Usage

Open your .env file and add your lazer pay public key and secret key as displayed below:

```php
LAZER_PUBLIC_KEY=********
LAZER_SECRET_KEY=*******
```

## Test

```php
composer test
```

Basic methods this package provides....
```php
<?php

use Pipedev\Lazerpay\Lazerpay;

$lazerpay = new Lazerpay();

/**
 * Initializes a payment transaction and returns the address to be used in completing the payment.
 */
    $lazerpay->initializePayment([
        "customer_name" => "iamnotstatic.eth",
        "customer_email" => "abdulfataisuleiman67@gmail.com",
        "coin" => "USDC",
        "currency" => "USD",
        "amount" => 100,
        "fiatAmount" => "100",
        "accept_partial_payment" => true
    ]);

/**
 * Gets the list of coins supported by Lazerpay. 
 * Using a mainnet API key returns accepted coins on the mainnet and using a testnet API key returns the accepted coins on the testnet.
 */
    $lazerpay->getAcceptedCoins();

/**
 * Checks if a payment has been completed and returns a state to show the status of the payment. 
 * Payment status can either be confirmed or incomplete.
 */
    $identifier = 'Transaction reference';
    $lazerpay->confirmPayment($identifier);

/**
 * Transfers crypto amount from businesses lazerpay balance to external crypto wallet
 */
    $lazerpay->transferFunds([
        "amount" =>  1,
        "recipient" => "0x0B4d358D349809037003F96A3593ff9015E89efA",
        "coin" => 'BUSD',
        "blockchain" => 'Binance Smart Chain',
    ]);

/**
 * Generate payment links
 */
    $lazerpay->generatePaymentLink([
      "title" => 'Njoku Test',
      "description" => 'Testing this sdk',
      "logo" => 'https://webhook.site/d1e815d0-0aa4-4bee-aeb5-a5eb0f62701a',
      "currency" => 'USD',
      "type" => 'standard',
      "amount" => 100
    ]);
    
/**
 * This describes to allow you get all Payment links created
 */
    $lazerpay->allPaymentLinks();
    
/**
 * This describes disabling or enabling a payment link by updating it "active" or "inactive"
 */
    $lazerpay->updatePaymentLink([
        "status" => "active"
    ], "jgidgd");

/**
 * This describes to allow you swap between two stable coins
 */
     $lazerpay->swapCrypto([
        "amount" => 100,
        "fromCoin" => 'BUSD',
        "toCoin" => 'USDT',
        "blockchain" => 'Binance Smart Chain',
        "metadata" => array("id" => "343243243223432"),
    ]);
```

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.

## Support me 😭😭
Kindly star the repo and share with friends


Don't forget to [follow me on twitter](https://twitter.com/pipe_dev)!

🤡🤡,
Muritala David
