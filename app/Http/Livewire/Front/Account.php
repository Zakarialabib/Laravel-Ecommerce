<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Account extends Component
{
    use LivewireAlert;

    public $user;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $country;

    public string $password = '';

    protected $listeners = [
        'submit',
    ];

    protected $rules = [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name'  => ['required', 'string', 'max:255'],
        'email'      => ['required', 'string', 'email', 'max:255'],
        'phone'      => ['required', 'string', 'max:255'],
        'city'       => ['required', 'string', 'max:255'],
        'address'    => ['required', 'string', 'max:255'],
    ];

    public function mount()
    {
        $this->user = User::find(Auth::user()->id);
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->address = $this->user->address;
        $this->phone = $this->user->phone;
        $this->city = $this->user->city;
        $this->country = $this->user->country;
        $this->email = $this->user->email;
        $this->password = $this->user->password;
    }

    public function save()
    {
        $this->validate();

        if ($this->password !== '') {
            $this->user->password = bcrypt($this->password);
        }

        $this->user->update();

        $this->alert(
            'success',
            __('your account has been updated successfully!'),
            [
                'position'          => 'center',
                'timer'             => 3000,
                'toast'             => true,
                'text'              => '',
                'confirmButtonText' => 'Ok',
                'cancelButtonText'  => 'Cancel',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]
        );
    }

    public function render()
    {
        return view('livewire.front.account');
    }
}
