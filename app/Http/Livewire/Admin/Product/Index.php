<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\{
    Models\Product,
    Models\Brand,
    Models\Category,
    Models\Subcategory,
};
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Trait\WithMediaManager;
use Str;

class Index extends Component
{
    use WithPagination, WithSorting, WithFileUploads, LivewireAlert;

    public $product;

    public $listeners = [
    
    'confirmDelete', 'delete', 'showModal', 'editModal',         
    'refreshIndex','import','exportExcel','exportPdf',
    'importModal','highlightModal', 'saveHighlight'

    ];

    public $highlightModal;

    public $saveHighlight;

    public int $perPage;
    
    public $showModal;
    
    public $editModal;

    public $importModal;
    
    public $refreshIndex;
    
    public array $orderable;
    
    public $file ;
    
    public $import_file ;

    public $metadata ;

    public $image;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

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
        'product.subcategory_id' => ['required', 'integer'],
        'product.brand_id' => ['required', 'integer'],
    ];

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Product())->orderable;
        $this->file = null;
        $this->metadata = null;
        $this->initListsForFields();
    }

    public function delete(Product $product)
    {
        abort_if(Gate::denies('product_delete'), 403);

        $product->delete();
    }

    public function render()
    {

        $query = Product::with(['category'=>function($query){
            $query->select('id','name');
        },'brand'=>function($query){
            $query->select('id','name');
        }])->select('products.*')->advancedFilter([
                            's'               => $this->search ?: null,
                            'order_column'    => $this->sortBy,
                            'order_direction' => $this->sortDirection,
                        ]);

        $products = $query->paginate($this->perPage);

        return view('livewire.admin.product.index', compact('products'));
    }

    public function showModal(Product $product)
    {
        abort_if(Gate::denies('product_show'), 403);

        $this->product = $product;

        $this->showModal = true;  
    }

    public function editModal(Product $product)
    {
        abort_if(Gate::denies('product_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = $product;

        $this->editModal = true;  
    }

    public function update()
    {
        abort_if(Gate::denies('product_edit'), 403);

        $this->validate();

        if ($this->product->image != null) {    
            $imageName = Str::slug($this->product->name).'.'.$this->image->extension();
            $this->image->storeAs('products',$imageName);
            $this->product->image = $imageName;
        }

        // gallery image
        if ($this->product->gallery != null) {
            $gallery = [];
            foreach ($this->gallery as $key => $value) {
                $galleryName = Str::slug($this->product->name).'-'.$key.'.'.$value->extension();
                $value->storeAs('products',$galleryName);
                $gallery[] = $galleryName;
            }
            $this->product->gallery = json_encode($gallery);
        }

        $this->product->save();

        $this->editModal = false;

        $this->alert('success', 'Product updated successfully.');
    }

    
    public function importModal()
    {
        abort_if(Gate::denies('product_access'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->importModal = true;  
    }

    public function import()
    {
        abort_if(Gate::denies('product_access'), 403);
        // import data
        
        // $this->validate([
        //     'import_file' => 'required|mimes:xlsx,xls,csv|max:2048',
        // ]);
        
        Excel::import(new ProductImport, $this->import_file);


        $this->alert('success', __('Products imported successfully'));

        $this->importModal = false;
    }

    public function exportExcel()
    {
        abort_if(Gate::denies('product_access'), 403);

        return (new ProductExport)->download('products.xlsx');
    }

    public function exportPdf()
    {
        abort_if(Gate::denies('product_access'), 403);

        return (new ProductExport)->download('products.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function highlightModal(Product $product)
    {
        abort_if(Gate::denies('product_access'), 403);

        $this->product = $product;

        $this->highlightModal = true;  
    }

    public function saveHighlight()
    {
        abort_if(Gate::denies('product_access'), 403);

        if($this->featured == "")
            {
                $this->product->featured = 0;
            }
            if($this->hot == "")
            {
                $this->product->hot = 0;
            }
            if($this->best == "")
            {
                $this->product->best = 0;
            }
            if($this->top == "")
            {
                $this->product->top = 0;
            }
            if($this->latest == "")
            {
                $this->product->latest = 0;
            }
            if($this->big == "")
            {
                $this->product->big = 0;
            }
            if($this->trending == "")
            {
                $this->product->trending = 0;
            }
            if($this->sale == "")
            {
                $this->product->sale = 0;
            }
            if($this->is_discount == "")
            {
                $this->product->is_discount = 0;
                $this->product->discount_date = null;
            }else{
                $this->product->discount_date = \Carbon\Carbon::parse($input['discount_date'])->format('Y-m-d');
            }


        $this->product->save();

        $this->highlightModal = false;

        $this->alert('success', 'Product highlighted successfully.');
    }

    public function showUploader() 
    {
        $this->file = null;
        $this->showFileManager('gallery', $file);
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = Category::pluck('name', 'id')->toArray();
        $this->listsForFields['brands'] = Brand::pluck('name', 'id')->toArray();
        $this->listsForFields['subcategories'] = Subcategory::pluck('name', 'id')->toArray();
    }
}