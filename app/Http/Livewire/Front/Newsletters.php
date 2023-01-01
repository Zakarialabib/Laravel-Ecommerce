<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Newsletters extends Component
{
    public $email;

    public function render(): View|Factory
    {
        return view('livewire.front.newsletters');
    }
}
