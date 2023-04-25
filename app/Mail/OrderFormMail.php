<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderFormMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $order;

    public function __construct(OrderForms $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->view('emails.order-form')
            ->subject('New Order Form!', $this->order->name)
            ->with([
                'order' => $this->order,
            ]);
    }
}
