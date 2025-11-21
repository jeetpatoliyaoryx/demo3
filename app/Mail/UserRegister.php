<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $plainPassword;

    public function __construct($user, $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }


    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Welcome ' . $this->user->name . ' - Your Account Details')
            ->view('emails.user_register')
            ->with([
                'user' => $this->user,
                'password' => $this->plainPassword,
            ]);
    }
}
