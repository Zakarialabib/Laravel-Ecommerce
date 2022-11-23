<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert , WithFileUploads;

    public $createBrand;

    public $image;

    public $featured_image;

    public $listeners = ['createBrand'];

    public function mount(Brand $brand)
    {
        $this->brand = $brand;
    }

    public array $rules = [
        'brand.name' => ['required', 'string', 'max:255'],
        'brand.slug' => ['nullable', 'string'],
        'brand.description' => ['nullable', 'string'],
    ];

    public function render()
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

        if ($this->image) {
            // with str slug with name date
            $imageName = Str::slug($this->brand->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('brands', $imageName);
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
