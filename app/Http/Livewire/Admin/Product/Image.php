<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Image as ImageIntervention;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Storage;

class Image extends Component
{
    use WithFileUploads, LivewireAlert;

    public $product;

    public $image = "";

    public $image_url = null;

    public $embeded_video = null;
    
    public $gallery = [];

    public $listeners = [
        'imageModal', 'saveImage',
    ];

    public $imageModal = false;

    public $width = 1000;
    public $height = 1000;

    public function imageModal($id)
    {
        $this->resetErrorBag();

        $this->resetValidation();
        
        $this->product = Product::findOrFail($id);

        $this->imageModal = true;
    }

    public function saveImage()
    {
        if ($this->image_url) {
            $image = file_get_contents($this->image_url);
            $imageName = Str::random(10).'.jpg';
            Storage::disk('local_files')->put('products/'.$imageName, $image, 'public');
            $this->product->image = $imageName;
        } 

        if ($this->embeded_video) {
            $this->product->image = $this->embeded_video;
        } 

        if ($this->image) {
            $imageName = Str::slug($this->product->name).'-'.Str::random(5).'.'.$this->image->extension();

     
            $img = ImageIntervention::make($this->image->getRealPath())->encode('webp', 85);

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
                $imageName = Str::slug($this->product->name).'-'.$key.'.'.$value->extension();

                $img = ImageIntervention::make($image->getRealPath())->encode('webp', 85);
                
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

        $this->alert('success', __('Product image updated successfully.'));

        $this->emit('refreshIndex');

        $this->imageModal = false;
    }

    public function render()
    {
        return view('livewire.admin.product.image');
    }
}
