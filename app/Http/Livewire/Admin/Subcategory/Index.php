<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\Component;
use App\{
    Models\Category,
    Models\Subcategory
};
use Illuminate\Http\Response;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;
use Str;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $listeners = [
    
        'confirmDelete', 'delete', 'showModal', 'editModal',         
        'refreshIndex',
    
    ];

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
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Subcategory())->orderable;
    }

    public function render()
    {
        $query = Subcategory::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $subcategories = $query->paginate($this->perPage);

        return view('livewire.admin.subcategory.index', compact('subcategories'));
    }

    public function showModal(Subcategory $subcategory)
    {
        abort_if(Gate::denies('show_subcategories'), 403);

        $this->subcategory = $subcategory;

        $this->showModal = true;  
    }

    public function editModal(Subcategory $subcategory)
    {
        abort_if(Gate::denies('edit_subcategories'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->subcategory = $subcategory;

        $this->editModal = true;  
    }

    public function update()
    {
        abort_if(Gate::denies('edit_subcategories'), 403);

        $this->validate();

        $this->subcategory->save();

        $this->editModal = false;

        $this->alert('success', 'Subcategory updated successfully.');
    }


    public function delete(Subcategory $subcategory)
    {
        abort_if(Gate::denies('delete_subcategories'), 403);

        $subcategory->delete();
    }


}