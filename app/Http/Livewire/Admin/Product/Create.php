<?php
namespace App\Http\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Warehouse;

class Create extends Component
{
    use LivewireAlert, WithFileUploads;

    public $listeners = ['createProduct', 'refreshIndex',];
    
    public $createProduct;

    public $refreshIndex;

    public $image;
    
    public $gallery = [];

    public function refreshIndex()
    {
        $this->resetPage();
    }

    public array $listsForFields = [];

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'price' => ['required', 'numeric', 'max:2147483647'],
        'old_price' => ['required', 'numeric', 'max:2147483647'],
        'description' => ['nullable'],
        'meta_title' => ['nullable', 'string', 'max:255'],
        'meta_description' => ['nullable', 'string', 'max:255'],
        'meta_keywords' => ['nullable', 'string', 'min:1'],
        'category_id' => ['required', 'integer'],
        'subcategory_id' => ['required', 'integer'],
        'brand_id' => ['required', 'integer'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->initListsForFields();
    }
    
    public function render()
    {
        // abort_if(Gate::denies('create_products'), 403);

        return view('livewire.admin.product.create');
    }

    public function createProduct()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createProduct = true;  
    }

    public function create()
    {
        $validatedData = $this->validate();

        // generate code
        $this->product->code = Str::random(10);
        // generate slug from name slug
        $this->product->slug = Str::slug($this->product->name);
        
        if($this->image){
            $imageName = Str::slug($this->product->name).'.'.$this->image->extension();
            $this->image->storeAs('products',$imageName);
            $this->product->image = $imageName;
        }
        // gallery
        if($this->gallery)
        {
            $gallery = [];
            foreach($this->gallery as $image)
            {
                $imageName = Str::slug($this->product->name).'.'.$image->extension();
                $image->storeAs('products',$imageName);
                $gallery[] = $imageName;
            }
            $this->product->gallery = json_encode($gallery);
        }
        
        Product::create($validatedData);
        
        $this->alert('success', 'Product created successfully');

        $this->emit('refreshIndex');

        $this->createProduct = false;

    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['brands'] = Brand::pluck('name', 'id')->toArray();
        $this->listsForFields['subcategories'] = Subcategory::pluck('name', 'id')->toArray();
    }

}
