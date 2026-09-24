<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermintaanDarahMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data; // Properti publik agar bisa diakses di view

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notifikasi Permintaan Darah Baru',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.permintaan_darah', // Pastikan file ini ada
        );
    }
}