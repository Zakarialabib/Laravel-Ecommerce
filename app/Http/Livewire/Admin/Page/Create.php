<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use LivewireAlert , WithFileUploads;

    public $createPage;
    
    public $image;

    public $listeners = ['createPage'];

    public function mount(Page $page)
    {
        $this->page = $page;
    }

    public array $rules = [
        'page.name' => ['required', 'string', 'max:255'],
        'page.link' => ['nullable', 'string'],
    ];

    public function render()
    {
        abort_if(Gate::denies('page_create'), 403);

        return view('livewire.admin.pages.create');
    }

    public function createPage()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createPage = true;
    }

    public function create()
    {
        $this->validate();

        if($this->image){
            $imageName = Str::slug($this->page->name) . '-' . date('Y-m-d H:i:s') . '.' . $this->image->extension();
            $this->image->storeAs('pages',$imageName);
            $this->page->image = $imageName;
        }

        $this->page->save();

        $this->emit('refreshIndex');
        
        $this->alert('success', 'Page created successfully.');
        
        $this->createPage = false;
    }
}
