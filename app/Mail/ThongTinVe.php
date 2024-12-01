<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ThongTinVe extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $ve;
    public $food;
    public $ghe;
    public $urlCode;
    public function __construct($ve, $food, $ghe, $urlCode)
    {
        $this->ve = $ve;
        $this->food = $food;
        $this->ghe = $ghe;
        $this->urlCode = $urlCode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thông tin vé xem phim',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.ThongTinVe',
            with: [
                've' => $this->ve,
                'food' => $this->food,
                'ghe' => $this->ghe,
                'urlCode' => $this->urlCode,
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
