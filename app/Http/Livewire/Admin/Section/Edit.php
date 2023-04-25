<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Throwable;
use App\Models\Section;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal'
    ];
    
    public $editModal = false;

    public $section;

    public function editModal($section)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->section = Section::findOrFail($section);

        $this->editModal = true;
    }

    public function update()
    {
        try {
            $this->validate();

            if ($this->image) {
                $imageName = Str::slug($this->section->title).'-'.Str::random(3).'.'.$this->image->extension();
                $this->image->storeAs('sections', $imageName);
                $this->section->image = $imageName;
            }

            $this->section->save();

            $this->alert('success', __('Section updated successfully!'));

            $this->editModal = false;
        } catch (Throwable $th) {
            $this->alert('warning', __('Section was not updated!'));
        }
    }

    public function render(): View
    {
        return view('livewire.admin.section.edit');
    }
}
