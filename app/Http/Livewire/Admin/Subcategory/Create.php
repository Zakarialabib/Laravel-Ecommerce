<?php

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\Category;
use App\Models\Language;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert , WithFileUploads;

    public $createSubcategory;

    public $listeners = ['createSubcategory'];

    public $subcategory;

    public array $listsForFields = [];

    public function mount(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
        $this->initListsForFields();
    }

    public array $rules = [
        'subcategory.name' => ['required', 'string', 'max:255'],
        'subcategory.category_id' => ['required'],
        'subcategory.language_id' => ['required'],
    ];

    public function render()
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

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
