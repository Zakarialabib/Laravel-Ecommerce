<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Show extends Component
{
    public $brand;

    public $listeners = [
        'showModal',
    ];

    public $showModal = false;

    public function showModal($id)
    {
        abort_if(Gate::denies('brand_show'), 403);

        $this->brand = Brand::findOrFail($id);

        $this->showModal = true;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.brands.show');
    }
}
