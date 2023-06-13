<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\PaymentGateways;

use App\Http\Livewire\WithSorting;
use App\Models\Paymentgateway;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPaymentgateway;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPaymentgateway();
    }

    public function updatingPerPaymentgateway()
    {
        $this->resetPaymentgateway();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPaymentgateway = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Paymentgateway())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Paymentgateway::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $paymentgateways = $query->paginate($this->perPage);

        return view('livewire.admin.payment-gateways.index', compact('paymentgateways'))->extends('layouts.dashboard');
    }
}
