<?php

namespace App\Http\Livewire\Front;

use App\Mail\ContactForm as MailContactForm;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ContactForm extends Component
{
    use LivewireAlert;

    public $contact;

    public $name;
    public $email;
    public $phone_number;
    public $message;

    protected $listeners = [
        'submit',
    ];

    protected $rules = [
        'contact.name' => 'required',
        'contact.email' => 'required|email',
        'contact.phone_number' => 'required',
        'contact.message' => 'required',
    ];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        return view('livewire.front.contact-form');
    }

    public function submit()
    {
        $this->validate();

        $this->contact->save();

        $this->alert('success', __('Your Message is sent succesfully.'));

        $this->resetInputFields();

        $user = User::find(1);
        $user_email = $user->email;
        Mail::to($user_email)->send(new MailContactForm($contact));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->message = '';
    }
}
