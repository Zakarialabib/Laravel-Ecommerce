<?php

namespace App\Http\Livewire\Admin\FeaturedBanner;

use Livewire\Component;
use App\Models\FeaturedBanner;
use App\Models\Language;
use App\Models\Product;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Gate;
use Str;

class Index extends Component
{
    use WithPagination, WithSorting,
        LivewireAlert, WithFileUploads;
    
    public $featuredbanner;

    public $image;
    
    public $listeners = [
        'confirmDelete', 'delete','refreshIndex',
        'showModal','editModal'
    ];

    public $showModal;

    public $refreshIndex;

    public $editModal; 

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

    public function refreshIndex()
    {
        $this->resetPage();
    }

    protected $rules = [
        'featuredbanner.title' => ['required', 'string', 'max:255'],
        'featuredbanner.details' => ['nullable', 'string'],
        'featuredbanner.link' => ['nullable', 'string'],
        'featuredbanner.product_id' => ['nullable', 'integer'],
        'featuredbanner.language_id' => ['nullable', 'integer'],
    ];

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new FeaturedBanner())->orderable;
        $this->initListsForFields();
    }

    public function render()
    {
        
        $query = FeaturedBanner::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $featuredbanners = $query->paginate($this->perPage);

        return view('livewire.admin.featured-banner.index', compact('featuredbanners'));
    }

    
    public function setFeatured($id)
    {

        FeaturedBanner::where('featured', '=', true)->update( ['featured' => false] );
        $featuredbanner = FeaturedBanner::findOrFail($id);
        $featuredbanner->featured    = true;
        $featuredbanner->save();

        $this->alert('success', __('Featuredbanner featured successfully!') );
        $this->refreshIndex();

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

        if($this->image){
            $imageName = Str::slug($this->featuredbanner->title).'.'.$this->image->extension();
            $this->image->storeAs('featuredbanners',$imageName);
            $this->featuredbanner->image = $imageName;
        }

        $this->featuredbanner->save();

        $this->refreshIndex();

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
        $this->listsForFields['products'] = Product::pluck('name','id')->toArray();
    }    

}