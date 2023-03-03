<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Mail\SubscribedMail;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class NewslettersForm extends Component
{
    use LivewireAlert;

    public $email;

    protected $listeners = [

    ];

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

            $this->alert('success', __('Your are subscribed to our newsletters.'));

            $this->resetInputFields();

            $user = User::find(1);

            $user_email = $user->email;

            Mail::to($user_email)->send(new SubscribedMail());
        } catch (\Throwable $th) {
            $this->alert('error', __('Error').$th->getMessage());
        }
    }

     /* @var array */
    private function resetInputFields()
    {
        $this->email = '';
    }
}
