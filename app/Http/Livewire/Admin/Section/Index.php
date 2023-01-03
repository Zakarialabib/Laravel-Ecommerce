<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Response;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    use WithSorting;
    use WithFileUploads;

    public $image;

    public $section;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'editModal',
    ];

    public $refreshIndex;

    public $showModal = false;

    public $editModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $language_id;

    public array $listsForFields = [];

    protected $queryString = [
        'search'        => [
            'except' => '',
        ],
        'sortBy'        => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    protected $rules = [
        'section.language_id' => 'required',
        'section.page'        => 'required',
        'section.title'       => 'nullable',
        'section.subtitle'    => 'nullable',
        'section.description' => 'nullable',
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

    protected function initListsForFields(): void
    {
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Section())->orderable;
        $this->initListsForFields();
    }

    public function render(): View|Factory
    {
        $query = Section::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $sections = $query->paginate($this->perPage);

        return view('livewire.admin.section.index', compact('sections'));
    }

      // Section  Delete
      public function delete(Section $section)
      {
          abort_if(Gate::denies('section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

          $section->delete();

          $this->alert('warning', __('Section Deleted successfully!'));
      }

     // Section  Clone
     public function clone(Section $section)
     {
         $section_details = Section::find($section->id);

         Section::create([
             'language_id' => $section_details->language_id,
             'page'        => $section_details->page,
             'title'       => $section_details->title,
             'subtitle'    => $section_details->subtitle,
             'link'        => $section_details->link,
             'image'       => $section_details->image,
             'description' => $section_details->description,
             'status'      => 0,
         ]);
         $this->alert('success', __('Section Cloned successfully!'));
     }

     public function editModal(Section $section)
     {
         $this->resetErrorBag();

         $this->resetValidation();

         $this->section = $section;

         $this->editModal = true;
     }

     public function update()
     {
         $this->validate();
         // if product selected Helpers::productLink($product)

         if ($this->image) {
             $imageName = Str::slug($this->section->title).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
             $this->image->storeAs('sections', $imageName);
             $this->section->image = $imageName;
         }

         $this->section->save();

         $this->alert('success', __('Section updated successfully!'));

         $this->editModal = false;
     }
}
