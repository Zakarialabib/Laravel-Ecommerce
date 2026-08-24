<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Menu;

use App\Models\Menu;
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
#[Title('Menu')]
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
        $this->authorize('menu_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new Menu())->orderable;
    }

    #[Computed]
    public function menus(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Menu::advancedFilter([
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
        return view('livewire.admin.menu.index', [
            'menus' => $this->menus,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
    
    public function update()
    {
        $validatedData = $this->validate();
        if ($this->menu) {
            $this->menu->name = $this->menu['name'];
            $this->menu->label = $this->menu['label'];
            $this->menu->url = $this->menu['url'];
            $this->menu->type = $this->menu['type'];
            $this->menu->parent_id = $this->menu['parent_id'] ?? false;
            $this->menu->new_window = $this->menu['new_window'] ?? false;
            // Update any additional fields you have in your menu model
    
            $this->menu->save();
    
            $this->alert('success', __('Menu updated successfully.'));
        }
    
        $this->reset(['name', 'label', 'url', 'type', 'parent_id', 'new_window']);
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'label' => 'required',
            'url' => 'required',
            'parent_id' => 'nullable|exists:menus,id',
            'new_window' => 'boolean',
        ]);
    
        $menu = new Menu();
        $menu->name = $this->name;
        $menu->label = $this->label;
        $menu->type = $this->type;
        $menu->url = $this->url;
        $menu->parent_id = $this->parent_id ?? null;
        $menu->new_window = $this->new_window ?? false;
        // Add any additional fields you have in your menu model
    
        $menu->save();
    
        $this->alert('success', __('Menu created successfully.'));
    
        $this->mount();
    }

    public function updateMenuOrder($ids)
    {

        foreach ($ids as $index => $id) {
            $menu = Menu::find($id);
            $menu->sort_order = $index + 1;
            $menu->save();
        }
        $this->mount();
        $this->alert('success', __('Menu order updated successfully.'));
    }
    
    public function predefinedMenu(): void
    {
        $this->menus = [
            [
                'name' => 'Home',
                'type' => 'route',
                'label' => 'Home',
                'url' => 'home',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'name' => 'About',
                'type' => 'route',
                'label' => 'About',
                'url' => 'about',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'name' => 'Contact',
                'type' => 'route',
                'label' => 'Contact',
                'url' => 'contact',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'name' => 'Login',
                'type' => 'route',
                'label' => 'Login',
                'url' => 'login',
                'parent_id' => null,
                'new_window' => false,
            ],
            [
                'name' => 'Register',
                'type' => 'route',
                'label' => 'Register',
                'url' => 'register',
                'parent_id' => null,
                'new_window' => false,
            ],
        ];
        // create the menus
        foreach ($this->menus as $menu) {
            Menu::create($menu);
        }
        $this->mount();
        $this->alert('success', __('Predefined menus created successfully.'));
    }

    public function delete(Menu $menu)
    {
        // abort_if(Gate::denies('menu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu->delete();
        $this->mount();
        $this->alert('success', __('Menu deleted successfully.'));
    }
}