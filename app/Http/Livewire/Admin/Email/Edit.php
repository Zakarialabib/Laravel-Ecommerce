<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Email;

use App\Models\EmailTemplate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal'
    ];

    public $editModal;
    public $email_setting;
    public $description;
    public $message;

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function updatedMessage($value)
    {
        $this->message = $value;
    }

    protected $rules = [
            'email_setting.name'             => ['required', 'max:255'],
            'description'      => ['required'],
            'message'          => ['required'],
            'email_setting.default'          => ['required'],
            'email_setting.placeholders'     => ['required'],
            'email_setting.type'             => ['required'],
            'email_setting.subject'          => ['required'],
    ];


    public function render(): View|Factory
    {
        return view('livewire.admin.email.edit');
    }

    public function editModal($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->email_setting = EmailTemplate::whereId($id)->firstOrFail();
        $this->description = $this->email_setting->description;
        $this->message = $this->email_setting->message;
        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->email_setting->description  = $this->description;
        
        $this->email_setting->save();

        $this->alert('success', __('Email template created successfully.'));
        
        $this->emit('refreshIndex');

        $this->editModal = false;
    }
}
