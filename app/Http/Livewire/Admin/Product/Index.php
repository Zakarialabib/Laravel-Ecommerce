<?php

namespace App\Http\Livewire\Admin\Product;

use App\Http\Livewire\Trix;
use App\Http\Livewire\WithSorting;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithSorting, WithFileUploads, LivewireAlert;

    public $product;

    public $listeners = [
        Trix::EVENT_VALUE_UPDATED,
        'refreshIndex' => '$refresh',
        'highlightModal', 'delete',
    ];

    public $description;

    public $highlightModal = false;

    public int $perPage;

    public $refreshIndex;

    public array $orderable;

    public $file;

    public $hot;

    public $featured;

    public $best;

    public $top;

    public $latest;

    public $big;

    public $trending;

    public $sale;

    public $is_discount;

    public $discount_date;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

    public $image;

    public $image_url = null;

    public $gallery = [];

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function onTrixValueUpdate($value)
    {
        $this->product->description = $value;
    }

    protected $rules = [
        'product.code' => ['nullable'],
        'product.name' => ['required', 'string', 'max:255'],
        'product.price' => ['required', 'numeric', 'max:2147483647'],
        'product.old_price' => ['nullable', 'numeric', 'max:2147483647'],
        'product.description' => ['nullable'],
        'product.meta_title' => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.meta_keywords' => ['nullable', 'string', 'min:1'],
        'product.category_id' => ['required', 'integer'],
        'product.subcategory_id' => ['nullable', 'integer'],
        'product.brand_id' => ['required', 'integer'],
        'product.embeded_video' => ['nullable'],
    ];

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Product())->orderable;
        $this->file = null;
        $this->initListsForFields();
    }

    public function render()
    {
        $query = Product::with(['category' => function ($query) {
            $query->select('id', 'name');
        }, 'brand' => function ($query) {
            $query->select('id', 'name');
        }])->select('products.*')->advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $products = $query->paginate($this->perPage);

        return view('livewire.admin.product.index', compact('products'));
    }

    public function delete(Product $product)
    {
        abort_if(Gate::denies('product_delete'), 403);

        $product->delete();

        $this->alert('success', __('Product deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('product_delete'), 403);

        Product::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function highlightModal(Product $product)
    {
        abort_if(Gate::denies('product_access'), 403);

        $this->product = Product::find($product);

        $this->highlightModal = true;
    }

    public function saveHighlight()
    {
        abort_if(Gate::denies('product_access'), 403);

        if ($this->hot) {
            $this->product->hot = $this->hot;
        }
        if ($this->featured) {
            $this->product->featured = $this->featured;
        }
        if ($this->best) {
            $this->product->best = $this->best;
        }
        if ($this->top) {
            $this->product->top = $this->top;
        }
        if ($this->latest) {
            $this->product->latest = $this->latest;
        }
        if ($this->big) {
            $this->product->big = $this->big;
        }
        if ($this->trending) {
            $this->product->trending = $this->trending;
        }
        if ($this->sale) {
            $this->product->sale = $this->sale;
        }
        if ($this->is_discount) {
            $this->product->is_discount = $this->is_discount;
        }
        if ($this->discount_date) {
            $this->product->discount_date = $this->discount_date;
        }

        $this->product->save();

        $this->alert('success', 'Product highlighted successfully.');

        $this->refreshIndex();

        $this->highlightModal = false;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['brands'] = Brand::pluck('name', 'id')->toArray();
        $this->listsForFields['subcategories'] = Subcategory::pluck('name', 'id')->toArray();
    }

     // Product  Clone
     public function clone(Product $product)
     {
         $product_details = Product::find($product->id);
         // dd($product_details);
         Product::create([
             'code' => $product_details->code,
             'slug' => $product_details->slug,
             'name' => $product_details->name,
             'price' => $product_details->price,
             'description' => $product_details->description,
             'meta_title' => $product_details->meta_title,
             'meta_description' => $product_details->meta_description,
             'meta_keywords' => $product_details->meta_keywords,
             'category_id' => $product_details->category_id,
             'subcategory_id' => $product_details->subcategory_id,
             'brand_id' => $product_details->brand_id,
             'status' => 0,
         ]);
         
         $this->alert('success', __('Product Cloned successfully!') );
     }
}
