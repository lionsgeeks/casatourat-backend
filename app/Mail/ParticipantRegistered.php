<?php

namespace App\Mail;

use App\Models\CMEventParticipant;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Barryvdh\DomPDF\Facade\Pdf;

class ParticipantRegistered extends Mailable
{

    /**
     * @param CMEventParticipant $participant
     * @param string             $qrBase64    Base64-encoded SVG of the QR code
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
        $filename = 'event-qr-ticket-' . $this->participant->id . '.pdf';

        return [
            Attachment::fromData(fn() => $this->buildQrTicketPdf(), $filename)
                ->withMime('application/pdf'),
        ];
    }

    private function buildQrTicketPdf(): string
    {
        return Pdf::loadView('emails.participant.qr-ticket-pdf', [
            'participant' => $this->participant,
            'qrBase64' => $this->qrBase64,
        ])->setPaper('a4')->output();
    }
}
