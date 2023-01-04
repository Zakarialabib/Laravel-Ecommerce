<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

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

    public $createSlider = false;

    public $slider;

    public $photo;

    public $listeners = [
        'createSlider',
    ];

    public array $listsForFields = [];

    public function mount()
    {
        $this->initListsForFields();
    }

    public array $rules = [
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string'],
        'slider.details'       => ['nullable', 'string'],
        'slider.link'          => ['nullable', 'string'],
        'slider.language_id'   => ['nullable'],
        'slider.bg_color'      => ['nullable'],
        'slider.embeded_video' => ['nullable'],
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('slider_create'), 403);

        return view('livewire.admin.slider.create');
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

        if ($this->photo) {
            $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->photo->extension();
            $this->photo->storeAs('sliders', $imageName);
            $this->slider->photo = $imageName;
        }

        $this->slider->save();

        $this->alert('success', __('Slider created successfully.'));

        $this->emit('refreshIndex');

        $this->createSlider = false;
    }

    public function initListsForFields()
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
