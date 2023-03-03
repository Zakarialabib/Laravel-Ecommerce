<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Select extends Component
{
    use LivewireAlert;

    public Model $model;

    public $field;

    public $selectType = 'category_id';

    public $subcategory_id;

    public $brand_id;

    public $category_id;

    public $uniqueId;

    protected $listeners = ['updating', 'changeSelectType'];

    public function changeSelectType($value)
    {
        $this->selectType = $value;
        $this->field = $this->selectType;
    }

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->field = 'category_id';
        $this->category_id = $this->model->category_id;
        $this->subcategory_id = $this->model->subcategory_id;
        $this->brand_id = $this->model->brand_id;

        $this->selectType = $this->model->getAttribute($this->field);
        $this->uniqueId = uniqid();
    }

    public function updated($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();

        $this->alert('success', __('Status Changed successfully!'), [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
            'showDenyButton' => false,
            'onDenied' => '',
        ]);

        // $this->emit('refreshIndex');
    }

    public function render()
    {
        return view('livewire.select');
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::select('name', 'id')->get();
    }

    public function getBrandsProperty()
    {
        return Brand::select('name', 'id')->get();
    }
}
