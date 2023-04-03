<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChatInvitationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $inviter,
        public $invitation
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            subject: config('app.name') . ' Invitation',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.chat-invitation',
            with: [
                'accept_url' => url('/chat/'.$this->invitation.'/accept'),
                'decline_url' => url('/chat/'.$this->invitation.'/decline'),
            ]
        );
    }

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
