<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class appointmentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $appointment;
    public $test;
    /**
     * Create a new message instance.
     */
    public function __construct($appointment,$test)
    {
         $this->appointment = $appointment;
         $this->test=$test;
    }

    /**
     * Get the message envelope.
     */
     public function build()
     {
        return $this->view('appointment');
     }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'appointment',
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
