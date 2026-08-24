<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Shipping;

use App\Http\Livewire\WithSorting;
use App\Models\Shipping;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jantinnerezo\LivewireAlert\Concerns\SweetAlert2 as LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Shipping')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use AuthorizesRequests;

    public $shipping;

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
        $this->authorize('shipping_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new Shipping())->orderable;
    }

    #[Computed]
    public function shippings(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Shipping::advancedFilter([
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

    public function deleteModal($page)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->page = $page;
    }

    public function delete()
    {
        Shipping::findOrFail($this->page)->delete();

        $this->alert('success', __('Shipping deleted successfully.'));
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.admin.shipping.index', [
            'shippings' => $this->shippings,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
