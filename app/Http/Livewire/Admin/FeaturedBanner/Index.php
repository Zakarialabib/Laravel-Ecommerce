<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\FeaturedBanner;

use App\Http\Livewire\WithSorting;
use App\Models\FeaturedBanner;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $featuredbanner;

    public $image;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'editModal', 'delete',
    ];

    public $showModal = false;

    public $refreshIndex;

    public $editModal = false;

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

    protected $rules = [
        'featuredbanner.title' => ['required', 'string', 'max:255'],
        'featuredbanner.details' => ['nullable', 'string'],
        'featuredbanner.link' => ['nullable', 'string'],
        'featuredbanner.product_id' => ['nullable', 'integer'],
        'featuredbanner.language_id' => ['nullable', 'integer'],
        'featuredbanner.embeded_video' => ['nullable'],
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

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new FeaturedBanner())->orderable;
        $this->initListsForFields();
    }

    public function render(): View|Factory
    {
        $query = FeaturedBanner::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $featuredbanners = $query->paginate($this->perPage);

        return view('livewire.admin.featured-banner.index', compact('featuredbanners'));
    }

    public function setFeatured($id)
    {
        FeaturedBanner::where('featured', '=', true)->update(['featured' => false]);
        $featuredbanner = FeaturedBanner::findOrFail($id);
        $featuredbanner->featured = true;
        $featuredbanner->save();

        $this->alert('success', __('Featuredbanner featured successfully!'));
    }

    public function editModal(FeaturedBanner $featuredbanner)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->featuredbanner = $featuredbanner;

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();
        // if product selected Helpers::productLink($product)

        if ($this->image) {
            $imageName = Str::slug($this->featuredbanner->title).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('featuredbanners', $imageName);
            $this->featuredbanner->image = $imageName;
        }

        $this->featuredbanner->save();

        $this->alert('success', __('FeaturedBanner updated successfully.'));

        $this->editModal = false;
    }

    public function showModal(FeaturedBanner $featuredbanner)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->featuredbanner = $featuredbanner;

        $this->showModal = true;
    }

    public function delete(FeaturedBanner $featuredbanner)
    {
        $featuredbanner->delete();

        $this->alert('success', __('FeaturedBanner deleted successfully.'));
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
        $this->listsForFields['products'] = Product::pluck('name', 'id')->toArray();
    }
}
