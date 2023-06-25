<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Email;

use App\Models\EmailTemplate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = ['createModal'];

    public $createModal;
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
            'email_setting.status'           => ['required'],
    ];


    public function render(): View|Factory
    {
        return view('livewire.admin.email.create');
    }

    public function createModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->email_setting = new EmailTemplate();
        $this->description ="";
        $this->message ="";
        $this->createModal = true;
    }

    public function create()
    {
        $this->validate();

        $this->email_setting->description  = $this->description;
        $this->email_setting->message  = $this->message;
        
        $this->email_setting->save();

        $this->alert('success', __('Email template created successfully.'));
        
        $this->emit('refreshIndex');

        $this->createModal = false;
    }
}
