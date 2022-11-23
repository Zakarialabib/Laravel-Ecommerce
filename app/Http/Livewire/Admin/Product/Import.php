<?php

namespace App\Http\Livewire\Admin\Product;

use App\Jobs\ProductJob;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Import extends Component
{
    use LivewireAlert, WithFileUploads;

    public $listeners = [
        'importModal', 'import',
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
                'file' => 'required|file|mimes:xlsx',
            ]);

            $file = $this->file;
            $filename = time().'-product.'.$file->getClientOriginalExtension();
            $file->storeAs('products', $filename);

            ProductJob::dispatch($filename);

            $this->emit('refreshIndex');

            $this->alert('success', __('Product imported successfully!'));
        } else {
            $this->alert('error', __('File is a '.$this->file->extension().' file.!! Please upload a valid xls/csv file..!!'));
        }

        $this->resetErrorBag();

        $this->resetValidation();

        $this->importModal = false;
    }
}
