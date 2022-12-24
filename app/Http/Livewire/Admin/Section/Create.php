<?php

namespace App\Http\Livewire\Admin\Section;

use App\Models\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public $section;

    public $image;

    public $createSlider = false;

    public $listeners = ['createSlider'];

    public array $listsForFields = [];

    protected $rules = [
        'section.language_id' => 'required',
        'section.page' => 'required',
        'section.title' => 'nullable',
        'section.subtitle' => 'nullable',
        'section.custom_html_1' => 'nullable',
        'section.content' => 'nullable',
        'section.video' => 'nullable',
    ];

    public function mount(Section $section)
    {
        $this->section = $section;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.admin.section.create');
    }

    public function initListsForFields()
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }

    public function save()
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->section->title).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('sections', $imageName);
            $this->section->image = $imageName;
        }

        $this->section->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Section created successfully!'));

        $this->createSlider = false;
    }
}
