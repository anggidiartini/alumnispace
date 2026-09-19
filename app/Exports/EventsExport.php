<?php

namespace App\Exports;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventsExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    public function collection(): \Illuminate\Support\Collection
    {
        // Get all events with raw data
        return Event::latest('event_date')->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama Acara',
            'Kategori',
            'Tanggal Pelaksanaan',
            'Jam Pelaksanaan',
            'Tipe Lokasi',
            'Lokasi / Venue',
            'Kuota Total',
            'Tiket Terjual',
            'Status',
        ];
    }

    public function map($event): array
    {
        $usedQuota = DB::table('event_registrations')
            ->where('event_id', $event->id)
            ->where('status', '!=', 'cancelled')
            ->sum('quantity');

        $this->rowNumber++;

        return [
            $this->rowNumber,
            $event->title,
            $event->category,
            $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') : '-',
            trim(($event->start_time ?? '') . ' - ' . ($event->end_time ?? '')),
            ucfirst($event->location_type),
            $event->venue,
            $event->quota ?: 'Tidak dibatasi',
            $usedQuota,
            ucfirst($event->status),
        ];
    }
}
