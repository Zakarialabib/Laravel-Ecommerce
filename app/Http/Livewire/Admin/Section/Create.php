<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use App\Models\Section;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Language;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $section;

    public $image;

    public $createSection = false;

    public $listeners = [
        'createSection',
    ];

    public array $rules = [
        'section.language_id' => ['required'],
        'section.page'        => ['required'],
        'section.title'       => ['nullable', 'string', 'max:255'],
        'section.subtitle'    => ['nullable', 'string', 'max:255'],
        'section.description' => ['nullable'],
        'section.video'       => ['nullable'],
    ];

    public function createSection()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createSection = true;
    }

    public function mount(Section $section)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('livewire.admin.section.create');
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
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

        $this->createSection = false;
    }
}
