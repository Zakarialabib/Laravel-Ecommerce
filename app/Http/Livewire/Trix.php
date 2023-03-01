<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Trix extends Component
{
    use WithFileUploads;

    public const EVENT_VALUE_UPDATED = 'onTrixValueUpdate';

    public $value;

    public $trixId;

    public $photos = [];

    public function mount($value = '')
    {
        $this->value = $value;
        $this->trixId = 'trix-'.uniqid();
    }

    public function updatedValue($value)
    {
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function completeUpload(string $uploadedUrl, string $trixUploadCompletedEvent)
    {
        foreach ($this->photos as $photo) {
            if ($photo->getFilename() === $uploadedUrl) {
                // store in the public/photos location
                $newFilename = $photo->store('public/photos');

                // get the public URL of the newly uploaded file
                $url = Storage::url($newFilename);

                $this->dispatchBrowserEvent($trixUploadCompletedEvent, [
                    'url' => $url,
                    'href' => $url,
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.trix');
    }
}
