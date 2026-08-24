<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use App\Http\Livewire\WithSorting;
use App\Models\Language;
use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\Concerns\SweetAlert2 as LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.dashboard')]
#[Title('Sliders')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;
    use AuthorizesRequests;

    public $slider;

    public $photo;

    public $showModal = false;

    public $deleteModal = false;


    #[Url]
    public string $search = '';




    #[Url]
    public int $perPage = 25;

    /** @var array<int, string> */
    public array $selected = [];

    /** @var array<int, string> */
    public array $paginationOptions = [25, 50, 100];

    protected $rules = [
        'slider.title' => ['required', 'string', 'max:255'],
        'slider.subtitle' => ['nullable', 'string'],
        'slider.details' => ['nullable'],
        'slider.link' => ['nullable', 'string'],
        'slider.language_id' => ['nullable', 'integer'],
        'slider.bg_color' => ['nullable', 'string'],
        'slider.embeded_video' => ['nullable'],
    ];

    public function mount(): void
    {
        $this->authorize('slider_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new Slider())->orderable;
    }

    #[Computed]
    public function sliders(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Slider::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ])->paginate($this->perPage);
    }

   #[Computed]
    public function selectedCount(): int
    {
        return count($this->selected);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

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
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('Cancel'),
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

    #[Computed]
    public function languages(): Collection
    {
        return Language::select('name', 'id')->get();
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.admin.slider.index', [
            'sliders' => $this->sliders,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
