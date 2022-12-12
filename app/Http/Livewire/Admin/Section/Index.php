<?php

namespace App\Http\Livewire\Admin\Section;

use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Response;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    public $image;

    public $listeners = [
        'confirmDelete', 'delete', 'refreshIndex',
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

    protected $rules = [
        'section.language_id' => 'required',
        'section.page' => 'required',
        'section.title' => 'nullable',
        'section.subtitle' => 'nullable',
        'section.custom_html_1' => 'nullable',
        'section.content' => 'nullable',
        'section.video' => 'nullable',
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

    public function render()
    {
        $query = Section::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
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

          $this->alert('warning', __('Section Deleted successfully!') );
      }

     // Section  Clone
     public function clone(Section $section)
     {
         $section_details = Section::find($section->id);
         
         Section::create([
             'language_id' => $section_details->language_id,
             'page' => $section_details->page,
             'title' => $section_details->title,
             'subtitle' => $section_details->subtitle,
             'text' => $section_details->text,
             'button' => $section_details->button,
             'link' => $section_details->link,
             'video' => $section_details->video,
             'image' => $section_details->image,
             'content' => $section_details->content,
             'status' => 0,
         ]);
         $this->alert('success', __('Section Cloned successfully!') );
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
 
         $this->refreshIndex();
 
         $this->alert('success', __('Section updated successfully.'));
 
         $this->editModal = false;
     }
}
