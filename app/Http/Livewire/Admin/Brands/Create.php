<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Brands;

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

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createBrand;

    public $brand;

    public $image;

    public $featured_image;

    public $image_url = null;

    public $listeners = ['createBrand'];

    public array $rules = [
        'brand.name' => ['required', 'string', 'max:255'],
        'brand.description' => ['nullable', 'string'],
    ];

    public function mount(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('brand_create'), 403);

        return view('livewire.admin.brands.create');
    }

    public function createBrand()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createBrand = true;
    }

    public function create()
    {
        $this->validate();

        $this->brand->slug = Str::slug($this->brand->name);

        if ($this->image_url) {
            $image = file_get_contents($this->image_url);

            $imageName = Str::random(5).'.'.$this->image->extension();
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

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->brand->name).'.'.$this->image->extension();
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

        $this->emit('refreshIndex');

        $this->alert('success', __('Brand created successfully.'));

        $this->createBrand = false;
    }
}
