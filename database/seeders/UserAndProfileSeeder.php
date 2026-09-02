<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AlumniProfile;
use Illuminate\Support\Facades\Hash;

class UserAndProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@alumnispace.id'],
            [
                'name' => 'Administrator Alumni',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        AlumniProfile::firstOrCreate(
            ['user_id' => $admin->id],
            [
                'student_number' => 'ADM-001',
                'graduation_year' => 2010,
                'major' => 'Rekayasa Perangkat Lunak',
                'profession' => 'Admin & IT Support',
                'company' => 'Sekolah Ceria',
                'city' => 'Jakarta Selatan',
                'phone_number' => '081234567890',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300',
                'bio' => 'Pengurus pusat data dan komunitas alumni.',
                'is_verified' => true,
                'is_online' => true,
            ]
        );

        // Demo Alumni list from views
        $alumniList = [
            [
                'name' => 'Kanya Salsabila',
                'email' => 'kanya.salsabila@alumni.id',
                'graduation_year' => 2019,
                'major' => 'Multimedia',
                'profession' => 'UI/UX Lead Designer',
                'company' => 'Kreasi Digital Nusantara',
                'city' => 'Jakarta Selatan',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300',
                'bio' => 'Passionate in creating lovable digital products.',
                'is_online' => true,
                'is_verified' => true,
                'linkedin_url' => 'https://linkedin.com',
                'instagram_url' => 'https://instagram.com',
            ],
            [
                'name' => 'Rangga Pratama',
                'email' => 'rangga.pratama@alumni.id',
                'graduation_year' => 2015,
                'major' => 'Rekayasa Perangkat Lunak',
                'profession' => 'Software Engineer',
                'company' => 'Sinergi Teknologi',
                'city' => 'Bandung',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300',
                'bio' => 'Fullstack web developer and startup enthusiast.',
                'is_online' => true,
                'is_verified' => true,
                'linkedin_url' => 'https://linkedin.com',
                'github_url' => 'https://github.com',
            ],
            [
                'name' => 'Nabila Zahra',
                'email' => 'nabila.zahra@alumni.id',
                'graduation_year' => 2018,
                'major' => 'Teknik Komputer & Jaringan',
                'profession' => 'Product Manager',
                'company' => 'Unicorn Edukasi',
                'city' => 'Jakarta Barat',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300',
                'bio' => 'Building impactful edtech platforms.',
                'is_online' => false,
                'is_verified' => true,
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url' => 'https://twitter.com',
            ],
            [
                'name' => 'Dimas Anggara',
                'email' => 'dimas.anggara@alumni.id',
                'graduation_year' => 2020,
                'major' => 'Desain Komunikasi Visual',
                'profession' => 'Content Creator & Founder',
                'company' => 'Matchora Media',
                'city' => 'Surabaya',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300',
                'bio' => 'Visual storyteller and creative strategist.',
                'is_online' => true,
                'is_verified' => true,
                'youtube_url' => 'https://youtube.com',
                'instagram_url' => 'https://instagram.com',
            ],
            [
                'name' => 'Kak Bayu',
                'email' => 'bayu.2016@alumni.id',
                'graduation_year' => 2016,
                'major' => 'Pemasaran',
                'profession' => 'Growth Lead',
                'company' => 'Nusantara Media',
                'city' => 'Jakarta',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300',
                'is_online' => true,
                'is_verified' => true,
            ],
            [
                'name' => 'Kak Dewi',
                'email' => 'dewi.2020@alumni.id',
                'graduation_year' => 2020,
                'major' => 'Desain Komunikasi Visual',
                'profession' => 'Art Director',
                'company' => 'Matchora Studio',
                'city' => 'Bandung',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300',
                'is_online' => false,
                'is_verified' => true,
            ],
            [
                'name' => 'Kak Fajar',
                'email' => 'fajar.2015@alumni.id',
                'graduation_year' => 2015,
                'major' => 'Rekayasa Perangkat Lunak',
                'profession' => 'Principal Engineer',
                'company' => 'Sinergi Teknologi',
                'city' => 'Yogyakarta',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300',
                'is_online' => true,
                'is_verified' => true,
            ],
            [
                'name' => 'Kak Reza',
                'email' => 'reza.2017@alumni.id',
                'graduation_year' => 2017,
                'major' => 'Logistik',
                'profession' => 'Supply Chain Manager',
                'company' => 'Logistik Kawan',
                'city' => 'Surabaya',
                'avatar' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=300',
                'is_online' => true,
                'is_verified' => true,
            ],
        ];

        foreach ($alumniList as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password123'),
                    'role' => 'alumni',
                    'is_active' => true,
                ]
            );

            AlumniProfile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'student_number' => 'ALM-' . $data['graduation_year'] . '-' . str_pad($user->id, 3, '0', STR_PAD_LEFT),
                    'graduation_year' => $data['graduation_year'],
                    'major' => $data['major'] ?? 'Umum',
                    'profession' => $data['profession'],
                    'company' => $data['company'],
                    'city' => $data['city'],
                    'phone_number' => '08' . rand(1111111111, 9999999999),
                    'avatar' => $data['avatar'],
                    'bio' => $data['bio'] ?? 'Alumni berdedikasi dan siap saling mendukung.',
                    'is_online' => $data['is_online'] ?? true,
                    'is_verified' => $data['is_verified'] ?? true,
                    'linkedin_url' => $data['linkedin_url'] ?? null,
                    'instagram_url' => $data['instagram_url'] ?? null,
                    'github_url' => $data['github_url'] ?? null,
                    'twitter_url' => $data['twitter_url'] ?? null,
                    'youtube_url' => $data['youtube_url'] ?? null,
                ]
            );
        }
    }
}
