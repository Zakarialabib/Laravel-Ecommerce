<?php

namespace App\Enums;

/**
 * @method static PaymentMethod COD()
 * @method static PaymentMethod STRIPE()
 * @method static PaymentMethod PAYPAL()
 * @method static PaymentMethod WALLET()
 */
class PaymentMethod extends Enum
{
    private const COD = 'cod';
    private const STRIPE = 'stripe';
    private const PAYPAL = 'paypal';
    private const WALLET = 'wallet';
}
