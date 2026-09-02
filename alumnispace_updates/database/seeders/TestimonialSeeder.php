<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\User;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rangga = User::where('email', 'rangga.pratama@alumni.id')->first();
        $nabila = User::where('email', 'nabila.zahra@alumni.id')->first();
        $dimas = User::where('email', 'dimas.anggara@alumni.id')->first();

        $testimonials = [
            [
                'user_id' => $rangga?->id,
                'name' => 'Rangga Pratama',
                'graduation_year' => 2015,
                'profession' => 'Software Engineer',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100',
                'quote' => 'Berkat AlumniSpace, aku bisa nyambung lagi sama ketua geng kelasku dulu dan sekarang malah jadi partner bisnis startup!',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'user_id' => $nabila?->id,
                'name' => 'Nabila Zahra',
                'graduation_year' => 2018,
                'profession' => 'Product Manager',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100',
                'quote' => 'Informasi lowongan kerja di sini valid banget karena langsung direkomendasikan sama kakak tingkat yang udah senior di korporat.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'user_id' => $dimas?->id,
                'name' => 'Dimas Anggara',
                'graduation_year' => 2020,
                'profession' => 'Content Creator',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100',
                'quote' => 'Tampilan web-nya gemesin banget, pas banget sama selera anak muda dan gak ngebosenin pas dibuka di HP.',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'user_id' => null,
                'name' => 'Rian',
                'graduation_year' => 2018,
                'profession' => 'Angkatan 2018',
                'avatar' => null,
                'quote' => 'Sumpah ngebantu banget! Lewat web ini akhirnya bisa kontakan lagi sama geng sekelas dulu. Malah kemarin sempat nongkrong bareng lagi. Asyik banget!',
                'rating' => 5,
                'is_featured' => true,
            ],
            [
                'user_id' => null,
                'name' => 'Dewi',
                'graduation_year' => 2020,
                'profession' => 'Angkatan 2020',
                'avatar' => null,
                'quote' => 'Fitur lokernya juara! Kemarin dapet info lowongan dari senior sendiri, alhamdulillah langsung diterima. Makasih banyak wadahnya!',
                'rating' => 5,
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::firstOrCreate([
                'name' => $item['name'],
                'quote' => $item['quote'],
            ], $item);
        }
    }
}
