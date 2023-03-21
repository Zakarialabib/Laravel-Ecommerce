<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use App\Models\Language;
use App\Models\Section;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

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
        'section.page' => ['required'],
        'section.title' => ['required', 'string', 'max:255'],
        'section.featured_title' => ['nullable', 'string', 'max:255'],
        'section.subtitle' => ['nullable', 'string', 'max:255'],
        'section.label' => ['nullable', 'string', 'max:255'],
        'section.description' => ['nullable'],
        'section.bg_color' => ['nullable'],
        'section.position' => ['nullable'],
        'section.link' => ['nullable'],
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

    public function render(): View|Factory
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
            $imageName = Str::slug($this->section->title).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('sections', $imageName);
            $this->section->image = $imageName;
        }

        $this->section->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Section created successfully!'));

        $this->createSection = false;
    }
}
