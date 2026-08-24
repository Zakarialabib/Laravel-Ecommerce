<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Subscriber;

use App\Models\Subscriber;
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
#[Title('Subscriber')]
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
        $this->authorize('subscriber_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new Subscriber())->orderable;
    }

    #[Computed]
    public function subscribers(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Subscriber::advancedFilter([
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

    public function render(): View|Factory
    {
        return view('livewire.admin.subscriber.index', [
            'subscribers' => $this->subscribers,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
