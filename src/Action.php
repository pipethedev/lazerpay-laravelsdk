<?php

namespace Pipedev\Lazerpay;

abstract class Action {
    const INIT_TRANSACTION = "INIT_TRANSACTION";
    const CONFIRM_TRANSACTION = "CONFIRM_TRANSACTION";
    const GET_ACCEPTED_COINS  = "GET_ACCEPTED_COINS";
    const TRANSFER_FUNDS = "TRANSFER_FUNDS";
    const PAYMENT_LINK = "PAYMENT_LINK";
}