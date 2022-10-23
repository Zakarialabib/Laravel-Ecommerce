<?php

namespace App\Http\Livewire\Admin\Arrrival;

use Livewire\Component;
use App\Models\ArrivalSection;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

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
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 25;
        $this->paginationOptions = config('settings.pagination.options');
        $this->orderable         = (new ArrivalSection())->orderable;
    }

    public function render()
    {
        $query = ArrivalSection::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $arrivalsections = $query->paginate($this->perPage);

        return view('livewire.admin.arrrival.index', compact('arrivalsections'));
    }

}