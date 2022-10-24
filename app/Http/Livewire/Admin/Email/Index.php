<?php

namespace App\Http\Livewire\Admin\Email;

use Livewire\Component;
use App\{
    Classes\GeniusMailer,
    Models\EmailTemplate,
    Models\Generalsetting,
    Models\User
};
use Illuminate\Http\Response;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;
use Str;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

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
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('settings.pagination.options');
        $this->orderable         = (new EmailTemplate())->orderable;
    }

    public function render()
    {
        $query = EmailTemplate::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $emails = $query->paginate($this->perPage);

        return view('livewire.admin.email.index', compact('emails'));
    }

     // Blog Category  Delete
     public function delete(EmailTemplate $email)
     {
         // abort_if(Gate::denies('email_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
 
         $email->delete();
     }
     
}