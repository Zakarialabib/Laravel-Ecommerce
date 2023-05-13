<?php

declare(strict_types=1);

namespace App\Http\Livewire\Language;

use Livewire\Component;
use App\Models\Language;
use Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    public $languages = [];

    public $language;

    public $deleteModal = false;
    
    protected $listeners = [
        'refreshIndex' => '$refresh',
        'delete'
    ];
    
    public function confirmed()
    {
        $this->emit('delete');
    }

    public function mount()
    {
        $this->languages = Language::all()->toArray();
    }

    public function render()
    {
        return view('livewire.language.index');
    }

    public function onSetDefault($id)
    {
        Language::where('is_default', '=', true)->update(['is_default' => false]);

        $this->language = Language::findOrFail($id);

        $this->language->is_default = true;

        $this->language->save();

        $this->alert('success', __('Language updated successfully!'));
    }

    public function sync($id)
    {
        $languages = Language::findOrFail($id);

        Artisan::call('translatable:export', ['lang' => $languages->code]);

        $this->alert('success', __('Translation updated successfully!'));
    }

    public function delete()
    {
        abort_if(Gate::denies('language_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        Language::findOrFail($this->section)->delete();

        $this->alert('warning', __('Language deleted successfully!'));
    }

    public function deleteModal($language)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->language = $language;
    }

}
