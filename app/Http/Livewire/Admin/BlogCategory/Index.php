<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use App\Http\Livewire\WithSorting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Blog Category')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    #[Url]
    public string $search = '';

    #[Url]
    public int $perPage = 25;

    /** @var array<int, string> */
    public array $paginationOptions = [25, 50, 100];

    /** @var array<int, string> */
    public array $selected = [];

    public function mount(): void
    {
        $this->authorize('blogcategory_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new BlogCategory())->orderable;
    }

    #[Computed]
    public function blogCategorys(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return BlogCategory::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ])->paginate($this->perPage);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

   #[Computed]
    public function selectedCount(): int
    {
        return count($this->selected);
    }

    public function deleteModal($blogcategory)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->blogcategory = $blogcategory;
    }

    public function delete()
    {
        abort_if(Gate::denies('blogcategory_delete'), 403);

        BlogCategory::findOrFail($this->blogcategory)->delete();

        $this->alert('success', __('BlogCategory deleted successfully.'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('blogcategory_delete'), 403);

        BlogCategory::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }
    public function render(): View|Factory
    {
        return view('livewire.admin.blogcategory.index', [
            'blogCategorys' => $this->blogCategorys,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
