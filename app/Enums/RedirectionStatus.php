<?php

declare(strict_types=1);

namespace App\Enums;

enum RedirectionStatus: string
{
    case MOVED_PERMANENTLY = '301';
    case PERMANENT_REDIRECT = '308';
    case FOUND = '302';
    case SEE_OTHER = '303';
    case TEMPORARY_REDIRECT = '307';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    // loop through the values:

    // @foreach(App\Enums\PaymentStatus::values() as $key=>$value)
    //     <option value="{{ $key }}">{{ $value }}</option>
    // @endforeach
}
