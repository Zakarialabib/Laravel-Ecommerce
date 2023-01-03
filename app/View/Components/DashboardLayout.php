<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardLayout extends Component
{
    public function render()
    {
        return view('layouts.dashboard');
    }
}
