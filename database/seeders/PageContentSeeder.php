<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;
use App\Models\SiteSetting;
use App\Models\User;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $adminId = $admin?->id;

        // Dynamic Page Contents for 'home'
        $contents = [
            [
                'page_slug' => 'home',
                'section_key' => 'hero_banner',
                'title' => 'Satu komunitas, banyak cerita',
                'subtitle' => 'Tempat pulang untuk terhubung, bertukar kabar, dan tumbuh bersama alumni lintas angkatan.',
                'body_content' => 'Selamat datang di markas digital kita tercinta! Tempat paling pas buat temu kangen, intip kabar terbaru, dan saling dukung.',
                'meta_data' => [
                    'badge' => '✦ Ruang hangat untuk kita',
                    'primary_button_text' => 'Buka Direktori Alumni',
                    'primary_button_link' => '#alumni',
                    'secondary_button_text' => 'Pelajari Dulu',
                    'secondary_button_link' => '#tentang',
                ],
                'is_active' => true,
                'created_by' => $adminId,
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'locked_teaser',
                'title' => '4 fitur seru menanti setelah kamu login.',
                'subtitle' => 'Direktori alumni, album kenangan, lowongan, dan agenda event hanya bisa dibuka oleh alumni yang sudah login.',
                'body_content' => null,
                'meta_data' => [
                    'badge' => 'Khusus alumni terdaftar',
                    'button_text' => 'Login sekarang 🚀',
                ],
                'is_active' => true,
                'created_by' => $adminId,
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'alumni_section',
                'title' => 'Temukan teman seperjalanan.',
                'subtitle' => 'Jelajahi profil ribuan alumni terverifikasi almamater.',
                'body_content' => null,
                'meta_data' => [
                    'badge' => 'Direktori alumni',
                ],
                'is_active' => true,
                'created_by' => $adminId,
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'about_section',
                'title' => 'Jalin kembali koneksi yang berarti.',
                'subtitle' => 'Alumni Connect adalah ruang komunitas yang memudahkanmu menemukan teman lama, membuka peluang baru, dan merayakan setiap langkah bersama.',
                'body_content' => null,
                'meta_data' => [
                    'badge' => 'Tentang kami',
                    'card_title' => 'Dari sekolah, untuk selamanya.',
                ],
                'is_active' => true,
                'created_by' => $adminId,
            ],
            [
                'page_slug' => 'home',
                'section_key' => 'cta_footer',
                'title' => 'Masih ada tempat untuk ceritamu di sini.',
                'subtitle' => 'Datang, sapa teman lama, dan buka kesempatan baru bersama komunitas alumni.',
                'body_content' => null,
                'meta_data' => [
                    'button_text' => 'Masuk ke Komunitas',
                ],
                'is_active' => true,
                'created_by' => $adminId,
            ],
        ];

        foreach ($contents as $item) {
            PageContent::updateOrCreate(
                [
                    'page_slug' => $item['page_slug'],
                    'section_key' => $item['section_key'],
                ],
                $item
            );
        }

        // Global Site Settings
        $settings = [
            [
                'group' => 'branding',
                'key' => 'brand_name',
                'value' => 'Alumni Connect',
                'data_type' => 'string',
                'is_public' => true,
                'description' => 'Nama platform / branding portal alumni',
            ],
            [
                'group' => 'contact',
                'key' => 'whatsapp_number',
                'value' => '+6281234567890',
                'data_type' => 'string',
                'is_public' => true,
                'description' => 'Nomor WhatsApp kontak pengurus alumni',
            ],
            [
                'group' => 'contact',
                'key' => 'contact_email',
                'value' => 'halo@alumniconnect.id',
                'data_type' => 'string',
                'is_public' => true,
                'description' => 'Email resmi pengurus alumni',
            ],
            [
                'group' => 'footer',
                'key' => 'footer_tagline',
                'value' => 'Koneksi yang terasa dekat, meski sudah jauh dari almamater.',
                'data_type' => 'string',
                'is_public' => true,
                'description' => 'Tagline pada footer website',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
