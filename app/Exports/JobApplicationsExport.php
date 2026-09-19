<?php

namespace App\Exports;

use App\Models\JobApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JobApplicationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $jobId;
    private $rowNumber = 0;

    public function __construct($jobId)
    {
        $this->jobId = $jobId;
    }

    public function collection(): \Illuminate\Support\Collection
    {
        return JobApplication::with('applicant')
            ->where('job_vacancy_id', $this->jobId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama Pelamar',
            'Email',
            'Waktu Melamar',
            'URL Portofolio',
            'Surat Lamaran',
            'Status',
        ];
    }

    public function map($application): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $application->applicant->name ?? 'Anonim',
            $application->applicant->email ?? '-',
            $application->created_at ? $application->created_at->format('Y-m-d H:i:s') : '-',
            $application->portfolio_url ?? '-',
            $application->cover_letter ?? '-',
            ucfirst($application->status),
        ];
    }
}
