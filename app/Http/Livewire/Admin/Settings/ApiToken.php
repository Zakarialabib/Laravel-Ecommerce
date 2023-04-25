<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;

class ApiToken extends Component
{
    public $token;

    public $authenticated = false;

    public function createToken()
    {
        $this->resetErrorBag();

        $this->token = auth()->user()->createToken('api-token')->plainTextToken;
    }

    public function deleteToken()
    {
        auth()->user()->tokens()->delete();

        $this->token = null;
        $this->authenticated = false;
    }

    public function render()
    {
        return view('livewire.settings.api-token');
    }
}
