<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $name = 'image'; // The name attribute of the file input
    public $multiple = false; // Whether to allow multiple file uploads
    public $gallery = []; // An array to hold the uploaded images
    public $image; // A single uploaded image

    public function updatedGallery($gallery)
    {
        $this->emit('galleryUpdated', $this->gallery);
    }

    public function removeImage($index)
    {
        unset($this->gallery[$index]);
        $this->gallery = array_values($this->gallery); // Reset array keys
    }

    public function save()
    {
        $this->validate([
            $this->name => $this->multiple ? 'array' : 'image|max:1024', // Customize validation rules as needed
        ]);

        if ($this->multiple) {
            foreach ($this->gallery as $index => $image) {
                $this->gallery[$index] = $image->store('images'); // Customize storage location as needed
            }
        } else {
            $this->image = $this->image->store('images'); // Customize storage location as needed
        }

        $this->emit('imagesUploaded');
    }

    public function render()
    {
        return view('livewire.image-upload');
    }
}
