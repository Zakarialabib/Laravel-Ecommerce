<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Language;
use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

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

    public array $rules = [
        'slider.title' => ['required', 'string', 'max:255'],
        'slider.subtitle' => ['nullable', 'string'],
        'slider.details' => ['nullable', 'string'],
        'slider.link' => ['nullable', 'string'],
        'slider.language_id' => ['nullable'],
        'slider.bg_color' => ['nullable'],
        'slider.embeded_video' => ['nullable'],
        'photo' => ['required'],
    ];

    public function mount(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('slider_create'), 403);

        return view('livewire.admin.slider.create');
    }

    public function createSlider()
    {
        $this->reset();

        $this->createSlider = true;
    }

    public function create()
    {
        try {
            $this->validate();

            if ($this->photo) {
                $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->photo->extension();

                $img = Image::make($this->photo->getRealPath())->encode('webp', 85);

                $img->stream();

                Storage::disk('local_files')->put('sliders/'.$imageName, $img, 'public');

                $this->slider->photo = $imageName;
            }

            $this->slider->save();

            $this->alert('success', __('Slider created successfully.'));

            $this->emit('refreshIndex');

            $this->createSlider = false;
        } catch (Throwable $th) {
            $this->alert('warning', __('An error happend Slider was not created.'));
        }
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }
}
