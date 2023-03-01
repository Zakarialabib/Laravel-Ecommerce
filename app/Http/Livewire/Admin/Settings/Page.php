<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Page extends Component
{
    public function render(): View|Factory
    {
        return view('livewire.admin.settings.page');
    }
}
