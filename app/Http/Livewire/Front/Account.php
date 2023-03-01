<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Account extends Component
{
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
        'email' => 'email',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'address' => 'max:255',
        'phone' => 'required|numeric|max:1O',
        'city' => 'city|string',
        'country' => 'nullable',
    ];

    public function mount(User $user)
    {
        $user = User::find(Auth::user()->id);
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->address = $user->address;
        $this->phone = $user->phone;
        $this->city = $user->city;
        $this->country = $user->country;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    public function save()
    {
        $this->user = User::find(Auth::user()->id);

        $this->validate();

        if ($this->password !== '') {
            $this->user->password = bcrypt($this->password);
        }

        $this->user->update();
    }

    public function render()
    {
        return view('livewire.front.account');
    }
}
