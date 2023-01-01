<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Page extends Component
{
    public function render(): View|Factory
    {
        return view('livewire.admin.settings.page');
    }
}
