<?php

namespace App\Exports;

use App\Models\JobVacancy;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class JobVacanciesExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    public function collection(): \Illuminate\Support\Collection
    {
        return JobVacancy::orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama Perusahaan',
            'Posisi Lowongan',
            'Sifat Pekerjaan',
            'Sistem Kerja',
            'Lokasi',
            'Gaji',
            'Batas Waktu',
            'Total Pelamar',
            'Status',
        ];
    }

    public function map($job): array
    {
        $applicantsCount = DB::table('job_applications')
            ->where('job_vacancy_id', $job->id)
            ->count();

        $this->rowNumber++;

        return [
            $this->rowNumber,
            $job->company_name,
            $job->title,
            $job->job_type,
            $job->workplace_type,
            $job->location,
            $job->salary_display,
            $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') : '-',
            $applicantsCount,
            $job->is_active ? 'Buka' : 'Tutup',
        ];
    }
}
