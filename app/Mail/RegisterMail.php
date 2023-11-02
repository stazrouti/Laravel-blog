<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\User; 

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($userEmail, $verificationCode)
    {
        $this->userEmail = $userEmail;
        $this->verificationCode = $verificationCode;
    }
    public function build()
    {
        return $this
            ->subject('Register Mail')
            ->view('Authentification.custom-verify-email') // Specify your email template view.
            ->with([
                'userEmail' => $this->userEmail,
                'verificationCode' => $this->verificationCode,
            ]); // Pass user data to the view.
    }

    /**
     * Get the message envelope.
     */
/*     public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Register Mail',
        );
    }

    
     // Get the message content definition.
     
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    } */

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
