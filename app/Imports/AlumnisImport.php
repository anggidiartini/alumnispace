<?php

namespace App\Imports;

use App\Models\AlumniProfile;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumnisImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            // Validasi data penting (minimal nama)
            if (empty($row['nama_lengkap'])) {
                continue;
            }

            $email = $row['email'];
            if (empty($email)) {
                $baseSlug = Str::slug($row['nama_lengkap']);
                if (empty($baseSlug)) {
                    $baseSlug = 'alumni';
                }
                $email = $baseSlug . '.' . rand(100, 9999) . '@alumni.id';
            }

            // Cek apakah email sudah ada untuk mencegah duplikasi
            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $row['nama_lengkap'],
                    'email' => $email,
                    'password' => Hash::make('password123'), // Default password
                    'role' => 'user',
                    'is_active' => 1,
                ]);
            }

            // Cek profile
            $profile = AlumniProfile::where('user_id', $user->id)->first();
            
            if (!$profile) {
                AlumniProfile::create([
                    'user_id' => $user->id,
                    'slug' => Str::slug($user->name . '-' . rand(100, 999)),
                    'student_number' => $row['nomor_induk_nim'] ?? null,
                    'graduation_year' => $row['tahun_lulus'] ?? null,
                    'major' => $row['jurusan'] ?? null,
                    'profession' => $row['profesi'] ?? null,
                    'company' => $row['perusahaan_instansi'] ?? null,
                    'city' => $row['kota'] ?? null,
                    'phone_number' => $row['no_hp_wa'] ?? null,
                    'study_status' => $row['status_studi'] ?? 'Aktif',
                ]);
            }
        }
    }
}
