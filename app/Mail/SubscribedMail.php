<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Request $form
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(('admin@mail.com'))
            ->replyTo(request()->input('email'))
            ->subject(__('Susbscription'), config('app.name'))
            ->subject(__('Thank you for your subscription'))
            ->markdown('vendor.notifications.email', [
                'introLines' => [__('We will get you updated once we will.')],
            ]);
    }
}
