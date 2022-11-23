<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Pagesetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Page extends Component
{
    use LivewireAlert;

    public function homeupdate()
    {
        $data = Pagesetting::findOrFail(1);
        $input = $this->all();

        if ($this->category == '') {
            $input['category'] = 0;
        }
        if ($this->our_services == '') {
            $input['our_services'] = 0;
        }
        if ($this->blog == '') {
            $input['blog'] = 0;
        }
        if ($this->popular_products == '') {
            $input['popular_products'] = 0;
        }
        if ($this->third_left_banner == '') {
            $input['third_left_banner'] = 0;
        }
        if ($this->slider == '') {
            $input['slider'] = 0;
        }
        if ($this->flash_deal == '') {
            $input['flash_deal'] = 0;
        }
        if ($this->deal_of_the_day == '') {
            $input['deal_of_the_day'] = 0;
        }
        if ($this->best_sellers == '') {
            $input['best_sellers'] = 0;
        }
        if ($this->partner == '') {
            $input['partner'] = 0;
        }
        if ($this->top_big_trending == '') {
            $input['top_big_trending'] = 0;
        }
        if ($this->top_brand == '') {
            $input['top_brand'] = 0;
        }

        $data->update($input);

        cache()->forget('pagesettings');
    }

    public function menuupdate()
    {
        $data = Pagesetting::findOrFail(1);
        $input = $this->all();

        if ($this->home == '') {
            $input['home'] = 0;
        }
        if ($this->blog == '') {
            $input['blog'] = 0;
        }
        if ($this->faq == '') {
            $input['faq'] = 0;
        }
        if ($this->contact == '') {
            $input['contact'] = 0;
        }
        $data->update($input);
        cache()->forget('pagesettings');
    }

    public function render()
    {
        return view('livewire.admin.settings.page');
    }
}
