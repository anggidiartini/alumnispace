<?php

namespace App\Exports;

use App\Models\JobVacancy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JobVacanciesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Nomor urut data Excel.
     */
    private int $rowNumber = 0;

    /**
     * Mengambil seluruh data lowongan kerja.
     */
    public function collection(): \Illuminate\Support\Collection
    {
        return JobVacancy::query()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();
    }

    /**
     * Judul kolom Excel menggunakan bahasa Indonesia.
     */
    public function headings(): array
    {
        return [
            'No.',
            'ID Lowongan',
            'ID Kategori',
            'ID Pengunggah',
            'ID Perusahaan',

            'Nama Perusahaan',
            'Logo Perusahaan',
            'Deskripsi Perusahaan',
            'URL Peta Perusahaan',
            'Website Perusahaan',
            'Instagram Perusahaan',
            'LinkedIn Perusahaan',
            'Kontak Alumni',

            'Posisi Lowongan',
            'Slug',
            'Kategori Pekerjaan',
            'Skill yang Dibutuhkan',
            'Sifat Pekerjaan',
            'Sistem Kerja',
            'Lokasi Penempatan',
            'Informasi Gaji',
            'Jenis Gaji',
            'Badge Sorotan',

            'Deskripsi Pekerjaan',
            'Syarat Kualifikasi',

            'Tautan Lamaran',
            'Email Lamaran',
            'Batas Waktu Lamaran',

            'Status Lowongan',
            'Tanggal Dibuat',
            'Terakhir Diperbarui',
            'Total Pelamar',
        ];
    }

    /**
     * Mengubah setiap data lowongan menjadi satu baris Excel.
     */
    public function map($job): array
    {
        $this->rowNumber++;

        /*
         * Skill dapat tersimpan dalam format JSON.
         * Ubah menjadi teks yang mudah dibaca.
         */
        $skills = $this->formatSkills(
            $job->skills_tags ?? null
        );

        /*
         * Hitung total pelamar.
         * Jika tabel atau kolom relasi tidak tersedia,
         * tampilkan 0 agar tidak terjadi error.
         */
        $applicantsCount = 0;

        if (
            Schema::hasTable('job_applications')
            && Schema::hasColumn(
                'job_applications',
                'job_vacancy_id'
            )
        ) {
            $applicantsCount = DB::table('job_applications')
                ->where('job_vacancy_id', $job->id)
                ->count();
        }

        /*
         * Format tanggal agar konsisten.
         */
        $deadline = $job->deadline ?? null;

        if (!empty($deadline)) {
            try {
                $deadline = \Carbon\Carbon::parse($deadline)
                    ->format('d-m-Y');
            } catch (\Throwable $e) {
                // Pertahankan nilai asli jika format tidak valid.
            }
        } else {
            $deadline = '-';
        }

        $createdAt = $job->created_at
            ? \Carbon\Carbon::parse($job->created_at)
                ->format('d-m-Y H:i:s')
            : '-';

        $updatedAt = $job->updated_at
            ? \Carbon\Carbon::parse($job->updated_at)
                ->format('d-m-Y H:i:s')
            : '-';

        /*
         * Konversi status menjadi teks.
         */
        $status = (int) ($job->is_active ?? 0) === 1
            ? 'Buka'
            : 'Tutup';

        return [
            $this->rowNumber,

            $job->id ?? '-',
            $job->category_id ?? '-',
            $job->posted_by ?? '-',
            $job->company_id ?? '-',

            $job->company_name ?? '-',
            $job->company_logo ?? '-',
            $job->company_description ?? '-',
            $job->company_maps_url ?? '-',
            $job->company_website ?? '-',
            $job->company_instagram ?? '-',
            $job->company_linkedin ?? '-',
            $job->alumni_contact ?? '-',

            $job->title ?? '-',
            $job->slug ?? '-',
            $job->category ?? '-',
            $skills,
            $job->job_type ?? '-',
            $job->workplace_type ?? '-',
            $job->location ?? '-',
            $job->salary_display ?? '-',
            $job->salary_type ?? '-',
            $job->highlight_badge ?? '-',

            $job->description ?? '-',
            $job->requirements ?? '-',

            $job->application_link ?? '-',
            $job->application_email ?? '-',
            $deadline,

            $status,
            $createdAt,
            $updatedAt,
            $applicantsCount,
        ];
    }

    /**
     * Merapikan skill dari format JSON menjadi teks biasa.
     */
    private function formatSkills($rawSkills): string
    {
        if (empty($rawSkills)) {
            return '-';
        }

        /*
         * Jika sudah berupa array, gunakan langsung.
         */
        if (is_array($rawSkills)) {
            $skills = $rawSkills;
        } else {
            $decoded = json_decode(
                (string) $rawSkills,
                true
            );

            if (json_last_error() === JSON_ERROR_NONE
                && is_array($decoded)) {
                $skills = $decoded;
            } else {
                /*
                 * Mendukung data lama yang menggunakan
                 * koma atau baris baru sebagai pemisah.
                 */
                $skills = preg_split(
                    '/[\r\n,]+/',
                    (string) $rawSkills
                );
            }
        }

        $skills = array_values(array_filter(
            array_map(
                fn ($skill) => trim((string) $skill),
                $skills
            ),
            fn ($skill) => $skill !== ''
        ));

        if (empty($skills)) {
            return '-';
        }

        return implode(', ', $skills);
    }
}
