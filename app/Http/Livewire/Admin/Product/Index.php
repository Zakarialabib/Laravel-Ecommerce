<?php

namespace App\Http\Livewire\Admin\Product;

use App\Http\Livewire\WithSorting;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Gate;
use Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Storage;
use Str;

class Index extends Component
{
    use WithPagination, WithSorting, WithFileUploads, LivewireAlert;

    public $product;

    public $listeners = [
        'trix:valueUpdated' => 'onTrixValueUpdate',
        'confirmDelete', 'delete', 'showModal', 'editModal',
        'refreshIndex','highlightModal',

    ];

    public $highlightModal;

    public int $perPage;

    public $showModal = false;

    public $editModal = false;

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

    public $image_url;

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

    public function onTrixValueUpdate($value)
    {
        $this->description = $value;
    }

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

    public function refreshIndex()
    {
        $this->resetPage();
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

    public function showModal(Product $product)
    {
        abort_if(Gate::denies('product_show'), 403);

        $this->product = $product->id;

        $this->showModal = true;
    }

    public function editModal($product)
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = Product::findOrfail($product);

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->validate();

        if ($this->image) {
            $image = $this->image;
            $imageName = Str::slug($this->product->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();

            $img = Image::make($image->getRealPath())->resize(1500, 1500, function ($constraint) {
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

                $img = Image::make($image->getRealPath())->resize(1500, 1500, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->stream();
                Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');
                $gallery[] = $imageName;
            }

            $this->product->gallery = json_encode($gallery);
        }

        // dd($this->product->image);

        $this->product->save();

        $this->editModal = false;

        $this->alert('success', 'Product updated successfully.');
    }

    public function highlightModal(Product $product)
    {
        abort_if(Gate::denies('product_access'), 403);

        $this->product = Product::findOrfail($product->id);

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
}
