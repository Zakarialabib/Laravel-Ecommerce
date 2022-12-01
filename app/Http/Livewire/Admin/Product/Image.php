<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Image as ImageIntervention;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class Image extends Component
{
    use WithFileUploads, LivewireAlert;

    public $product;

    public $image = null;

    public $image_url = null;

    public $embeded_video = null;
    
    public $gallery = [];

    public $listeners = [
        'imageModal', 'saveImage',
    ];

    public $imageModal;

    public function imageModal($id)
    {
        $this->resetErrorBag();

        $this->resetValidation();
        
        $this->product = Product::findOrFail($id);

        $this->image = $this->product->image;

        $this->gallery = $this->product->gallery;

        $this->imageModal = true;
    }

    public function saveImage()
    {
        if ($this->image_url != null) {
            $image = file_get_contents($this->image_url);
            $imageName = Str::random(10).'.jpg';
            Storage::disk('local_files')->put('products/'.$imageName, $image, 'public');
            $this->product->image = $imageName;
        } 

        if ($this->embeded_video != null) {
            $this->product->image = $this->embeded_video;
        } 

        if ($this->image != null) {
            $imageName = Str::slug($this->product->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('products', $imageName);
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
