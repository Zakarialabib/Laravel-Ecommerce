<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Http\Livewire\Trix;
use Image;
use Storage;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads, LivewireAlert;

    public $product;
    
    public $editModal = false;

    public $image;

    public $category_id ;

    public $gallery = [];

    public $width = 1000;
    public $height = 1000;
    
    public $listeners = [
        Trix::EVENT_VALUE_UPDATED ,
        'editModal'
    ];

    public array $listsForFields = [];

    public function onTrixValueUpdate($value)
    {
        $this->product->description = $value;
    }
    
    protected $rules = [
        'product.code' => ['nullable'],
        'product.slug' => ['nullable'],
        'product.name' => ['required', 'string', 'max:255'],
        'product.price' => ['required', 'numeric', 'max:2147483647'],
        'product.old_price' => ['nullable', 'numeric', 'max:2147483647'],
        'product.description' => ['nullable'],
        'product.meta_title' => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.meta_keywords' => ['nullable', 'string', 'min:1'],
        'product.category_id' => ['required', 'integer'],
        'product.subcategory_id' => ['required', 'integer'],
        'product.brand_id' => ['nullable', 'integer'],
        'product.embeded_video' => ['nullable'],
        'product.condition' => ['nullable'],
    ];
    
    public function mount ()
    {
        $this->initListsForFields();
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['brands'] = Brand::pluck('name', 'id')->toArray();
        $this->listsForFields['subcategories'] = Subcategory::pluck('name', 'id')->toArray();
    }

    public function getCategoriesProperty()
    {
        return Category::select('id', 'name')
                            ->get();
    }

    public function editModal($id)
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = Product::findOrFail($id);

        $this->editModal = true;
    }
   
    public function update()
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->product->name).'-'.Str::random(5).'.'.$this->image->extension();

            $img = Image::make($this->image->getRealPath())->encode('webp', 85);

            // we need to resize image, otherwise it will be cropped 
            if ($img->width() > $this->width) { 
                $img->resize($this->width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            if ($img->height() > $this->height) {
                $img->resize(null, $this->height, function ($constraint) {
                    $constraint->aspectRatio();
                }); 
            }

            $img->resizeCanvas($this->width, $this->height, 'center', false, '#ffffff');

            $img->stream();

            Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');

            $this->product->image = $imageName;
        }
        
        // gallery image
        if ($this->gallery) {
            $gallery = [];
            foreach ($this->gallery as $key => $value) {
                $image = $value;
                $imageName = Str::slug($this->product->name).'-'.$key.'.'.$image->extension();

                $img = Image::make($image->getRealPath())->encode('webp', 85);

                // we need to resize image, otherwise it will be cropped 
                if ($img->width() > $this->width) { 
                    $img->resize($this->width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if ($img->height() > $this->height) {
                    $img->resize(null, $this->height, function ($constraint) {
                        $constraint->aspectRatio();
                    }); 
                }

                $img->resizeCanvas($this->width, $this->height, 'center', false, '#ffffff');

                $img->stream();
                Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');
                $gallery[] = $imageName;
            }

            $this->product->gallery = json_encode($gallery);
        }

        $this->product->save();

        $this->alert('success', __('Product updated successfully.'));

        $this->editModal = false;

        $this->emit('refreshIndex');

    }

    public function render()
    {
        return view('livewire.admin.product.edit');
    }
}
