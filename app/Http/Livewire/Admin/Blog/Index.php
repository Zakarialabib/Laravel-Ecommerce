<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Http\Livewire\WithSorting;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

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

    public $blog;

    public $confirmDelete;

    public $refreshIndex;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

    protected $queryString = [
        'search'        => [
            'except' => '',
        ],
        'sortBy'        => [
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
        'blog.title'            => ['required', 'string', 'max:255'],
        'blog.category_id'      => ['required', 'integer'],
        'blog.details'          => ['required'],
        'blog.meta_tag'         => ['nullable'],
        'blog.meta_description' => ['nullable'],
        'blog.featured'         => ['nullable'],
        'blog.language_id'      => ['nullable', 'integer'],
    ];

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Blog())->orderable;
        $this->initListsForFields();
    }

    public function render(): View|Factory
    {
        $query = Blog::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $blogs = $query->paginate($this->perPage);

        return view('livewire.admin.blog.index', compact('blogs'));
    }

    public function editModal(Blog $blog)
    {
        abort_if(Gate::denies('blog_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blog = $blog;

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('blog_edit'), 403);

        $this->validate();

        if ($this->blog->save()) {
            $this->editModal = false;
            $this->alert('success', __('Blog updated successfully'));
        } else {
            $this->alert('error', __('Blog not updated'));
        }
    }

    public function delete(Blog $blog)
    {
        abort_if(Gate::denies('blog_delete'), 403);

        $blog->delete();

        $this->alert('success', __('Blog deleted successfully.'));
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = BlogCategory::pluck('title', 'id')->toArray();
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
