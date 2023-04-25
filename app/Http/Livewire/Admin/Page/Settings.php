<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Pagesetting;

class Settings extends Component
{
    use LivewireAlert;

    public $header;
    public $footer;
    public $bottomBar;
    public $topHeader;
    public $bottomFooter;
    public $themeColor;
    public $popularProducts;
    public $flashDeal;
    public $bestSellers;
    public $topBrands;
    public $component;
    public $status;
    public $featured_banner_id;
    public $page_id;
    public $pageId;
    public $language_id;

    public $settings;
    public $topHeaderModal = false;

    public function toggleTopHeaderModal()
    {
        $this->topHeaderModal = ! $this->topHeaderModal;
    }

    public function toggleBottomFooterModal()
    {
        $this->bottomFooterModal = ! $this->bottomFooterModal;
    }

    public function mount()
    {
        $this->settings = Pagesetting::first();
    }

    public function updateSettings()
    {
        $this->validate([
            'settings.topheader'    => 'nullable|string',
            'settings.bottomfooter' => 'nullable|string',
        ]);

        $this->settings->update([
            'topheader'    => $this->settings->topheader,
            'bottomfooter' => $this->settings->bottomfooter,
        ]);

        $this->alert('success', 'Settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.page.settings');
    }
}
