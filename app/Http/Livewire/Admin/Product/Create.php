<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Http\Livewire\Trix;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED,
        'createProduct',
    ];

    public $createProduct = false;

    public $product;

    public $image;

    public $gallery = [];

    public $uploadLink;

    public $description = null;

    public array $listsForFields = [];

    protected $rules = [
        'product.name' => ['required', 'string', 'max:255'],
        'product.price' => ['required', 'numeric', 'max:2147483647'],
        'product.old_price' => ['required', 'numeric', 'max:2147483647'],
        'description' => ['nullable'],
        'product.meta_title' => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.meta_keywords' => ['nullable', 'string', 'min:1'],
        'product.category_id' => ['required', 'integer'],
        'product.subcategory_id' => ['required'],
        'product.brand_id' => ['nullable', 'integer'],
        'product.embeded_video' => ['nullable'],
        'product.condition' => ['nullable'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function onTrixValueUpdate($value)
    {
        $this->description = $value;
    }

    public function mount(Product $product)
    {
        $this->product = $product;
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

        $this->createProduct = true;
    }

    public function create()
    {
        $this->validate();

        // generate code
        $this->product->code = Str::slug($this->product->name, '-');
        // generate slug from name slug
        $this->product->slug = Str::slug($this->product->name);

        if ($this->image) {
            $imageName = Str::slug($this->product->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();

            $imageName = Image::make($this->image)->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio();
            });

            $this->image->storeAs('products', $imageName);

            $this->product->image = $imageName;
        }
        // gallery
        if ($this->gallery) {
            $gallery = [];

            foreach ($this->gallery as $image) {
                $imageName = Str::slug($this->product->name).'.'.$image->extension();
                $image->storeAs('products', $imageName);
                $gallery[] = $imageName;
            }
            $this->product->gallery = json_encode($gallery);
        }

        if ($this->product->save()) {
            $this->product->save();
            $this->alert('success', 'Product created successfully');

            $this->emit('refreshIndex');

            $this->createProduct = false;
        } else {
            $this->alert('error', __('Something went wrong'));
        }
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
