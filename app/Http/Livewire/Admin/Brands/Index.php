<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

use App\Http\Livewire\WithSorting;
use App\Imports\BrandsImport;
use App\Models\Brand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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
        'refreshIndex' => '$refresh', 'delete',
        'showModal', 'editModal', 'importModal',
    ];

    public int $perPage;

    public $show;

    public $image;

    public $featured_image;

    public $showModal = false;

    public $refreshIndex;

    public $importModal;

    public $editModal = false;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $rules = [
        'brand.name' => ['required', 'string', 'max:255'],
        'brand.slug' => ['required', 'string'],
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
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $brands = $query->paginate($this->perPage);

        return view('livewire.admin.brands.index', compact('brands'));
    }

    public function editModal($brand)
    {
        abort_if(Gate::denies('brand_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->brand = Brand::findOrfail($brand);

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('brand_update'), 403);

        $this->validate();
        // upload image if it does or doesn't exist

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->brand->name).'-'.Str::random(5).'.'.$this->image->extension();
            $width = 500;
            $height = 500;

            $img = Image::make($this->image->getRealPath())->encode('webp', 85);

            // we need to resize image, otherwise it will be cropped
            if ($img->width() > $width) {
                $img->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if ($img->height() > $height) {
                $img->resize(null, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $img->resizeCanvas($width, $height, 'center', false, '#ffffff');

            $img->stream();

            Storage::disk('local_files')->put('brands/'.$imageName, $img, 'public');

            $this->brand->image = $imageName;
        }

        if ($this->featured_image) {
            $imageName = Str::slug($this->brand->name).'-'.date('Y-m-d H:i:s').'.'.$this->featured_image->extension();
            $this->featured_image->storeAs('brands', $imageName);
            $this->brand->featured_image = $imageName;
        }

        $this->brand->save();

        $this->alert('success', __('Brand updated successfully.'));

        $this->resetErrorBag();

        $this->resetValidation();

        $this->editModal = false;
    }

    public function showModal(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->brand = $brand;

        $this->showModal = true;
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('brand_delete'), 403);

        Brand::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Brand $brand)
    {
        abort_if(Gate::denies('brand_delete'), 403);

        $brand->delete();

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
