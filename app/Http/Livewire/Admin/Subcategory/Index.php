<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Subcategory;

use App\Http\Livewire\WithSorting;
use App\Models\Category;
use App\Models\Language;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;

    public $listeners = [
        'editModal', 'refreshIndex' => '$refresh',
        'delete',
    ];

    public int $perPage;

    public $subcategory;

    public $editModal = false;

    public $refreshIndex;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $rules = [
        'subcategory.name' => ['required', 'string', 'max:255'],
        'subcategory.category_id' => ['nullable', 'integer'],
        'subcategory.language_id' => ['nullable'],
        'subcategory.slug' => ['required'],
    ];

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
        $this->orderable = (new Subcategory())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Subcategory::with('categories')->advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $subcategories = $query->paginate($this->perPage);

        return view('livewire.admin.subcategory.index', compact('subcategories'));
    }

    public function editModal(Subcategory $subcategory)
    {
        abort_if(Gate::denies('subcategory_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->subcategory = $subcategory;

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('subcategory_update'), 403);

        $this->validate();

        $this->subcategory->save();

        $this->editModal = false;

        $this->alert('success', __('Subcategory updated successfully'));
    }

    public function delete(Subcategory $subcategory)
    {
        abort_if(Gate::denies('subcategory_delete'), 403);

        $subcategory->delete();

        $this->alert('success', __('Subcategory deleted successfully.'));
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function getLanguagesProperty()
    {
        return Language::select('name', 'id')->get();
    }
}
