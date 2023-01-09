<?php

namespace App\Https\Livewire;

use Livewire\Component;
use App\Models\Popup;

class PopupSettings extends Component
{
    public $popups;

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
        'width'  => ['required', 'string', 'max:15'],
        'frequency'  => ['nullable', 'string'],
        'timing'  => ['nullable', 'string', 'max:255'],
        'delay'  => ['nullable', 'string'],
        'duration'  => ['nullable', 'string', 'max:255'],
        'backgroundColor'  => ['nullable', 'string','max:15'],
        'content'  => ['required', 'string'],
        'ctaText'  => ['required', 'string'],
        'ctaUrl'  => ['required', 'string'],
    ];

    public function setDefault($id)
    {
        Popup::where('is_default', '=', true)->update(['is_default' => false]);

        $this->popup = Popup::findOrFail($id);

        $this->popup->is_default = true;

        $this->popup->save();
    }


    public function popupModal($id, $popup = null)
    {
        $this->modalId = $id;
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
            session()->flash('message', 'Popup settings created successfully!');
    
            $this->popupModal = false;
        } catch (\Throwable $th) {

            // show error message
            session()->flash('message', 'Something unsual happend !?');
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
            session()->flash('message', __('Popup settings updated successfully!'));
    
            $this->popupModal = false;

        } catch (\Throwable $th) {
            // Show error message
            session()->flash('message', __('Something not working !'));
        }
       
    }

    public function render()
    {
        $popups = Popup::all();

        return view('admin.settings.popupsettings', compact('popups'));
    }
}
