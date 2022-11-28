<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public $listeners = [
        'trix:valueUpdated' => 'onTrixValueUpdate',
        'createProduct'
    ];

    public $createProduct;

    public $image;

    public $gallery = [];

    public $uploadLink;
    
    public array $listsForFields = [];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function onTrixValueUpdate($value)
    {
        $this->description = $value;
    }

    protected $rules = [
        'product.name' => ['required', 'string', 'max:255'],
        'product.price' => ['required', 'numeric', 'max:2147483647'],
        'product.old_price' => ['required', 'numeric', 'max:2147483647'],
        'product.description' => ['nullable'],
        'product.meta_title' => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.meta_keywords' => ['nullable', 'string', 'min:1'],
        'product.category_id' => ['required', 'integer'],
        'product.subcategory_id' => ['required', 'integer'],
        'product.brand_id' => ['required', 'integer'],
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.admin.product.create');
    }

    public function createProduct()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createProduct = true;
    }

    // make image upload from url
    public function uploadImage()
    {
        $this->validate([
            'uploadLink' => 'required|url',
        ]);

        $image = file_get_contents($this->uploadLink);
        $name = Str::random(10).'.jpg';
        $path = public_path().'/images/products/'.$name;
        file_put_contents($path, $image);
        $this->product->image = $name;
        $this->product->save();
        $this->alert('success', 'Image Uploaded Successfully');
    }

    // make gallery upload from url
    public function uploadGallery()
    {
        $this->validate([
            'uploadLink' => 'required|url',
        ]);

        $image = file_get_contents($this->uploadLink);
        $name = Str::random(10).'.jpg';
        $path = public_path().'/images/products/'.$name;
        file_put_contents($path, $image);
        $this->gallery[] = $name;
        $this->alert('success', 'Image Uploaded Successfully');
    }

    public function create()
    {
        $this->validate();

        // generate code
        $this->product->code = Str::slug($this->product->name, '-');
        // generate slug from name slug
        $this->product->slug = Str::slug($this->product->name);

        // check image, resize (1500x1500), add watermark (logo) and upload

        if ($this->image) {
            $imageName = Str::slug($this->product->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();

            $imageName = Image::make($this->image)->resize(1500, 1500, function ($constraint) {
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

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['brands'] = Brand::pluck('name', 'id')->toArray();
        $this->listsForFields['subcategories'] = Subcategory::pluck('name', 'id')->toArray();
    }
}
