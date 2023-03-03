<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\Category;
use App\Models\Language;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createSubcategory;

    public $listeners = ['createSubcategory'];

    public $subcategory;

    public array $rules = [
        'subcategory.name' => ['required', 'string', 'max:255'],
        'subcategory.category_id' => ['nullable', 'integer'],
        'subcategory.language_id' => ['nullable'],
    ];

    public function mount(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('subcategory_create'), 403);

        return view('livewire.admin.subcategory.create');
    }

    public function createSubcategory()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createSubcategory = true;
    }

    public function create()
    {
        $this->validate();

        $this->subcategory->slug = Str::slug($this->subcategory->name);

        $this->subcategory->save();

        $this->alert('success', __('Subcategory created successfully.'));
        $this->emit('refreshIndex');
        $this->createSubcategory = false;
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function getLanguagesProperty()
    {
        return Language::select('name', 'id')->get();
    }
}
