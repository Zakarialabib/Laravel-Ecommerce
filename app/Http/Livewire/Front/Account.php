<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Account extends Component
{

    public $customer, $first_name, $last_name, $phone, $email, $address,
            $city, $country;

    public string $password = '';
   
    protected $listeners = [
        'submit',
    ];

    public function mount(User $customer)
    {
        // $customer =   User::find(Auth::user()->id);
        $this->first_name      = $customer->first_name;
        $this->last_name      = $customer->last_name;
        $this->address       = $customer->address;
        $this->phone         = $customer->phone;
        $this->city         = $customer->city;
        $this->country         = $customer->country;
        $this->email         = $customer->email;
        $this->password         = $customer->password;
        
    }

    protected $rules = [    
        'email'          => 'email',
        'first_name'        => 'required|string',
        'last_name'        => 'required|string',
        'address'       => 'max:255',
        'phone'       => 'required|numeric|max:1O',
        'city'       => 'city|string',
        'country'       => 'nullable',
    ];

    public function save()
    {

            $this->user = User::find(Auth::user()->id);
            
            $this->validate();
            
            if($this->password !== '')
            $this->user->password = bcrypt($this->password);

            $this->user->update();
           
    }

    public function render()
    {
        return view('livewire.front.account');
    }
}
