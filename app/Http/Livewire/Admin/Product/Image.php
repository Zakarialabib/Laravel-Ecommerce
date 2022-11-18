<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Models\Product;
use Helpers;
use Storage;
use Str;
use Image as ImageIntervention;

class Image extends Component
{
    use WithFileUploads, LivewireAlert;

    public $product;

    public $image;

    public $image_url;

    public $gallery = [];

    public $listeners = [
        'imageModal','saveImage'
    ];

    public $imageModal;

    public $file;

    public function imageModal($id)
    {
        $this->product = Product::findOrFail($id);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->imageModal = true;  
    }

    public function saveImage()
    {

        if ($this->image_url) {

            $image = file_get_contents($this->image_url);
            $imageName = Str::random(10).'.jpg';
            Storage::disk('local_files')->put('products/'.$imageName, $image, 'public');
            $this->product->image = $imageName;

        }elseif ($this->image) {
            
            $image = $this->image;
            $imageName = Str::slug($this->product->name) . '-' . date('Y-m-d H:i:s') . '.' . $this->image->extension();
            
            $img = ImageIntervention::make($image->getRealPath())->resize(1500, 1500, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); 
            Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');
            $this->product->image = $imageName;

        }

        // gallery image
        if ($this->gallery != null) {
            
            $gallery = [];
            foreach ($this->gallery as $key => $value) {
                $image = $value;
                $imageName = Str::slug($this->product->name).'-'.$key.'.'.$value->extension();
                
                $img = ImageIntervention::make($image->getRealPath())->resize(1500, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->stream(); 
                Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');
                $gallery[] = $imageName;
            }

            $this->product->gallery = json_encode($gallery);
        }

        $this->product->save();

        $this->alert('success', __('Product image updated successfully.'));
        
        $this->emit('refreshIndex');
        
        $this->imageModal = false;

    }

    public function render()
    {
        return view('livewire.admin.product.image');
    }
}
