<?php

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use LivewireAlert , WithFileUploads;

    public $createSubcategory;
    
    public $image;

    public $listeners = ['createSubcategory'];
    
    public array $listsForFields = [];

    public function mount(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
        $this->subcategory->language_id = 1;
        
        $this->initListsForFields();

    }

    public array $rules = [
        'subcategory.name' => ['required', 'string', 'max:255'],
        'subcategory.category_id' => ['required', 'string'],
        'subcategory.language_id' => ['required', 'string'],
    ];

    public function render()
    {
        abort_if(Gate::denies('subcategory_create'), 403);

        return view('livewire.subcategorys.create');
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

        $this->product->slug = Str::slug($this->product->name);

        if($this->image){
            $imageName = Str::slug($this->subcategory->name).'.'.$this->image->extension();
            $this->image->storeAs('subcategorys',$imageName);
            $this->subcategory->image = $imageName;
        }

        $this->subcategory->save();

        $this->emit('refreshIndex');
        
        $this->alert('success', 'Subcategory created successfully.');
        
        $this->createSubcategory = false;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }

}
