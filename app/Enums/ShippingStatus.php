<?php

declare(strict_types=1);

namespace App\Enums;

enum ShippingStatus: string
{

    const  PENDING = '0';
    const  PREPARING = '1';
    const SUBMITTED = '2';
    const  SHIPPING = '3';
    const  DELIVERED = '4';
    const  CANCELLED = '5';
    const  FAILED = '6';

      /**
     * Return a human-readable description of this payment method.
     * @return string
     */
    public function getDescription(): string
    {
        return match ($this)
        {
            ShippingStatus::PENDING => "Shipping is pending needs review",
            ShippingStatus::PREPARING => "Shipping is getting prepared",
            ShippingStatus::SUBMITTED => "Shipping is submitted",
            ShippingStatus::SHIPPING => "Shipping is on route",
            ShippingStatus::DELIVERED => "Shipping is delivered",
            ShippingStatus::CANCELLED => "Shipping is canceled",
            ShippingStatus::FAILED => "Shipping failed",
        };
    }

    
}
