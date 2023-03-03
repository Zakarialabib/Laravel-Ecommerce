<?php

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;

class StepWizard extends Component
{
    public $step = 0;
    public $giftOrSelf;
    public $category_id;
    public $brand_id;
    public $subcategory_id;
    public $minPrice = 0;
    public $maxPrice = '1000';
    public $options = null;
    public $price = 0;

    public $listeners = [
        'resetPage' => '$refresh',
    ];

    public function nextStep()
    {
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function updateGiftOrSelf($giftOrSelf)
    {
        $this->giftOrSelf = $giftOrSelf;
        $this->nextStep();
    }

    public function updateCategoryId($category_id)
    {
        $this->category_id = $category_id;
        $this->nextStep();
    }

    public function updateBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
        $this->nextStep();
    }
    public function updatedMinPrice($value)
    {
        $this->minPrice = $value;
    }

    public function updatedMaxPrice($value)
    {
        $this->maxPrice = $value;
    }

    public function updateSubcategoryId($subcategory_id)
    {
        $this->subcategory_id = $subcategory_id;
        $this->nextStep();
    }

    public function clearFilter($filter)
    {
        switch($filter) {
            case 'category_id':
                $this->category_id = null;
                break;
            case 'subcategory_id':
                $this->subcategory_id = null;
                break;
            case 'brand_id':
                $this->brand_id = null;
                break;
            case 'giftOrSelf':
                $this->giftOrSelf = null;
                break;
        }
        $this->emit('resetPage');
    }

    public function getBrandsProperty()
    {
        return Brand::active()->get();
    }

    public function getCategoriesProperty()
    {
        return Category::active()->with('subcategories')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::active()->get();
    }

    public function render()
    {
        $products = Product::query();

        if ($this->category_id) {
            $products->where('brand_id', $this->category_id);
        }

        if ($this->brand_id) {
            $products->where('category_id', $this->brand_id);
        }

        if ($this->subcategory_id) {
            $products->where('subcategory_id', $this->subcategory_id);
        }

        if ($this->price) {
            $products->whereBetween('price', $this->price);
        }

        return view('livewire.front.step-wizard', [
            'products' => $products->get(),
            'totalSteps' => 6,
            'currentStep' => $this->step,
        ]);
    }
}
