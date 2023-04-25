<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Helpers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\Quill;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'createProduct',
        Quill::EVENT_VALUE_UPDATED,
    ];

    public $createProduct = false;

    public $product;

    public $image;

    public $gallery = [];

    public $options = [];

    public $uploadLink;

    public $description = null;

    public $width = 1000;

    public $height = 1000;

    public array $listsForFields = [];

    protected $rules = [
        'product.name'             => ['required', 'string', 'max:255'],
        'product.price'            => ['required', 'numeric', 'max:2147483647'],
        'product.old_price'        => ['required', 'numeric', 'max:2147483647'],
        'description'              => ['nullable'],
        'product.meta_title'       => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.meta_keywords'    => ['nullable', 'string', 'min:1'],
        'product.category_id'      => ['required', 'integer'],
        'product.subcategories'    => ['required', 'array', 'min:1'],
        'product.subcategories.*'  => ['integer', 'distinct:strict'],
        'options.*.type'           => ['required', 'string', 'in:color,size'],
        'options.*.value'          => ['required_if:options.*.type,color', 'string'],
        'product.brand_id'         => ['nullable', 'integer'],
        'product.embeded_video'    => ['nullable'],
        'product.condition'        => ['nullable'],
    ];

    public function quill_value_updated($value)
    {
        $this->description = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedProductSubcategories()
    {
        $this->product->subcategories()->sync($this->product->subcategories);
    }

    public function getImagePreviewProperty()
    {
        return $this->product->image;
    }

    public function getGalleryPreviewProperty()
    {
        return $this->product->gallery;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.product.create');
    }

    public function createProduct()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = new Product();

        $this->createProduct = true;
    }

    public function create()
    {
        $this->validate();

        $this->product->code = Str::slug($this->product->name, '-');

        $this->product->slug = Str::slug($this->product->name);

        if ($this->image) {
            $imageName = Helpers::handleUpload($this->image, $this->width, $this->height, $this->product->name);

            $this->product->image = $imageName;
        }

        if ($this->gallery) {
            $gallery = [];

            foreach ($this->gallery as $image) {
                $imageName = Str::slug($this->product->name).'.'.$image->extension();
                $image->storeAs('products', $imageName);
                $gallery[] = $imageName;
            }
            $this->product->gallery = json_encode($gallery);
        }

        $this->product->subcategories = $this->subcategories;
        $this->product->subcategories = $this->subcategories;

        $this->product->save();

        $this->alert('success', 'Product created successfully');

        $this->emit('refreshIndex');

        $this->createProduct = false;
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function getBrandsProperty()
    {
        return Brand::select('name', 'id')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::select('name', 'id')->get();
    }
}
