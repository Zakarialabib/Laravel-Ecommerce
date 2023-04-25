<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use App\Models\Language;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public $blogcategory;

    public $editModal = false;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'blogcategory.title'       => 'required|string|max:255',
        'blogcategory.description' => 'nullable',
        'blogcategory.meta_title'  => 'nullable|max:100',
        'blogcategory.meta_desc'   => 'nullable|max:200',
        'blogcategory.language_id' => 'required|integer',
    ];

    public function editModal($blogcategory)
    {
        // abort_if(Gate::denies('blogcategory_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = BlogCategory::findOrFail($blogcategory);

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->blogcategory->save();

        $this->alert('success', __('BlogCategory updated successfully'));

        $this->editModal = false;

        $this->emit('refreshIndex');
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }

    public function render(): View
    {
        return view('livewire.admin.blog-category.edit');
    }
}
