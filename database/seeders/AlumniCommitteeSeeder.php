<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumniCommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alumni_committees')->insert([
            // Pengurus untuk Periode 2024 - 2025 (ID Periode: 1)
            [
                'jabatan' => 'Ketua Umum Alumni',
                'alumni_profile_id' => 3, // Rangga Pratama (RPL - 2015)
                'committee_period_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Sekretaris',
                'alumni_profile_id' => 2, // Kanya Salsabila (Multimedia - 2019)
                'committee_period_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Divisi Hubungan Masyarakat',
                'alumni_profile_id' => 5, // Dimas Anggara (DKV - 2020)
                'committee_period_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pengurus untuk Periode 2025 - 2026 (ID Periode: 2)
            [
                'jabatan' => 'Ketua Umum Alumni',
                'alumni_profile_id' => 6, // Kak Bayu (Pemasaran - 2016)
                'committee_period_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan' => 'Divisi Kreatif & Acara',
                'alumni_profile_id' => 5, // Dimas Anggara (DKV - 2020)
                'committee_period_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
