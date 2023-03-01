<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Popup;
use Livewire\Component;

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

    protected $listeners = ['showDelay','showDuration','showInterval'];

    public function showDelay($delay)
    {
        $this->delay = $delay;
        $this->show = true;
    }

    public function showDuration($duration)
    {
        $this->duration = $duration;
        $this->show = true;
    }

    public function showInterval($interval)
    {
        $this->interval = $interval;
        $this->show = true;
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
