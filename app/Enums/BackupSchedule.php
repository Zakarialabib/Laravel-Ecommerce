<?php

declare(strict_types=1);

namespace App\Enums;

enum BackupSchedule: string
{
    case DAILY = '0';

    case WEEKLY = '1';

    case MONTHLY = '2';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
