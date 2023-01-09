<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Popup;

class Popups extends Component
{
    public bool $show;

    public $popup;

    public int $delay;

    public int $duration;

    public int $interval;

    public int $width;

    public string $backgroundColor;

    public string $content;

    public string $ctaText;

    public string $ctaUrl;

    public function mount()
    {
        $this->show = false;

        $this->listen('showDelay', function ($delay) {
            $this->delay = $delay;
            $this->show = true;
        });

        $this->listen('showDuration', function ($duration) {
            $this->duration = $duration;
            $this->show = true;
        });

        $this->listen('showInterval', function ($interval) {
            $this->interval = $interval;
            $this->show = true;
        });
    }

    public function render()
    {
        $popup = Popup::default(); // retrieve the default popup setting from the database

        $this->backgroundColor = $popup->background_color;
        $this->content = $popup->content;
        $this->ctaText = $popup->cta_text;
        $this->ctaUrl = $popup->cta_url;

        return view('front.popups');
    }

    public function hide()
    {
        $this->show = false;
    }
}
