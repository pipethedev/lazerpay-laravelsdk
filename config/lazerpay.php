<?php
/*
 * This file is part of the Lazerpay package.
 *
 * (c) Muritala David <davmuri1414@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    /**
     * Public Key From Lazerpay developer Dashboard
     *
     */

    'key' => env('LAZER_PUBLIC_KEY', null),

    /**
     * Secret Key From Lazerpay developer Dashboard
     *
     */

    'secret' => env('LAZER_SECRET_KEY', null)
];
