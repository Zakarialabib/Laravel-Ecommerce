<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class DashboardLayout extends Component
{

    public function render()
    {
        return view('layouts.dashboard');
    }
}
