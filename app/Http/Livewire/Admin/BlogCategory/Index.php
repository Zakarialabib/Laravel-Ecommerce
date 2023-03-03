<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Http\Livewire\WithSorting;
use App\Models\BlogCategory;
use App\Models\Language;
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
    ];

    public $blogcategory;

    public int $perPage;

    public $editModal = false;

    public $confirmDelete;

    public $refreshIndex;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

    public array $rules = [
        'blogcategory.title' => ['required', 'string', 'max:255'],
        'blogcategory.description' => ['nullable'],
        'blogcategory.meta_title' => ['nullable'],
        'blogcategory.meta_desc' => ['nullable'],
        'blogcategory.language_id' => ['required', 'integer'],
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
        $this->orderable = (new BlogCategory())->orderable;
        $this->initListsForFields();
    }

    public function render(): View|Factory
    {
        $query = BlogCategory::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $blogcategories = $query->paginate($this->perPage);

        return view('livewire.admin.blog-category.index', compact('blogcategories'));
    }

    public function editModal($blogcategory)
    {
        // abort_if(Gate::denies('blogcategory_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = BlogCategory::findOrFail($blogcategory);

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->blogcategory->save();

        $this->alert('success', __('BlogCategory updated successfully'));

        $this->editModal = false;

        $this->emit('refreshIndex');
    }

    public function delete(BlogCategory $blogcategory)
    {
        abort_if(Gate::denies('blogcategory_delete'), 403);

        $blogcategory->delete();

        $this->alert('success', __('BlogCategory deleted successfully.'));
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
