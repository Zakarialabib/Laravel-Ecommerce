<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use App\Http\Livewire\WithSorting;
use App\Models\Language;
use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
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

    public $slider;

    public $photo;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'delete',
    ];

    public $showModal = false;

    public $refreshIndex;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $deleteModal = false;

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
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string'],
        'slider.details'       => ['nullable'],
        'slider.link'          => ['nullable', 'string'],
        'slider.language_id'   => ['nullable', 'integer'],
        'slider.bg_color'      => ['nullable', 'string'],
        'slider.embeded_video' => ['nullable'],
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

    public function confirmed()
    {
        $this->emit('delete');
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Slider())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Slider::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $sliders = $query->paginate($this->perPage);

        return view('livewire.admin.slider.index', compact('sliders'));
    }

    // public function getPhotoPreviewProperty()
    // {
    //     return $this->slider->photo;
    // }

    public function setFeatured($id)
    {
        Slider::where('featured', '=', true)->update(['featured' => false]);
        $slider = Slider::findOrFail($id);
        $slider->featured = true;
        $slider->save();

        $this->alert('success', __('Slider featured successfully!'));
    }

    public function showModal(Slider $slider)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = $slider;

        $this->showModal = true;
    }

    public function deleteModal($slider)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->slider = $slider;
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('slider_delete'), 403);

        Slider::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete()
    {
        abort_if(Gate::denies('slider_delete'), 403);

        Slider::findOrFail($this->slider)->delete();

        $this->alert('success', __('Slider deleted successfully.'));
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }
}
