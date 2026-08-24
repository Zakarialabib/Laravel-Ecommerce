<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\WithSorting;
use App\Models\Role;
use App\Models\User;
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
#[Title('Users')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use AuthorizesRequests;

    public $user;

    public $role;

    public $showModal = false;

    public $deleteModal = false;


    #[Url]
    public string $search = '';




    #[Url]
    public int $perPage = 100;

    /** @var array<int, string> */
    public array $selected = [];

    /** @var array<int, string> */
    public array $paginationOptions = [25, 50, 100];

    protected $rules = [
        'user.name' => 'required|string|max:255',
        'user.email' => 'required|email|unique:users,email',
        'user.password' => 'required|string|min:8',
        'user.phone' => 'required|numeric',
        'user.city' => 'nullable',
        'user.country' => 'nullable',
        'user.address' => 'nullable',
        'user.tax_number' => 'nullable',
    ];

    public function mount(): void
    {
        $this->authorize('user_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new User())->orderable;
    }

    #[Computed]
    public function users(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return User::with('roles')->advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ])->paginate($this->perPage);
    }

    public function getSelectedCountProperty(): int
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

    #[Computed]
    public function roles(): \Illuminate\Support\Collection
    {
        return Role::pluck('name', 'id');
    }

    public function assignRole(User $user, $role)
    {
        $user->assignRole($role);
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('user_delete'), 403);

        User::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function deleteModal($user)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->user = $user;
    }

    public function delete(User $user)
    {
        abort_if(Gate::denies('user_delete'), 403);

        $user->delete();

        $this->alert('warning', __('User deleted successfully!'));
    }

    public function showModal(User $user)
    {
        $this->user = $user;

        $this->showModal = true;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.users.index', [
            'users' => $this->users,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
