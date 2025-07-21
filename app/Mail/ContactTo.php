<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;

use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactTo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $contact;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
         $this->contact = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
      return new Envelope(
          from: new Address(config('mail.from.address'), config('app.name')),
          replyTo: [new Address(config('mail.admin.address'),config('mail.admin.name'))],

          subject: 'new contact from contact form '
      );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
		return new Content(
          view: 'emails.contact_to',
          with: ['data' => $this->contact]
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
