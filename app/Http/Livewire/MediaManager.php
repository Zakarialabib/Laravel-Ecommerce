<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

/**
 * @property string $disk
 * @property string $previewFile
 * @property array $tabOptions
 */
class MediaManager extends Component
{
    use WithFileUploads;

    public string $tab = 'upload';

    public TemporaryUploadedFile|string|null $file = null;

    public array $metadata = [];

    public ?string $childComponentId = null;

    public array $childComponentData = [];

    public bool $handleUploadProcess = true;

    public $mediamanager;

    protected $listeners = [
        'mediamanager',
        'media-manager:show' => 'showMediaManager',
        'media-manager:file-removed' => 'handleFieRemoved',
        'unsplash:selected' => 'handleUnsplashSelected',
    ];

    public function mount(bool $handleUploadProcess = true)
    {
        $this->handleUploadProcess = $handleUploadProcess;
    }

    public function updatedFile($value)
    {
        if ($value instanceof TemporaryUploadedFile) {
            $this->whenFails(fn () => $this->reset('file'))->validate([
                'file' => [
                    'mimes:jpeg,jpg,png,gif,svg,webp',
                    'max: 5000',
                ],
            ]);
        }
    }

    public function showMediaManager($data)
    {
        $this->childComponentId = Arr::get($data, 'id');
        $this->file = Arr::get($data, 'file');
        $this->metadata = Arr::get($data, 'metadata');

        $this->mediamanager = true;
    }

    public function setTab(string $tab)
    {
        if ($this->tab === $tab) {
            return;
        }

        $this->tab = $tab;

        $this->reset('childComponentData');
    }

    public function resetFile()
    {
        $this->reset('file', 'metadata');

        $this->emitTo(
            $this->getChildComponentNameByCurrentTab(),
            'media-manager:back',
            $this->childComponentData
        );
    }

    public function selectFile()
    {
        if ($this->file instanceof TemporaryUploadedFile && $this->handleUploadProcess) {
            $filePath = $this->file->storeAs(
                'uploads',
                $this->resolveUploadFilename($this->file->getClientOriginalName(), $this->file->extension()),
                $this->disk
            );

            $this->file = Storage::disk($this->disk)->url($filePath);
        } else {
            $this->file = is_string($this->file) ? $this->file : $this->file->temporaryUrl();
        }

        $this->dispatchBrowserEvent('media-manager:file-selected', [
            'id' => $this->childComponentId,
            'url' => $this->file,
            'path' => $filePath ?? $this->file,
            'metadata' => $this->metadata,
        ]);

        $this->closeModal('media-manager');
    }

    public function handleFieRemoved()
    {
        $this->reset('file', 'metadata', 'childComponentData');
    }

    public function handleUnsplashSelected($data)
    {
        $this->childComponentData = $data;
        $this->file = $data['url'];
        $this->metadata = [
            'alt' => $data['alt'],
            'caption' => $data['caption'],
        ];
    }

    public function getPreviewFileProperty()
    {
        return $this->file instanceof TemporaryUploadedFile
            ? $this->file->temporaryUrl()
            : $this->file;
    }

    public function getDiskProperty()
    {
        //  storage disk public
        Storage::disk('public');
    }

    public function getTabOptionsProperty()
    {
        return [
            'upload' => 'Upload',
            'unsplash' => 'Unsplash',
            'from-url' => 'From URL',
        ];
    }

    private function getChildComponentNameByCurrentTab(): string
    {
        return $this->tab;
    }

    private function resolveUploadFilename(string $originalFilename, string $extension): string
    {
        $extension = Str::start($extension, '.');

        return str_replace($extension, '', $originalFilename).'-'.time().$extension;
    }

    public function render()
    {
        return view('livewire.media-manager');
    }
}
