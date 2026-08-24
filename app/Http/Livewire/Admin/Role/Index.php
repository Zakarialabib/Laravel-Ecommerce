<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Role;

use App\Http\Livewire\WithSorting;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Roles')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;


    #[Url]
    public string $search = '';




    #[Url]
    public int $perPage = 100;

    /** @var array<int, string> */
    public array $selected = [];

    /** @var array<int, string> */
    public array $paginationOptions = [25, 50, 100];

    public function mount(): void
    {
        $this->authorize('role_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new Role())->orderable;
    }

    #[Computed]
    public function roles(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Role::advancedFilter([
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

    public function deleteSelected()
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Role::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.admin.role.index', [
            'roles' => $this->roles,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
