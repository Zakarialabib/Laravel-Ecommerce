<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class CustomerRegistrationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.customer-registration')
            ->subject('Welcome to our website!', $this->user->name)
            ->with([
                'user' => $this->user,
            ]);
    }

    public function envelope()
    {
        return new Envelope(
            subject: sprintf('Welcome, %s!', $this->user->name),
        );
    }
}
