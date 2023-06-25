<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Menu;

use App\Http\Livewire\WithSorting;
use App\Models\Menu;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    
    public string $perPage = '100';

    protected $listeners = [
        'refreshIndex' => '$refresh'
    ];

    public $menu;
    public $menus;
    public $name;
    public $label;
    public $url;
    public $type;
    public $parent_id;
    public $new_window;

    protected $rules = [
        'menus.*.name' => 'required',
        'menus.*.type' => 'required',
        'menus.*.label' => 'required',
        'menus.*.url' => 'required',
        'menus.*.parent_id' => 'nullable|exists:menus,id',
        'menus.*.new_window' => 'boolean',
    ];

    public function mount()
    {
        $this->menus = Menu::orderBy('sort_order')->get()->toArray();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        $menus = $this->getMenus();

        return view('livewire.admin.menu.index', compact('menus'))->extends('layouts.dashboard');
    }

    protected function getMenus()
    {
        return Menu::query()->paginate($this->perPage);
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
