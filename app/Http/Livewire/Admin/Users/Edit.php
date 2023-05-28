<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public $listeners = [
        'editModal',
    ];

    public $editModal = false;

    public $user;

    public array $rules = [
        'user.first_name' => 'required|string|max:255',
        'user.email'      => 'required|email',
        'user.password'   => 'required|string|min:8',
        'user.phone'      => 'required|numeric',
        'user.password_confirmation' => 'password',
        'user.city'       => 'nullable',
        'user.country'    => 'nullable',
        'user.address'    => 'nullable',
        'user.tax_number' => 'nullable',
    ];

    public function editModal($user)
    {
        // abort_if(Gate::denies('user_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->user = User::findOrfail($user);

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name'       => $this->user->name,
            'email'      => $this->user->email,
            'password'   => bcrypt($this->user->password),
            'phone'      => $this->user->phone,
            'city'       => $this->user->city,
            'country'    => $this->user->country,
            'address'    => $this->user->address,
            'tax_number' => $this->user->tax_number,
        ]);

        $this->alert('success', __('User Updated Successfully'));
        
        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.users.edit');
    }
}
