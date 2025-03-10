<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SchoolMailer extends Mailable
{
    use Queueable, SerializesModels;

   
    public $mailMessage;
    public $subject;
    public $emailLink;

    /**
     * Create a new message instance.
     */
    public function __construct($mailMessage, $subject, $emailLink)
    {
        $this->mailMessage = $mailMessage;
        $this->subject = $subject;
        $this->emailLink = $emailLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.basic',
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
