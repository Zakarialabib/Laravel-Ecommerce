<?php

namespace App\Http\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Slider;
use App\Models\Language;
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
    
    public $slider;
    public $photo;
    
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
        'slider.title' => ['required', 'string', 'max:255'],
        'slider.subtitle' => ['nullable', 'string'],
        'slider.details' => ['nullable', 'string'],
        'slider.link' => ['nullable', 'string'],
        'slider.language_id' => ['nullable', 'integer'],
        'slider.bg_color' => ['nullable', 'string'],
    ];

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Slider())->orderable;
        $this->initListsForFields();
    }

    public function render()
    {
        
        $query = Slider::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $sliders = $query->paginate($this->perPage);

        return view('livewire.admin.slider.index', compact('sliders'));
    }

    public function setFeatured($id)
    {

        Slider::where('featured', '=', true)->update( ['featured' => false] );
        $slider = Slider::findOrFail($id);
        $slider->featured    = true;
        $slider->save();

        $this->alert('success', __('Slider featured successfully!') );
        $this->refreshIndex();

    }

    public function editModal(Slider $slider)
    {
        

        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = $slider;

        $this->editModal = true;
    }
   
    public function update()
    {
     

        $this->validate();
        // upload image if it does or doesn't exist

        if($this->photo){
            $imageName = Str::slug($this->slider->title).'.'.$this->photo->extension();
            $this->photo->storeAs('sliders',$imageName);
            $this->slider->photo = $imageName;
        }

        $this->slider->save();

        $this->refreshIndex();

        $this->alert('success', __('Slider updated successfully.'));
        
        $this->editModal = false;
    }

    public function showModal(Slider $slider)
    {
        

        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = $slider;

        $this->showModal = true;
    }

    public function delete(Slider $slider)
    {
        
        $slider->delete();

        $this->alert('success', __('Slider deleted successfully.'));

    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }    

}