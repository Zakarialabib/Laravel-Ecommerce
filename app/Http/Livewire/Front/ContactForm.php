<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Conversation; 
use App\Mail\ContactForm as MailContactForm;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ContactForm extends Component
{
    // public Conversation $conversation;
    
    public $name, $email, $phone_number, $message;
    
    protected $listeners = [
        'submit',
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->message = '';
    }

    public function mount()
    {
        // $this->conversation = $conversation;
    }  

    public function render()
    {
        return view('livewire.contact-form');
    }

    protected $rules = [    
        'conversation.name' => 'required',
        'conversation.email' => 'required|email',
        'conversation.phone_number' => 'required',
        'conversation.message' => 'required'
    ]; 

    public function submit()
    {
        
        $this->validate();

        $this->conversation->save();

        // $this->alert('success', __('Your Message is sent succesfully.') );

        $this->resetInputFields();

        // $user = User::find(1);
        // $user_email = $user->email;
        // Mail::to($user_email)->send(new MailContactForm($contact));

    }
}
