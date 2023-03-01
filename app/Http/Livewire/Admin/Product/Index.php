<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Exports\ProductExport;
use App\Http\Livewire\WithSorting;
use App\Models\Product;
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

    public $selectType;

    public $promoAllProducts = false;

    public $percentage = null;

    public $copyPriceToOldPrice = false;

    public $copyOldPriceToPrice = false;

    public $percentageMethod;

    public int $perPage;

    public $refreshIndex;

    public array $orderable;

    public $selectAll;

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

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Product())->orderable;
        $this->file = null;
        $this->selectType = 'category_id';
    }

    public function render(): View|Factory
    {
        $query = Product::with(['category' => function ($query) {
            $query->select('id', 'name');
        }, 'brand' => function ($query) {
            $query->select('id', 'name');
        },
        ])->select('products.*')->advancedFilter([
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
             'image' => $product_details->image,
             'brand_id' => $product_details->brand_id,
             'status' => 0,
         ]);

         $this->alert('success', __('Product Cloned successfully!'));
     }

     public function promoAllProducts()
     {
         $this->promoAllProducts = true;
     }

     public function updateSelected()
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
