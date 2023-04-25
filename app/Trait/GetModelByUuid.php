<?php

declare(strict_types=1);

namespace App\Trait;

trait GetModelByUuid
{
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
