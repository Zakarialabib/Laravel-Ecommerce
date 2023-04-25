<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal'
    ];
    
    public $editModal = false;
    
    public $slider;

    public function editModal(Slider $slider)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = $slider;

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->photo) {
            $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->photo->extension();

            $img = Image::make($this->photo->getRealPath())->encode('webp', 85);

            $img->stream();

            Storage::disk('local_files')->put('sliders/'.$imageName, $img, 'public');

            $this->slider->photo = $imageName;
        }

        $this->slider->save();

        $this->alert('success', __('Slider updated successfully.'));

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.slider.edit');
    }
}
