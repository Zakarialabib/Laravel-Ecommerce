<?php

namespace App\Http\Livewire\Admin\Section;

use Livewire\WithFileUploads;
use App\Models\Section;
use App\Models\Language;
use Livewire\Component;
use Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    
    public Section $section;
    
    public $image;

    protected $listeners = [
        'submit',
    ];
    
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
    }

    public function render()
    {
        return view('livewire.admin.section.edit');
    }

    public function submit()
    {
        $this->validate();
        
        if($this->image){
            $imageName = Str::slug($this->section->title).'.'.$this->image->extension();
            $this->image->storeAs('sections',$imageName);
            $this->section->image = $imageName;
        }

        $this->section->save();

        $this->alert('success', __('Section updated successfully!') );

        return redirect()->route('admin.sections');
    }
  
}
