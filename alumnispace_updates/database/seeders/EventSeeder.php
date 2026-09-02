<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $events = [
            [
                'created_by' => $admin?->id,
                'title' => 'Ngobrol Santai: Menembus Karir Tech Global Tanpa Harus Kuliah IT',
                'slug' => 'ngobrol-santai-karir-tech-global',
                'category' => 'Webinar',
                'badge_tag' => 'Webinar Karir',
                'banner_image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=500',
                'event_date' => '2026-09-15',
                'time_display' => '19:30 - 21:00 WIB via Zoom',
                'location_type' => 'online',
                'venue' => 'Online via Zoom',
                'description' => 'Sesi sharing eksklusif bersama alumni senior yang sukses berkarier di tech unicorn global tanpa background formal IT.',
                'quota' => 200,
                'status' => 'upcoming',
            ],
            [
                'created_by' => $admin?->id,
                'title' => 'Mini Reunion & Futsal Cup Antar Angkatan 2015-2020',
                'slug' => 'mini-reunion-futsal-cup',
                'category' => 'Meetup',
                'badge_tag' => 'Gathering Offline',
                'banner_image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=500',
                'event_date' => '2026-09-28',
                'time_display' => '08:00 - 13:00 WIB',
                'location_type' => 'offline',
                'venue' => 'Lapangan Pancoran Soccer Field',
                'description' => 'Ajang silaturahmi sehat dan temu kangen sambil bertanding futsal santai antar angkatan.',
                'quota' => 80,
                'status' => 'upcoming',
            ],
            [
                'created_by' => $admin?->id,
                'title' => 'Mastering Personal Branding di LinkedIn & IG untuk Profesional',
                'slug' => 'mastering-personal-branding',
                'category' => 'Workshop',
                'badge_tag' => 'Workshop',
                'banner_image' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=500',
                'event_date' => '2026-10-10',
                'time_display' => '13:00 - 16:00 WIB',
                'location_type' => 'offline',
                'venue' => 'Co-working Space Jaksel',
                'description' => 'Bedah strategi membangun reputasi profesional yang memikat recruiter dan calon klien di ranah digital.',
                'quota' => 45,
                'status' => 'upcoming',
            ],
            [
                'created_by' => $admin?->id,
                'title' => 'Gathering Santai Edisi Kemerdekaan',
                'slug' => 'gathering-santai-edisi-kemerdekaan',
                'category' => 'Meetup',
                'badge_tag' => 'Meetup',
                'banner_image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500',
                'event_date' => '2026-08-15',
                'time_display' => '16:00 - 20:00 WITA',
                'location_type' => 'offline',
                'venue' => 'Denpasar, Bali',
                'description' => 'Keseruan kumpul-kumpul sambil ngobrolin seputar perkembangan dunia kerja kreatif lintas angkatan di salah satu cafe hits Bali.',
                'quota' => 50,
                'status' => 'completed',
            ],
            [
                'created_by' => $admin?->id,
                'title' => 'Webinar UI/UX & AI Integration',
                'slug' => 'webinar-ui-ux-ai-integration',
                'category' => 'Webinar',
                'badge_tag' => 'Webinar',
                'banner_image' => 'https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=500',
                'event_date' => '2026-07-28',
                'time_display' => '19:00 - 21:00 WIB',
                'location_type' => 'online',
                'venue' => 'Online via Zoom',
                'description' => 'Sesi sharing intensif bersama para alumni senior yang membedah bagaimana memanfaatkan AI untuk efisiensi desain produk.',
                'quota' => 300,
                'status' => 'completed',
            ],
            [
                'created_by' => $admin?->id,
                'title' => 'Workshop Kilat: Ngoding Bareng PHP & XAMPP',
                'slug' => 'workshop-kilat-ngoding-php-xampp',
                'category' => 'Workshop',
                'badge_tag' => 'Workshop',
                'banner_image' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=500',
                'event_date' => '2026-06-10',
                'time_display' => '09:00 - 15:00 WIB',
                'location_type' => 'offline',
                'venue' => 'Lab Komputer Utama',
                'description' => 'Peserta antusias serius ngulik database dan debugging kode bersama mentor alumni di lab kampus.',
                'quota' => 30,
                'status' => 'completed',
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(['slug' => $event['slug']], $event);
        }
    }
}
