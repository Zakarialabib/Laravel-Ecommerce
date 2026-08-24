<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Subcategory;

use App\Http\Livewire\WithSorting;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\Concerns\SweetAlert2 as LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Subcategories')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use AuthorizesRequests;

    public $subcategory;

    public $image;

    public $deleteModal = false;


    #[Url]
    public string $search = '';




    #[Url]
    public int $perPage = 25;

    /** @var array<int, string> */
    public array $selected = [];

    /** @var array<int, string> */
    public array $paginationOptions = [25, 50, 100];

    public function mount(): void
    {
        $this->authorize('subcategory_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new Subcategory())->orderable;
    }

    #[Computed]
    public function subcategories(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Subcategory::with('category')->advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ])->paginate($this->perPage);
    }

   #[Computed]
    public function selectedCount(): int
    {
        return count($this->selected);
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

    public function deleteModal($subcategory)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->subcategory = $subcategory;
    }

    public function delete()
    {
        abort_if(Gate::denies('subcategory_delete'), 403);

        Subcategory::findOrFail($this->subcategory)->delete();

        $this->alert('success', __('Subcategory deleted successfully.'));
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.admin.subcategory.index', [
            'subcategories' => $this->subcategories,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
