<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use LivewireAlert , WithFileUploads;

    public $createSlider;
    
    public $image;

    public $listeners = ['createSlider'];

    public function mount(Slider $slider)
    {
        $this->slider = $slider;
    }

    public array $rules = [
        'slider.title' => ['required', 'string', 'max:255'],
        'slider.subtitle' => ['nullable', 'string'],
        'slider.details' => ['nullable', 'string'],
        'slider.position' => ['nullable', 'string'],
        'slider.link' => ['nullable', 'string'],
        'slider.language_id' => ['nullable', 'string'],
        'slider.bg_color' => ['nullable', 'string'],
    ];

    public function render()
    {
        abort_if(Gate::denies('slider_create'), 403);

        return view('livewire.sliders.create');
    }

    public function createSlider()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createSlider = true;
    }

    public function create()
    {
        $this->validate();

        if($this->image){
            $imageName = Str::slug($this->slider->name).'.'.$this->image->extension();
            $this->image->storeAs('sliders',$imageName);
            $this->slider->image = $imageName;
        }

        $this->slider->save();

        $this->emit('refreshIndex');
        
        $this->alert('success', 'Slider created successfully.');
        
        $this->createSlider = false;
    }


}
