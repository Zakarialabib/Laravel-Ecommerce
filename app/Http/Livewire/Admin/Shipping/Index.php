<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Shipping;

use App\Http\Livewire\WithSorting;
use App\Models\Shipping;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $listeners = [
        'refreshIndex' => '$refresh',
    ];

    public int $perPage;

    public $shipping;

    public $refreshIndex;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

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
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Shipping())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Shipping::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $shippings = $query->paginate($this->perPage);

        return view('livewire.admin.shipping.index', compact('shippings'));
    }

    public function delete(shipping $shipping)
    {
        // abort_if(Gate::denies('shipping_delete'), 403);

        $shipping->delete();

        $this->alert('success', __('shipping deleted successfully.'));
    }
}
