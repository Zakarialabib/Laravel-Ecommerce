<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Language;

use App\Models\Language;
use Artisan;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\Concerns\SweetAlert2 as LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.dashboard')]
#[Title('Languages')]
class Index extends Component
{
    use LivewireAlert;

    public $language;

    protected $listeners = [
        'refreshIndex' => '$refresh',
    ];

    public function mount(): void
    {
        //
    }

    #[Computed]
    public function languages(): \Illuminate\Database\Eloquent\Collection
    {
        return Language::all();
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.language.index', [
            'languages' => $this->languages,
        ]);
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

    public function delete(Language $language)
    {
        $language->delete();

        $this->alert('warning', __('Language deleted successfully!'));
    }
}
