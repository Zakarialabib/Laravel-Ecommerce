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

    protected $rules = [
        'file' => 'required|mimes:xlsx,xls,csv,txt',
    ];
    
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
        // $this->validate([
        //     'file' => 'required|mimes:xlsx',
        // ]);

        $import = new ProductImport;

        Excel::import($import, $this->file->getRealPath()); 

        // Excel::import(new ProductImport, $this->file);  

        $this->alert('success', 'Imported Successfully');

        $this->emit('refreshIndex');
        
        $this->importModal = false;

    }

}
