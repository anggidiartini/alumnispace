<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserAndProfileSeeder::class,
            JobVacancySeeder::class,
            EventSeeder::class,
            AlbumSeeder::class,
            TestimonialSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
