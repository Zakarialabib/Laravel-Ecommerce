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

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal;

    public $page;

    public $image;

    public $listeners = ['editModal'];

    public array $rules = [
        'page.title' => ['required', 'string', 'max:255'],
        'page.slug' => ['required', 'unique:pages', 'max:255'],
        'page.details' => ['required'],
        'page.meta_title' => ['nullable|max:255'],
        'page.meta_description' => ['nullable|max:255'],
        'page.language_id' => ['nullable|integer'],
    ];

    public function mount(Page $page)
    {
        $this->page = $page;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('page_edit'), 403);

        return view('livewire.admin.page.edit');
    }

    public function editModal($id)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->page = Page::where('id', $id)->firstOrFail();

        $this->editModal = true;
    }

    public function update()
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

        $this->alert('success', __('Page updated successfully.'));

        $this->editModal = false;
    }
}
