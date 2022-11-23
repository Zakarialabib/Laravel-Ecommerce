<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Cache extends Component
{
    use LivewireAlert;

    protected $listeners = ['onClearCache'];

    public function render()
    {
        return view('livewire.admin.cache');
    }

    public function onClearCache()
    {
        Artisan::call('optimize:clear');

        Artisan::call('optimize');

        $this->alert('success', __('All caches have been cleared!'));
    }
}
