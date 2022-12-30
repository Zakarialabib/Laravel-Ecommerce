<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class MediaUpload extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $title;

    public $name;

    public $types;

    public $fileTypes;

    public $photos = [];

    public $oldPhotos = [];

    public $image = true;

    public $multiple = true;

    public $onPhotosSelected;

    public $emitFunction;

    public $preview = [];

    public $max = 3;

    protected function getListeners()
    {
        return [
            $this->onPhotosSelected => 'photoSelectionChanged',
        ];
    }

    public function render()
    {
        return view('livewire.media-upload');
    }

    public function removePhoto($key)
    {
        unset($this->photos[$key]);
        $this->photos = array_values($this->photos);
        $this->photoSelectionChanged();
    }

    public function hydrate()
    {

        $this->oldPhotos = $this->photos;
    }

    public function updatedPhotos($value)
    {
        $this->photos = array_merge($this->oldPhotos, $this->photos);

        if (count($this->photos) > $this->max) {
            $this->alert('warning', __('Maximum of').' '.$this->max.' '.__('is allowed'));

            $this->photos = array_slice($this->photos, 0, $this->max);
        }

        $this->photoSelectionChanged();
    }

    public function photoSelectionChanged()
    {
        $photoPaths = [];

        if ($this->multiple) {
            foreach ($this->photos as $photo) {
                $photoPath = $photo->getRealPath();
                array_push($photoPaths, $photoPath);
            }
        } else {
            $photoPaths = $this->photos->getRealPath();
        }
        $this->emitUp($this->emitFunction, $photoPaths);
    }
}
