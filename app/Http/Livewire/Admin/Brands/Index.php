<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;
use App\Http\Livewire\WithSorting;

use App\Imports\BrandsImport;
use App\Models\Brand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.dashboard')]
#[Title('Brands')]
class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithFileUploads;
    use AuthorizesRequests;

    #[Url]
    public string $search = '';

    #[Url]
    public int $perPage = 25;

    /** @var array<int, string> */
    public array $paginationOptions = [25, 50, 100];

    /** @var array<int, string> */
    public array $selected = [];

    public $brand;

    public $showModal = false;

    public $importModal = false;

    public $file;

    public function mount(): void
    {
        $this->authorize('brands_access');
    }

    #[Computed]
    public function orderable(): array
    {
        return (new Brand())->orderable;
    }

    #[Computed]
    public function brands(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Brand::advancedFilter([
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
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('Cancel'),
            'onConfirmed' => 'delete',
        ]);
        $this->brand = $brand;
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('brand_delete'), 403);

        Brand::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete()
    {
        abort_if(Gate::denies('brand_delete'), 403);

        Brand::findOrFail($this->brand)->delete();

        $this->alert('success', __('Brand deleted successfully.'));
    }

    public function importModal()
    {
        $this->importModal = true;
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new BrandsImport(), $this->file);

        $this->alert('success', __('Brand imported successfully.'));
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.brands.index', [
            'brands' => $this->brands,
            'paginationOptions' => $this->paginationOptions,
        ]);
    }
}
