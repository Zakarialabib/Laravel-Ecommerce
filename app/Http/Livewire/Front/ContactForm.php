<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Contact; 
use App\Mail\ContactForm as MailContactForm;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContactForm extends Component
{
    use LivewireAlert;

    public $contact;
    
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

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }  

    public function render()
    {
        return view('livewire.front.contact-form');
    }

    protected $rules = [    
        'contact.name' => 'required',
            'contact.email' => 'required|email',
            'contact.phone_number' => 'required',
            'contact.message' => 'required'
    ]; 

    public function submit()
    {
        
        $this->validate();

        $this->contact->save();

        $this->alert('success', __('Your Message is sent succesfully.') );

        $this->resetInputFields();

        $user = User::find(1);
        $user_email = $user->email;
        Mail::to($user_email)->send(new MailContactForm($contact));

    }
}
