<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Exports\ProductExport;
use App\Http\Livewire\WithSorting;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithFileUploads;
    use LivewireAlert;

    public $product;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'promoAllProducts',
        'delete', 'downloadAll',
        'exportAll',
    ];
    
    public $deleteModal = false;

    public $promoAllProducts = false;

    public $percentage = null;

    public $copyPriceToOldPrice = false;

    public $copyOldPriceToPrice = false;

    public $percentageMethod;

    public int $perPage;

    public $refreshIndex;

    public array $orderable;

    public $selectAll;
    public $category_id;
    public $subcategoryIds;
    public $brand_id;
    
    public $file;

    public float $price;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

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

    public function confirmed()
    {
        $this->emit('delete');
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Product())->orderable;
        $this->file = null;
        // if ($this->product) {
        //     $this->updateSelected();
        // }
    }

    public function render(): View|Factory
    {
        $query = Product::with(['category' => function ($query) {
            $query->select('id', 'name');
        }, 'brand' => function ($query) {
            $query->select('id', 'name');
        },
        ])->select('products.*')->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $products = $query->paginate($this->perPage);

        return view('livewire.admin.product.index', compact('products'));
    }


    public function deleteModal($product)
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->product = $product;
    }

    public function delete()
    {
        abort_if(Gate::denies('product_delete'), 403);

        Product::findOrFail($this->product)->delete();

        $this->alert('success', __('Product deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('product_delete'), 403);

        Product::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function selectAll()
    {
        if (count(array_intersect($this->selected, Product::pluck('id')->toArray())) === count(Product::pluck('id')->toArray())) {
            $this->selected = [];
        } else {
            $this->selected = Product::pluck('id')->toArray();
        }
    }

    public function selectPage()
    {
        if (count(array_intersect($this->selected, Product::paginate($this->perPage)->pluck('id')->toArray())) === count(Product::paginate($this->perPage)->pluck('id')->toArray())) {
            $this->selected = [];
        } else {
            $this->selected = array_intersect($this->selected, Product::paginate($this->perPage)->pluck('id')->toArray());
        }
    }

     // Product  Clone
     public function clone(Product $product)
     {
         $product_details = Product::find($product->id);
         // dd($product_details);
         Product::create([
             'code'             => $product_details->code,
             'slug'             => $product_details->slug,
             'name'             => $product_details->name,
             'price'            => $product_details->price,
             'description'      => $product_details->description,
             'meta_title'       => $product_details->meta_title,
             'meta_description' => $product_details->meta_description,
             'meta_keywords'    => $product_details->meta_keywords,
             'category_id'      => $product_details->category_id,
             'subcategories'    => $product_details->subcategories,
             'image'            => $product_details->image,
             'brand_id'         => $product_details->brand_id,
             'status'           => 0,
         ]);

         $this->alert('success', __('Product Cloned successfully!'));
     }

     public function promoAllProducts()
     {
         $this->promoAllProducts = true;
     }

     public function discountSelected()
     {
         $products = Product::whereIn('id', $this->selected)->get();

         foreach ($products as $product) {
             if ($this->copyPriceToOldPrice) {
                 $product->old_price = $product->price;
             } elseif ($this->copyOldPriceToPrice) {
                 $product->price = $product->old_price;
                 $product->old_price = null;
             } elseif ($this->percentageMethod === '+') {
                 $product->price = round(floatval($product->price) * (1 + $this->percentage / 100));
             } else {
                 $product->price = round(floatval($product->price) * (1 - $this->percentage / 100));
             }
             $product->save();
         }

         $this->alert('success', __('Product Prices changed successfully!'));

         $this->resetSelected();

         $this->promoAllProducts = false;

         $this->copyPriceToOldPrice = '';
         $this->copyOldPriceToPrice = '';
         $this->percentage = '';
     }

    public function getCategoriesProperty()
    {
        return Category::select('id', 'name')->get();
    }

    public function getBrandsProperty()
    {
        return Brand::select('name', 'id')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::select('name', 'id')->get();
    }

    public function updateSelected($field, $productId)
    {
        try {        
            $this->product = Product::find($productId);
        
            switch ($field) {
                case 'category':
                    $this->product->category_id = $this->category_id;
                    break;
                case 'brand':
                    $this->product->brand_id = $this->brand_id;
                    break;
                case 'subcategoryIds':
                    $this->product->subcategories = $this->subcategories;
                    break;
                
                default:
                    # code...
                    break;
            }
        
            $this->product->save();
            
            $this->alert('success', __('Product updated successfully.'));
        } catch (\Throwable $th) {
            $this->alert('error', __('Something is missing.'));
        }
    }

    public function expand(Product $product)
    {

        $this->category_id = $this->product->category_id;
        $this->brand_id = $this->product->brand_id;
        $this->subcategoryIds = $this->product->subcategories;
        // dd($this->all());

    }

      public function downloadSelected()
      {
          $products = Product::whereIn('id', $this->selected)->get();

          return (new ProductExport($products))->download('products.xls', \Maatwebsite\Excel\Excel::XLS);
      }

    public function downloadAll(Product $products)
    {
        return (new ProductExport($products))->download('products.xls', \Maatwebsite\Excel\Excel::XLS);
    }

     public function exportSelected(): BinaryFileResponse
     {
         return $this->callExport()->forModels($this->selected)->download('products.pdf', \Maatwebsite\Excel\Excel::MPDF);
     }

     public function exportAll(): BinaryFileResponse
     {
         return $this->callExport()->download('products.pdf', \Maatwebsite\Excel\Excel::MPDF);
     }

     private function callExport(): ProductExport
     {
         return new ProductExport();
     }
}
