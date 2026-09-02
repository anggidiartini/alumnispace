<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\AlbumPhoto;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = [
            [
                'title' => 'Class Trip',
                'slug' => 'class-trip-bandung',
                'category' => 'outdoor',
                'subtitle_label' => 'liburan sekelas',
                'sticker_tag' => 'seru banget!',
                'cover_photo' => 'assets/images/foto-4OUTDOOR.jpg',
                'event_date' => '2026-03-14',
                'date_display' => '14 Maret 2026 · Bandung',
                'location' => 'Bandung',
                'target_generation' => 'Angkatan 2018',
                'description' => 'Keseruan liburan bersama teman sekelas menjelajahi udara sejuk dan pemandangan asri Bandung.',
                'photos' => [
                    ['photo_path' => 'assets/images/foto-1.png', 'caption' => 'Momen kebersamaan di villa'],
                    ['photo_path' => 'assets/images/foto-2.png', 'caption' => 'Jalan-jalan santai sore'],
                    ['photo_path' => 'assets/images/foto-3.png', 'caption' => 'Foto rame-rame sebelum pulang'],
                ],
            ],
            [
                'title' => 'School Event',
                'slug' => 'school-event-aula',
                'category' => 'indoor',
                'subtitle_label' => 'panggung & sorak-sorai',
                'sticker_tag' => 'asik banget',
                'cover_photo' => 'assets/images/foto-6INDOOR.jpg',
                'event_date' => '2026-05-02',
                'date_display' => '2 Mei 2026 · Aula Sekolah',
                'location' => 'Aula Sekolah',
                'target_generation' => 'Semua Angkatan',
                'description' => 'Pentas seni, penampilan band, dan unjuk bakat kreatif seluruh siswa dan alumni.',
                'photos' => [
                    ['photo_path' => 'assets/images/foto-1.png', 'caption' => 'Penampilan band utama'],
                    ['photo_path' => 'assets/images/foto-2.png', 'caption' => 'Sorak gembira penonton'],
                ],
            ],
            [
                'title' => 'Class Gathering',
                'slug' => 'class-gathering-rumah-kayu',
                'category' => 'outdoor',
                'subtitle_label' => 'kumpul santai',
                'sticker_tag' => 'seru bareng',
                'cover_photo' => 'assets/images/foto-5OUTDOOR.jpg',
                'event_date' => '2026-06-19',
                'date_display' => '19 Juni 2026 · Cafe Rumah Kayu',
                'location' => 'Cafe Rumah Kayu',
                'target_generation' => 'Angkatan 2019',
                'description' => 'Temu kangen santai sambil ngopi dan bercerita tentang petualangan baru masing-masing.',
                'photos' => [
                    ['photo_path' => 'assets/images/foto-2.png', 'caption' => 'Ngobrol santai sore'],
                    ['photo_path' => 'assets/images/foto-3.png', 'caption' => 'Sesi foto polaroid'],
                ],
            ],
            [
                'title' => 'Graduation',
                'slug' => 'graduation-ceremony',
                'category' => 'indoor',
                'subtitle_label' => 'akhir dari sebuah babak',
                'sticker_tag' => 'so proud',
                'cover_photo' => 'assets/images/foto-7INDOOR.jpg',
                'event_date' => '2026-07-28',
                'date_display' => '28 Juli 2026 · Gedung Serbaguna',
                'location' => 'Gedung Serbaguna',
                'target_generation' => 'Angkatan 2017',
                'description' => 'Momen sakral pelepasan toga dan awal perjalanan baru menuju dunia profesional.',
                'photos' => [
                    ['photo_path' => 'assets/images/foto-1.png', 'caption' => 'Lempar toga bersama'],
                    ['photo_path' => 'assets/images/foto-3.png', 'caption' => 'Foto keluarga dan sahabat'],
                ],
            ],
        ];

        foreach ($albums as $data) {
            $photos = $data['photos'] ?? [];
            unset($data['photos']);

            $album = Album::updateOrCreate(['slug' => $data['slug']], $data);

            foreach ($photos as $photo) {
                AlbumPhoto::firstOrCreate([
                    'album_id' => $album->id,
                    'photo_path' => $photo['photo_path'],
                ], [
                    'caption' => $photo['caption'],
                ]);
            }
        }
    }
}
