<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Subscriber;
use App\Models\User;
use App\Mail\SubscribedMail;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class Newsletters extends Component
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

    protected $rules = [    
            'email' => 'required|email',
    ]; 


    public function render(): View|Factory
    {
        return view('livewire.front.newsletters');
    }
   
     public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function subscribe()
    {
        try {
            $validatedData = $this->validate();

            Subscriber::create($validatedData);

            $this->alert('success', __('Your are subscribed to our newsletters.') );

            $this->resetInputFields();

            $user = User::find(1);
        
            $user_email = $user->email;

            Mail::to($user_email)->send(new SubscribedMail());
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
