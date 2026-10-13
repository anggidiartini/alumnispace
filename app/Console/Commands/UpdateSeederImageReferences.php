<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateSeederImageReferences extends Command
{
    /**
     * Nama dan signature dari Artisan Command.
     * Penggunaan: php artisan seeders:update-webp --dry-run
     */
    protected $signature = 'seeders:update-webp 
                            {--dry-run : Simulasi pengecekan tanpa mengubah file seeder}';

    protected $description = 'Memeriksa dan memperbarui referensi ekstensi gambar (png, jpg, jpeg) menjadi webp di folder database/seeders/';

    public function handle(): int
    {
        $isDryRun = $this->option('dry-run');
        $seedersPath = database_path('seeders');

        if (!File::exists($seedersPath)) {
            $this->error("Folder seeders tidak ditemukan di: {$seedersPath}");
            return Command::FAILURE;
        }

        $this->info("Memulai pemindaian file seeder di: {$seedersPath}...\n");

        $files = File::allFiles($seedersPath);
        $totalFilesScanned = 0;
        $updatedFilesCount = 0;
        $totalReplacements = 0;

        // Regex pattern case-insensitive untuk ekstensi png, jpg, jpeg
        $pattern = '/\b([\w\-\/]+)\.(png|jpg|jpeg)\b/i';

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') {
                continue;
            }

            $totalFilesScanned++;
            $filePath = $file->getRealPath();
            $relativePath = $file->getRelativePathname();
            $content = File::get($filePath);

            // Cari semua pencocokan untuk statistik
            preg_match_all($pattern, $content, $matches);
            $matchCount = count($matches[0]);

            if ($matchCount > 0) {
                // Ganti ekstensi dengan .webp (preserves path dan nama file)
                $updatedContent = preg_replace($pattern, '$1.webp', $content);

                $this->line("<fg=yellow>[MATCH]</fg=yellow> {$relativePath} -> Ditemukan <fg=cyan>{$matchCount}</fg=cyan> referensi gambar:");
                foreach ($matches[0] as $match) {
                    $newMatch = preg_replace($pattern, '$1.webp', $match);
                    $this->line("  - <fg=red>{$match}</fg=red> -> <fg=green>{$newMatch}</fg=green>");
                }

                if (!$isDryRun) {
                    File::put($filePath, $updatedContent);
                    $this->info("  -> File berhasil diperbarui.\n");
                } else {
                    $this->comment("  -> [DRY-RUN] File tidak diubah.\n");
                }

                $updatedFilesCount++;
                $totalReplacements += $matchCount;
            }
        }

        $this->line("-------------------------------------------------------");
        $this->info("RINGKASAN PEMBARUAN SEEDER:");
        $this->line("  Total Seeder Dipindai   : {$totalFilesScanned}");
        $this->line("  File dengan Referensi   : {$updatedFilesCount}");
        $this->line("  Total Referensi Diganti : {$totalReplacements}");
        $this->line("-------------------------------------------------------");

        if ($isDryRun && $totalReplacements > 0) {
            $this->warn("Jalankan tanpa flag --dry-run untuk menerapkan perubahan.");
        } elseif ($totalReplacements === 0) {
            $this->info("Semua seeder sudah bersih / sudah menggunakan ekstensi .webp!");
        }

        return Command::SUCCESS;
    }
}