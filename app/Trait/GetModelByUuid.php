<?php

namespace App\Trait;

trait GetModelByUuid
{
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}