<?php

namespace App\Mail;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewClaimMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Claim $claim
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ada Klaim Baru di FoodBridge!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.new-claim',
        );
    }
}