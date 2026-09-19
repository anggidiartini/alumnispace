<?php

namespace App\Exports;

use App\Models\EventRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventRegistrationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $eventId;
    private $rowNumber = 0;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    public function collection(): \Illuminate\Support\Collection
    {
        return EventRegistration::with('user')
            ->where('event_id', $this->eventId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Kode Tiket',
            'Nama Pendaftar',
            'Email',
            'Nomor HP',
            'Jumlah Tiket',
            'Status',
            'Waktu Mendaftar',
        ];
    }

    public function map($registration): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $registration->ticket_code,
            $registration->name ?? ($registration->user->name ?? 'Anonim'),
            $registration->email ?? ($registration->user->email ?? '-'),
            $registration->phone ?? '-',
            $registration->quantity,
            $registration->status === 'cancelled' ? 'Dibatalkan' : 'Terkonfirmasi',
            $registration->created_at ? $registration->created_at->format('Y-m-d H:i:s') : '-',
        ];
    }
}
