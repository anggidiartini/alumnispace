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
    public $whatsappUrl;

    public function __construct(EventRegistration $registration)
    {
        // 1. Muat relasi user dan event
        $this->registration = $registration->load(['event', 'user']);

        // 2. Ambil nomor HP admin pembuat atau admin pusat untuk tujuan WA
        $event = $this->registration->event;
        $adminPusat = \App\Models\User::whereIn('role', ['admin', 'super_admin'])->first();
        $nomorWaPanitia = '6281234567890'; // Cadangan pusat jika kosong

        if ($adminPusat && $adminPusat->phone) {
            $nomorBersih = preg_replace('/[^0-9]/', '', $adminPusat->phone);
            if (str_starts_with($nomorBersih, '0')) {
                $nomorBersih = '62' . substr($nomorBersih, 1);
            }
            $nomorWaPanitia = $nomorBersih;
        }

        // 3. Susun teks pesan WhatsApp rapi yang nanti dikirim oleh user
        $pesanTeks = "Halo Panitia, saya telah mendaftar di Event Gratis ini dan ingin konfirmasi pendaftaran.\n\n"
                   . "📄 *DATA PENDAFTARAN*\n"
                    . "• Nama: " . $this->registration->user->name . "\n"
                    . "• Event: " . $event->title . "\n"
                    . "• Kode Tiket: " . $this->registration->ticket_code . "\n\n"
                    . "Mohon kesediaannya untuk memverifikasi data saya dan masukkan saya ke grup WhatsApp resmi event ini. Terima kasih! 🙏";

        $this->whatsappUrl = "https://wa.me" . $nomorWaPanitia . "?text=" . urlencode($pesanTeks);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Pendaftaran Event: ' . $this->registration->event->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px;'>
                    <h2 style='color: #2b6cb0; text-align: center;'>Pendaftaran Event Berhasil! 🎉</h2>
                    <p>Halo <strong>{$this->registration->user->name}</strong>,</p>
                    <p>Terima kasih telah mendaftar pada event kami. Berikut adalah rincian data pendaftaran Anda:</p>
                    
                    <div style='background-color: #f7fafc; padding: 15px; border-radius: 6px; margin: 20px 0;'>
                        <table style='width: 100%; border-collapse: collapse;'>
                            <tr><td style='padding: 5px 0;'><strong>Nama Event:</strong></td><td>{$this->registration->event->title}</td></tr>
                            <tr><td style='padding: 5px 0;'><strong>Kode Tiket:</strong></td><td style='color: #e53e3e; font-weight: bold;'>{$this->registration->ticket_code}</td></tr>
                            <tr><td style='padding: 5px 0;'><strong>Status:</strong></td><td><span style='background-color: #c6f6d5; color: #22543d; padding: 2px 8px; border-radius: 4px; font-size: 12px;'>Gratis / Registered</span></td></tr>
                        </table>
                    </div>

                    <p style='margin-bottom: 25px;'><strong>Langkah Selanjutnya:</strong> Untuk bergabung ke dalam grup WhatsApp resmi internal event ini, silakan lakukan konfirmasi langsung ke nomor WhatsApp panitia dengan menekan tombol di bawah ini:</p>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='{$this->whatsappUrl}' target='_blank' style='background-color: #25D366; color: white; padding: 12px 25px; text-decoration: none; font-weight: bold; border-radius: 5px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: inline-block;'>
                            💬 Konfirmasi ke WA Panitia & Masuk Grup
                        </a>
                    </div>

                    <hr style='border: 0; border-top: 1px solid #e0e0e0; margin: 30px 0;'>
                    <p style='font-size: 12px; color: #718096; text-align: center;'>Email ini dikirim otomatis oleh sistem Alumni Space. Mohon tidak membalas email ini.</p>
                </div>
            "
        );
    }
}
