<?php

namespace App\Mail;

use App\Models\CMEventParticipant;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ParticipantRegistered extends Mailable
{

    /**
     * @param CMEventParticipant $participant
     * @param string             $qrBase64    Base64-encoded PNG of the QR code
     */
    public function __construct(
        public readonly CMEventParticipant $participant,
        public readonly string $qrBase64,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Registration is Confirmed ✓',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.participant.registered',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
