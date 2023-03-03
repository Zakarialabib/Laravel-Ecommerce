<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Currency;

use App\Models\Currency;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $listeners = ['createCurrency'];

    public $createCurrency;

    public $currency;

    public array $rules = [
        'currency.name' => 'required|string|max:255',
        'currency.code' => 'required|string|max:255',
        'currency.symbol' => 'required|string|max:255',
        'currency.exchange_rate' => 'required|numeric',
    ];

    public function mount(Currency $currency)
    {
        $this->currency = $currency;
    }

    /** @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory */
    public function render(): View|Factory
    {
        abort_if(Gate::denies('currency_create'), 403);

        return view('livewire.currency.create');
    }

    public function createCurrency()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createCurrency = true;
    }

    public function create()
    {
        $this->validate();

        $this->currency->save();

        $this->alert('success', __('Currency created successfully.'));

        $this->emit('refreshIndex');

        $this->createCurrency = false;
    }
}
