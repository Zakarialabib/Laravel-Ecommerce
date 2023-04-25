<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $category;

    public $image;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'category.name' => ['required', 'max:255'],
    ];

    public function editModal($category)
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->category = Category::findOrFail($category);

        $this->editModal = true;
    }

    public function update()
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->category->name).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('categories', $imageName);
            $this->category->image = $imageName;
        }

        $this->category->save();

        $this->editModal = false;

        $this->alert('success', __('Category updated successfully.'));
    }

    public function render(): View
    {
        return view('livewire.admin.categories.edit');
    }
}
