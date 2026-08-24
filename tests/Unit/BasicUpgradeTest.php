<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;

class BasicUpgradeTest extends TestCase
{
    public function test_laravel_version_is_13()
    {
        $this->assertTrue(str_starts_with(app()->version(), '13.'));
    }
}
