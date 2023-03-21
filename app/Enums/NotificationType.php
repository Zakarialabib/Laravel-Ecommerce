<?php

declare(strict_types=1);

namespace App\Enums;

enum NotificationType : string
{
    case INFO = 'info';
    case WARNING = 'warning';
    case SUCCESS = 'success';
    case DANGER = 'danger';
}
