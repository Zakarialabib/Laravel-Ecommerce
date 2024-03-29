<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $brand;

    public $editModal = false;

    public $image;

    public $featured_image;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'brand.name'        => ['required', 'string', 'max:255'],
        'brand.origin'        => ['nullable', 'string', 'max:255'],
        'brand.slug'        => ['required', 'string'],
        'brand.description' => ['nullable', 'string'],
    ];

       public function getImagePreviewProperty()
    {
        return $this->brand?->image;
    }

    public function getFeaturedImagePreviewProperty()
    {
        return $this->brand?->featured_image;
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

        if ($this->image) {
            $imageName = Str::slug($this->brand->name).'-'.Str::random(5).'.'.$this->image->extension();
            $width = 500;
            $height = 500;

            $img = Image::make($this->image->getRealPath())->encode('webp', 85);

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
        
        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.brands.edit');
    }
}
