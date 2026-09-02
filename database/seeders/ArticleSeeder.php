<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $articles = [
            [
                'author_id' => $admin?->id,
                'title' => 'Peresmian Gedung Baru Lab Komputer Hasil Donasi Alumni',
                'slug' => 'peresmian-gedung-baru-lab-komputer',
                'category' => 'Sekolah',
                'thumbnail' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=500',
                'excerpt' => 'Fasilitas makin canggih buat adik-adik kelas belajar coding dan AI di sekolah.',
                'content' => 'Pembangunan laboratorium komputer baru di sekolah telah resmi selesai dan diresmikan berkat donasi dan kontribusi nyata dari berbagai angkatan alumni.',
                'published_at' => '2026-08-28 10:00:00',
                'is_published' => true,
            ],
            [
                'author_id' => $admin?->id,
                'title' => 'Tips Lolos Interview Kerja di Perusahaan Unicorn ala Kakak Alumni',
                'slug' => 'tips-lolos-interview-kerja-unicorn',
                'category' => 'Karier',
                'thumbnail' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=500',
                'excerpt' => 'Bongkar rahasia HRD saat menyaring CV fresh graduate berpengalaman organisasi.',
                'content' => 'Simak kiat praktis dan strategi menghadapi interview user maupun HR di perusahaan teknologi terkemuka langsung dari pengalaman alumni senior kita.',
                'published_at' => '2026-08-25 14:00:00',
                'is_published' => true,
            ],
            [
                'author_id' => $admin?->id,
                'title' => 'Persiapan Grand Reunion 2027: Bakal Ada Artis Tamu Spesial!',
                'slug' => 'persiapan-grand-reunion-2027',
                'category' => 'Reuni',
                'thumbnail' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500',
                'excerpt' => 'Panitia angkatan 2010 siap mengguncang stadion utama dengan konsep festival musik.',
                'content' => 'Panitia gabungan lintas angkatan mulai mematangkan rencana reuni akbar terbesar dengan berbagai penampilan panggung, bazar kuliner, dan donor darah.',
                'published_at' => '2026-08-20 09:30:00',
                'is_published' => true,
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(['slug' => $article['slug']], $article);
        }
    }
}
