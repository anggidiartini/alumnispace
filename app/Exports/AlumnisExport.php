<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumnisExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        return DB::table('alumni_profiles')
            ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
            ->select(
                'users.name',
                'users.email',
                'alumni_profiles.student_number',
                'alumni_profiles.graduation_year',
                'alumni_profiles.major',
                'alumni_profiles.profession',
                'alumni_profiles.company',
                'alumni_profiles.city',
                'alumni_profiles.phone_number',
                'alumni_profiles.study_status'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama Lengkap',
            'Email',
            'Nomor Induk / NIM',
            'Tahun Lulus',
            'Jurusan',
            'Profesi',
            'Perusahaan / Instansi',
            'Kota',
            'No HP / WA',
            'Status Studi',
        ];
    }

    public function map($row): array
    {
        $this->rowNumber++;
        return [
            $this->rowNumber,
            $row->name,
            $row->email,
            $row->student_number,
            $row->graduation_year,
            $row->major,
            $row->profession,
            $row->company,
            $row->city,
            $row->phone_number,
            $row->study_status,
        ];
    }
}
