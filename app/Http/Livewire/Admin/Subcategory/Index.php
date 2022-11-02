<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\Component;
use App\{
    Models\Language,
    Models\Subcategory,
    Models\Category
};
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $listeners = [
    
        'confirmDelete', 'delete', 'editModal',         
        'refreshIndex',
    
    ];

    public int $perPage;

    public $editModal;

    public $confirmDelete;

    public $refreshIndex;

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

    public function refreshIndex()
    {
        $this->resetPage();
    }

    public array $rules = [
        'subcategory.name' => ['required', 'string', 'max:255'],
        'subcategory.category_id' => ['required', 'integer'],
        'subcategory.language_id' => ['required', 'integer'],
    ];

    public function mount()
    {
    
        $this->initListsForFields();
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Subcategory())->orderable;
    }

    public function render()
    {
        $query = Subcategory::with('category')->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $subcategories = $query->paginate($this->perPage);

        return view('livewire.admin.subcategory.index', compact('subcategories'));
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
        // condition if save close modal if not stay
        if ($this->subcategory->save()) {
            $this->editModal = false;
            $this->alert('success', __('Subcategory updated successfully'));
            $this->emit('refreshIndex');
        } else {
            $this->alert('error', __('Subcategory not updated'));
        }
    }


    public function delete(Subcategory $subcategory)
    {
        abort_if(Gate::denies('delete_subcategories'), 403);

        $subcategory->delete();

        $this->alert('success', __('Subcategory deleted successfully.'));

    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }

}