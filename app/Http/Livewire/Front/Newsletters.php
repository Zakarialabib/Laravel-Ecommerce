<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Newsletter;
use App\Mail\SubscribedMail;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class NewslettersForm extends Component
{
    use LivewireAlert;

    public $newsletter;
    
    public $email;
    
    protected $listeners = [
        'submit',
    ];

     /* @var array */
    private function resetInputFields(){
        $this->email = '';
    }

    public function mount(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }  

    public function render()
    {
        return view('livewire.front.newsletters');
    }

    protected $rules = [    
            'newsletter.email' => 'required|email',
    ]; 

    public function newsletterform()
    {
        
        $this->validate();

        $this->newsletter->save();

        $this->alert('success', __('Your are subscribed to our newsletters.') );

        $this->resetInputFields();

        $user = User::find(1);
        
        $user_email = $user->email;

        Mail::to($user_email)->send(new SubscribedMail());


    }
    
}
