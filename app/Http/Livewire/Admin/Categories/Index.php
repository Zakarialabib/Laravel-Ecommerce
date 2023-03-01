<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Categories;

use App\Http\Livewire\WithSorting;
use App\Imports\CategoriesImport;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $category;

    public $name;

    public $image;

    public $file;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'editModal', 'importModal',
    ];

    public int $perPage;

    public $refreshIndex;

    public $importModal;

    public $editModal = false;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $rules = [
        'category.name' => 'required',
    ];

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
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Category())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Category::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $categories = $query->paginate($this->perPage);

        return view('livewire.admin.categories.index', compact('categories'));
    }

    public function editModal(Category $category)
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->category = $category;

        $this->editModal = true;
    }

    public function update()
    {
        //abort_if(Gate::denies('category_edit'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->category->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('categories', $imageName);
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
        }
        $category->delete();

        $this->alert('success', __('Category deleted successfully.'));
    }

    public function importExcel()
    {
        abort_if(Gate::denies('category_access'), 403);

        $this->importModal = true;
    }

    public function import()
    {
        abort_if(Gate::denies('category_access'), 403);

        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv,txt',
        ]);

        $file = $this->file('file');

        Excel::import(new CategoriesImport(), $file);

        $this->alert('success', __('Categories imported successfully.'));

        $this->importModal = false;
    }
}
