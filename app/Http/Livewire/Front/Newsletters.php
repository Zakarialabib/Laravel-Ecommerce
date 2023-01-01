<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Newsletters extends Component
{
    public $email;
    
    public function render()
    {
        return view('livewire.front.newsletters');
    }
}
