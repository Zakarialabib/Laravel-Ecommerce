<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createBlog;

    public $image;

    public $blog;

    public $blogcategory;

    public $listeners = ['createBlog'];

    public array $listsForFields = [];

    public function mount(Blog $blog)
    {
        $this->blog = $blog;

        $this->blogcategory->language_id = 1;

        $this->initListsForFields();
    }

    public array $rules = [
        'blog.title'            => ['required', 'string', 'max:255'],
        'blog.category_id'      => ['required', 'integer'],
        'blog.details'          => ['required'],
        'blog.meta_tag'         => ['nullable'],
        'blog.meta_description' => ['nullable'],
        'blog.featured'         => ['nullable'],
        'blog.language_id'      => ['required', 'integer'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.create');
    }

    public function createBlog()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createBlog = true;
    }

    public function create()
    {
        $this->validate();

        $this->blog->slug = Str::slug($this->blog->title);

        if ($this->image) {
            $imageName = Str::slug($this->blog->title).'.'.$this->image->extension();
            $this->image->storeAs('blogs', $imageName);
            $this->blog->image = $imageName;
        }

        $this->blog->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Blog created successfully.'));

        $this->createBlog = false;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = BlogCategory::pluck('title', 'id')->toArray();
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
