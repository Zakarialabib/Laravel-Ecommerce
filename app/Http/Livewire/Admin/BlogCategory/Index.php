<?php

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Http\Livewire\WithSorting;
use App\Models\BlogCategory;
use App\Models\Language;
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

    public int $perPage;

    public $editModal = false;

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


    public array $rules = [
        'blogcategory.title' => ['required', 'string', 'max:255'],
        'blogcategory.description' => ['nullable'],
        'blogcategory.meta_tag' => ['nullable'],
        'blogcategory.meta_description' => ['nullable'],
        'blogcategory.featured' => ['nullable'],
        'blogcategory.language_id' => ['required', 'integer'],
    ];

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new BlogCategory())->orderable;
        $this->initListsForFields();
    }

    public function render()
    {
        $query = BlogCategory::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $blogcategories = $query->paginate($this->perPage);

        return view('livewire.admin.blog-category.index', compact('blogcategories'));
    }

    public function editModal(BlogCategory $blogcategory)
    {
        abort_if(Gate::denies('blogcategory_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = $blogcategory;

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('blogcategory_edit'), 403);

        $this->validate();
        // condition if save close modal if not stay
        if ($this->blogcategory->save()) {

            $this->editModal = false;
            $this->alert('success', __('BlogCategory updated successfully'));

        } else {

            $this->alert('error', __('BlogCategory not updated'));
        }
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
