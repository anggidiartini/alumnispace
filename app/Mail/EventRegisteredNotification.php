<?php

namespace App\Mail;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventRegisteredNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct(EventRegistration $registration)
    {
        // Memuat relasi agar data user dan event ikut terbawa ke email
        $this->registration = $registration->load(['event', 'user']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pendaftaran Baru Event: ' . $this->registration->event->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: "
                <h3>Notifikasi Pendaftaran Event Baru</h3>
                <p>Halo Panitia, seseorang telah mendaftar pada event Anda.</p>
                <hr>
                <ul>
                    <li><strong>Nama Pendaftar:</strong> {$this->registration->user->name}</li>
                    <li><strong>Email Pendaftar:</strong> {$this->registration->user->email}</li>
                    <li><strong>Nama Event:</strong> {$this->registration->event->title}</li>
                    <li><strong>Kode Tiket:</strong> {$this->registration->ticket_code}</li>
                    <li><strong>Waktu Daftar:</strong> {$this->registration->created_at}</li>
                </ul>
            "
        );
    }
}
