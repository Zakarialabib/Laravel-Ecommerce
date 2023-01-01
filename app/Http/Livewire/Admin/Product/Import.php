<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Jobs\ProductJob;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Import extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'importModal', 'import',
    ];

    public $file;

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

    public function import()
    {
        abort_if(Gate::denies('product_access'), 403);

        if ($this->file->extension() == 'xlsx' || $this->file->extension() == 'xls') {
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
}
