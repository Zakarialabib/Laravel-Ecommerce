<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\OrderForms;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class OrderForm extends Component
{
    use LivewireAlert;

    public $name;

    public $phone;

    public $address;

    public $type;

    public $status;

    public $subject;

    public $message;

    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render(): View|Factory
    {
        return view('livewire.front.order-form');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $order = OrderForms::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'type' => OrderForms::PRODUCT_FORM,
            'status' => OrderForms::STATUS_PENDING,
            'subject' => 'New request for '.$this->product->name,
            'message' => $this->name.' has sent a request for '.$this->product->name,
        ]);

        $this->alert('success', __('Your order has been sent successfully!'));

        $this->reset();
    }
}
