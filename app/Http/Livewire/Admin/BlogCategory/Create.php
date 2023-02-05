<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createBlogCategory;

    public $listeners = ['createBlogCategory'];

    public array $listsForFields = [];

    public $blogcategory;

    public function mount(BlogCategory $blogcategory)
    {
        $this->blogcategory = $blogcategory;
        $this->blogcategory->language_id = 1;

        $this->initListsForFields();
    }

    public array $rules = [
        'blogcategory.title'            => ['required', 'string', 'max:255'],
        'blogcategory.description'      => ['nullable'],
        'blogcategory.meta_title'       => ['nullable'],
        'blogcategory.meta_desc' => ['nullable'],
        'blogcategory.featured'         => ['nullable'],
        'blogcategory.language_id'      => ['required', 'integer'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('blogcategory_create'), 403);

        return view('livewire.admin.blog-category.create');
    }

    public function createBlogCategory()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createBlogCategory = true;
    }

    public function create()
    {
        $this->validate();

        if ($this->blogcategory->save()) {
            $this->alert('success', __('BlogCategory created successfully.'));
            $this->createBlogCategory = false;
            $this->emit('refreshIndex');
        } else {
            $this->alert('error', __('BlogCategory not created'));
        }
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
