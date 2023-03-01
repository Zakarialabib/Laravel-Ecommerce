<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $listeners = ['createUser'];

    public $createUser;

    public $user;

    public array $rules = [
        'user.name' => 'required|string|max:255',
        'user.email' => 'required|email|unique:users,email',
        'user.password' => 'required|string|min:8',
        'user.phone' => 'required|numeric',
        'user.city' => 'nullable',
        'user.country' => 'nullable',
        'user.address' => 'nullable',
        'user.tax_number' => 'nullable',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.users.create');
    }

    public function createUser()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createUser = true;
    }

    public function create()
    {
        $this->validate();

        $this->user->save();

        $this->emit('userCreated');

        $this->createUser = false;
    }
}
