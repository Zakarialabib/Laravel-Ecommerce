<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class ProductOptions extends Component
{
    public $options;

    public function updatedOptions($options)
    {
        $options = [];

        foreach ($options as $option) {
            if ( ! empty($option['type']) && ! empty($option['value'])) {
                $this->options[] = $option;
            }
        }

        $this->emitUp('optionUpdated', $this->options);
    }

    public function addOption()
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function mount()
    {
        $this->options = [
            [
                'type'  => '',
                'value' => '',
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.admin.product.product-options');
    }
}
