<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\PageSetting;
use App\Http\Livewire\WithSorting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

class Settings extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithSorting;

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

    public $status;

    public $featured_banner_id;
    public $page_id;
    public $language_id;

    public $settings;

    public $createSettingsModal = false;
    public $showHeaderModal = false;
    public $showFooterModal = false;
    public $topHeaderModal = false;
    public $bottomFooterModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

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

    public function topHeaderModal()
    {
        $this->topHeaderModal = ! $this->topHeaderModal;
    }

    public function bottomFooterModal()
    {
        $this->bottomFooterModal = ! $this->bottomFooterModal;
    }

   
    public function updatePageSettings($id)
    {
        $this->settings = PageSettings::where('page_id', $id)->first();

        $this->validate([
            'settings.header'    => 'nullable|string',
            'settings.footer'    => 'nullable|string',
            'settings.bottomBar'    => 'nullable|string',
            'settings.topHeader'    => 'nullable|string',
            'settings.bottomFooter' => 'nullable|string',
            'settings.themeColor' => 'nullable|string',
            'settings.popularProducts' => 'nullable|string',
            'settings.flashDeal' => 'nullable|string',
            'settings.bestSellers' => 'nullable|string',
            'settings.topBrands' => 'nullable|string',
            'settings.status' => 'nullable|string',
            'settings.featured_banner_id' => 'nullable|string',
            'settings.page_id' => 'nullable|string',
            'settings.language_id' => 'nullable|string',
            
        ]);

        $this->settings->save();

        $this->alert('success', 'Settings updated successfully.');
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Pagesetting())->orderable;
    }

    public function render()
    {
        $query = Pagesetting::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $pagesettings = $query->paginate($this->perPage);

        return view('livewire.admin.page.settings', compact('pagesettings'));
    }
}
