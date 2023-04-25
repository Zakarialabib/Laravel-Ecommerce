<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\Quill;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createPage;

    public $page;

    public $image;

    public $description;

    public $listeners = [
        'createPage',
        Quill::EVENT_VALUE_UPDATED,
    ];

    public function quill_value_updated($value)
    {
        $this->page->details = $value;
    }

    protected $rules = [
        'page.title'            => ['required', 'string', 'max:255'],
        'page.slug'             => ['required', 'unique:pages', 'max:255'],
        'page.details'          => ['required'],
        'page.meta_title'       => ['nullable', 'max:255'],
        'page.meta_description' => ['nullable', 'max:255'],
        'page.language_id'      => ['nullable'],
    ];

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('page_create'), 403);

        return view('livewire.admin.page.create');
    }

    public function createPage()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->page = new Page();

        $this->createPage = true;
    }

    public function create()
    {
        $this->validate();

        $this->page->slug = Str::slug($this->page->name);

        if ($this->photo) {
            $imageName = Str::slug($this->page->name).'-'.date('Y-m-d H:i:s').'.'.$this->photo->extension();
            $this->photo->storeAs('pages', $imageName);
            $this->page->photo = $imageName;
        }

        $this->page->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Page created successfully!'));

        $this->createPage = false;
    }
}
