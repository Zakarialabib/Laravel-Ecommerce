<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Jobs\ImportJob;
use App\Jobs\ProductJob;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Helpers;

class Import extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'importModal', 'import',
        'importUpdates',
    ];

    public $file;
    
    public $sheetLink;

    public $importModal = null;

    public function render(): View|Factory
    {
        return view('livewire.admin.product.import');
    }

    public function importModal()
    {
        abort_if(Gate::denies('product_access'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->importModal = true;
    }

    public function importUpdates()
    {
        abort_if(Gate::denies('product_access'), 403);

        if ($this->file->extension() === 'xlsx' || $this->file->extension() === 'xls') {
            $filename = time().'-product.'.$this->file->getClientOriginalExtension();
            $this->file->storeAs('products', $filename);

            ImportJob::dispatch($filename);

            $this->alert('success', __('Product imported successfully!'));
        } else {
            $this->alert('error', __('File is a '.$this->file->extension().' file.!! Please upload a valid xls/csv file..!!'));
        }

        $this->emit('refreshIndex');

        $this->importModal = false;
    }

    public function import()
    {
        abort_if(Gate::denies('product_access'), 403);

        if ($this->file->extension() === 'xlsx' || $this->file->extension() === 'xls') {
            $filename = time().'-product.'.$this->file->getClientOriginalExtension();
            $this->file->storeAs('products', $filename);

            ProductJob::dispatch($filename);

            $this->alert('success', __('Product imported successfully!'));
        } else {
            $this->alert('error', __('File is a '.$this->file->extension().' file.!! Please upload a valid xls/csv file..!!'));
        }

        $this->emit('refreshIndex');

        $this->importModal = false;
    }

    public function googleSheetImport()
    {

        $response = Http::get($this->sheetLink);
    
        $data = json_decode($response->getBody(), true);
        foreach ($data as $index => $row) {
            $product = Product::where('name', $row[0])->first();

            if ($product === null) {
                $product = Product::create([
                    'name'          => $row[0],
                    'description'   => $row[2],
                    'price'         => $row[4],
                    'old_price'     => $row[5] ?? null,
                    'slug'          => Str::slug($row[0], '-').'-'.Str::random(5),
                    'code'          => Str::random(10),
                    'category_id'   => Category::where('name', $row[6])->first()->id ?? Helpers::createCategory(['name' => $row[6]])->id ?? null,
                    'subcategories' => !empty($row[7]) ? Subcategory::whereIn('name', explode(',', $row[7]))->pluck('id')->toArray() : [],
                    'brand_id'      => Brand::where('name', $row[8])->first()->id ?? Helpers::createBrand(['name' => $row[8]]),
                    'image'         => Helpers::uploadImage($row[1], $row[0]) ?? 'default.jpg',
                    // 'gallery' => getGalleryFromUrl($row[7]) ?? null,
                    'meta_title'       => Str::limit($row[0], 60),
                    'meta_description' => Str::limit($row[2], 160),
                    'meta_keywords'    => Str::limit($row[0], 60),
                    'status'           => 0,
                ]);
            }
    
            $product->price = $row[4];
            $product->old_price = $row[5] ?? null;
            $product->save();
    
        }

    }
}
