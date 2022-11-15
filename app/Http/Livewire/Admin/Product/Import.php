<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Imports\ProductImport;
use Livewire\WithFileUploads;
use Storage;

class Import extends Component
{
    use LivewireAlert, WithFileUploads;

    public $listeners = [
        'importModal', 'import'
    ];

    public $file;
    public $importModal;
    
    public function render()
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

    public function import()
    {
        abort_if(Gate::denies('product_access'), 403);

        if ($this->file->extension() == 'xlsx' || $this->file->extension() == 'xls') {
            
            $this->validate([
                'file' => 'required|mimes:xlsx,xls'
            ]);

            $filename = 'products.' . $this->file->extension();

            $this->file->storeAs('products', $filename);

            Excel::import(new ProductImport, public_path('images/products/' . $filename));

            $this->alert('success', __('Product imported successfully!') );

            $this->importModal = false;

        } else {
            $this->alert('error', __('File is a '.$this->file->extension().' file.!! Please upload a valid xls/csv file..!!') );
        }

        $this->emit('refreshIndex');
        
        $this->importModal = false;

    }

}
