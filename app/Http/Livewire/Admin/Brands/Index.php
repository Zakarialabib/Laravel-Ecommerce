<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

use App\Http\Livewire\WithSorting;
use App\Imports\BrandsImport;
use App\Models\Brand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $brand;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'importModal',
    ];

    public $deleteModal = false;

    public $showModal = false;

    public $importModal = false;
    
    public int $perPage;
    
    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $rules = [
        'brand.name'        => ['required', 'string', 'max:255'],
        'brand.slug'        => ['required', 'string'],
        'brand.description' => ['nullable', 'string'],
    ];

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

    public function getImagePreviewProperty()
    {
        return $this->brand?->image;
    }

    public function getFeaturedImagePreviewProperty()
    {
        return $this->brand?->featured_image;
    }

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
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Brand())->orderable;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('brand_access'), 403);

        $query = Brand::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $brands = $query->paginate($this->perPage);

        return view('livewire.admin.brands.index', compact('brands'));
    }

    public function showModal(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->brand = $brand;

        $this->showModal = true;
    }

    public function deleteModal($brand)
    {
        $this->confirm('Are you sure you want to delete this?', [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => 'Cancel',
            'onConfirmed'       => 'delete',
            'params'            => [$brand->id],
        ]);
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('brand_delete'), 403);

        Brand::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete($id)
    {
        abort_if(Gate::denies('brand_delete'), 403);

        Brand::findOrFail($id)->delete();

        $this->alert('success', 'Brand deleted successfully.');
    }

    public function importModal()
    {
        // abort_if(Gate::denies('brand_create'), 403);

        $this->importModal = true;
    }

    public function import()
    {
        // abort_if(Gate::denies('brand_create'), 403);

        $this->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new BrandsImport(), $this->file);

        $this->alert('success', 'Brand imported successfully.');
    }
}
