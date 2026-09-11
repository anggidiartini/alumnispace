<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommitteePeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('committee_periods')->insert([
            [
                'id' => 1,
                'nama_periode' => 'Periode 2024 - 2025',
                'tanggal_mulai' => '2024-01-01',
                'tanggal_selesai' => '2025-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_periode' => 'Periode 2025 - 2026',
                'tanggal_mulai' => '2025-01-02',
                'tanggal_selesai' => '2026-01-02',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
