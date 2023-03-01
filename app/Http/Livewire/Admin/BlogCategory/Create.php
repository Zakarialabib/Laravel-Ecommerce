<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createBlogCategory = false;

    public $listeners = ['createBlogCategory'];

    public array $listsForFields = [];

    public $blogcategory;

    protected $rules = [
        'blogcategory.title' => 'required|string|max:255',
        'blogcategory.description' => 'nullable',
        'blogcategory.meta_title' => 'nullable|max:100',
        'blogcategory.meta_desc' => 'nullable|max:200',
        'blogcategory.language_id' => 'required|integer',
    ];

    public function mount(BlogCategory $blogcategory)
    {
        $this->blogcategory = $blogcategory;

        $this->initListsForFields();
    }

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

        $this->blogcategory->save();

        $this->alert('success', __('BlogCategory created successfully.'));

        $this->createBlogCategory = false;

        $this->emit('refreshIndex');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
