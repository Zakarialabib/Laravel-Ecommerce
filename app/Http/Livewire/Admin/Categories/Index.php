<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoriesImport;

class Index extends Component
{
    use WithPagination, WithSorting, 
        LivewireAlert, WithFileUploads;

    public $category;
    public $code;
    public $name;
    public $image;

    public $listeners = [
         'confirmDelete', 'delete',
        'refreshIndex','editModal',
        'importModal'
    ];

    public int $perPage;
    
    public $refreshIndex;

    public $importModal;
    
    public $editModal; 

    public array $orderable;

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

    public array $rules = [
        'category.code' => '',
        'category.name' => 'required',
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

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable         = (new Category())->orderable;
    }

    public function render()
    {
        $query = Category::advancedFilter([
                            's'               => $this->search ?: null,
                            'order_column'    => $this->sortBy,
                            'order_direction' => $this->sortDirection,
                        ]);

        $categories = $query->paginate($this->perPage);

        return view('livewire.admin.categories.index', compact('categories'));
    }

    public function editModal(Category $category)
    {
        abort_if(Gate::denies('category_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->category = $category;

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('category_edit'), 403);

        $this->validate();

        if($this->image){
            $imageName = Str::slug($this->category->name) . '-' . date('Y-m-d H:i:s') . '.' . $this->image->extension();
            $this->image->storeAs('categories',$imageName);
            $this->category->image = $imageName;
        }

        $this->category->save();

        $this->editModal = false;

        $this->alert('success', __('Category updated successfully.'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('category_delete'), 403);

        Category::whereIn('id', $this->selected)->delete();
        
        $this->alert('success', __('Category deleted successfully.'));

        $this->resetSelected();
    }
    
    public function delete(Category $category)
    {
        abort_if(Gate::denies('category_delete'), 403);

        if ($category->products()->isNotEmpty()) {
            return back()->withErrors('Can\'t delete beacuse there are products associated with this category.');
        } else {
            $category->delete();

            $this->alert('success', __('Category deleted successfully.'));
        }
    }

    public function importExcel ()
    {
        abort_if(Gate::denies('category_access'), 403);

        $this->importModal = true;
    }

    public function import()
    {
        abort_if(Gate::denies('category_access'), 403);

        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv,txt'
        ]);

        $file = $this->file('file');

        Excel::import(new CategoriesImport, $file);

        $this->alert('success', __('Categories imported successfully.'));

        $this->importModal = false;
    }

}