<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use App\Http\Livewire\WithSorting;
use App\Models\Popup;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class PopupSettings extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithSorting;

    public $popup;

    public $popupModal = false;

    public $width;

    public $frequency;

    public $timing;

    public $delay;

    public $duration;

    public $backgroundColor;

    public $content;

    public $ctaText;

    public $ctaUrl;

    public array $rules = [
        'width' => ['required', 'string', 'max:15'],
        'frequency' => ['nullable', 'string'],
        'timing' => ['nullable', 'string', 'max:255'],
        'delay' => ['nullable', 'string'],
        'duration' => ['nullable', 'string', 'max:255'],
        'backgroundColor' => ['nullable', 'string', 'max:15'],
        'content' => ['required', 'string'],
        'ctaText' => ['required', 'string'],
        'ctaUrl' => ['required', 'string'],
    ];

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function setDefault($id)
    {
        Popup::where('is_default', '=', true)->update(['is_default' => false]);

        $this->popup = Popup::findOrFail($id);

        $this->popup->is_default = true;

        $this->popup->save();
    }

    public function popupModal($popup = null)
    {
        $this->popup = $popup;
        $this->popupModal = true;
    }

    public function create()
    {
        try {
            // save new popup
            $this->popup = Popup::create([
                'width' => $this->width,
                'frequency' => $this->frequency,
                'timing' => $this->timing,
                'delay' => $this->delay,
                'duration' => $this->duration,
                'backgroundColor' => $this->backgroundColor,
                'content' => $this->content,
                'ctaText' => $this->ctaText,
                'ctaUrl' => $this->ctaUrl,
            ]);

            // show succes message
            $this->alert§('succes', __('Popup settings created successfully !'));

            $this->popupModal = false;
        } catch (Throwable $th) {
            // show error message
            $this->alert§('warning', __('Something not working !'));
        }
    }

    public function update($popup)
    {
        $this->popup = Popup::find($popup->id); // retrieve the popup setting from the database

        try {
            $this->width = $this->popup->width;
            $this->frequency = $this->popup->frequency;
            $this->timing = $this->popup->timing;
            $this->delay = $this->popup->delay;
            $this->duration = $this->popup->duration;
            $this->backgroundColor = $this->popup->background_color;
            $this->content = $this->popup->content;
            $this->ctaText = $this->popup->cta_text;
            $this->ctaUrl = $this->popup->cta_url;

            $this->popup->save();

            // Emit an event based on the chosen timing option, passing along the corresponding delay/interval/duration value as an argument

            match ($this->timing) {
                'delay' => $this->emit('showDelay', $this->delay),
                'duration' => $this->emit('showDuration', $this->duration),
                'interval' => $this->emit('showInterval', $this->interval),
            };

            // Show success message
            $this->alert§('succes', __('Popup settings updated successfully!'));

            $this->popupModal = false;
        } catch (Throwable $th) {
            // Show error message
            $this->alert§('warning', __('Something not working !'));
        }
    }

    public function render()
    {
        $popups = Popup::all();

        return view('livewire.admin.settings.popup-settings', compact('popups'));
    }
}
