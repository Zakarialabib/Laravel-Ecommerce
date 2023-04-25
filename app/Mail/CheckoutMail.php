<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\User;

class CheckoutMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $order;

    public $user;

    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.checkout')
            ->subject('Order Confirmation ', $this->user->first_name)
            ->with([
                'order' => $this->order,
                'user'  => $this->user,
            ]);
    }
}
