<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Http\Livewire\WithSorting;
use App\Models\Blog;
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
        'refreshIndex' => '$refresh',
        'delete'
    ];

    public $blog;

    public int $perPage;

    public $deleteModal = false;

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
        $this->orderable = (new Blog())->orderable;
    }

    public function delete()
    {
        abort_if(Gate::denies('blog_delete'), 403);

        Blog::findOrFail($this->blog)->delete();

        $this->alert('success', __('Blog deleted successfully.'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('blog_delete'), 403);

        Blog::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function deleteModal($blog)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->blog = $blog;
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
}
