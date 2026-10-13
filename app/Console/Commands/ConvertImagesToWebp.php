<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

/**
 * Konversi gambar JPG/PNG -> WebP + update referensi di Blade/CSS/JS.
 *
 * Tanpa dependency baru (pakai ext-gd bawaan PHP).
 * Opsional: binary `cwebp` (libwebp) bila tersedia dipakai otomatis untuk hasil lebih kecil.
 *
 * Contoh:
 *   php artisan images:to-webp --dry-run
 *   php artisan images:to-webp --quality=82
 *   php artisan images:to-webp --references-only
 *   php artisan images:to-webp --images-only --keep-originals
 */
class ConvertImagesToWebp extends Command
{
    protected $aliases = ['assets:convert-webp'];

    protected $signature = 'images:to-webp
                            {--quality=82 : Kualitas WebP 0-100 (disarankan 78-85, default 82)}
                            {--paths=* : Folder sumber gambar (default: public,storage/app/public)}
                            {--path=* : Alias untuk --paths}
                            {--exclude=* : Substring path yang dikecualikan}
                            {--dry-run : Simulasi saja, tanpa menulis/menghapus file}
                            {--keep-originals : Jangan hapus/arsipkan file asli, biarkan berdampingan}
                            {--delete-original : Hapus/arsipkan file gambar asli dari folder asal}
                            {--backup : Cadangkan file asli ke folder arsip (default: aktif)}
                            {--no-backup : Hapus permanen file asli tanpa arsip (BERBAHAYA)}
                            {--archive-dir= : Folder arsip file asli (default: storage/app/image-originals-backup/<timestamp>)}
                            {--force-delete-uploads : Tetap hapus asli di folder uploads (default: asli di uploads selalu dipertahankan)}
                            {--images-only : Hanya konversi gambar, lewati update referensi}
                            {--references-only : Hanya update referensi, lewati konversi gambar}
                            {--update-references : Update referensi (default: YA kecuali --images-only)}
                            {--update-refs : Alias untuk --update-references}
                            {--no-ref-backup : Jangan backup file Blade/CSS/JS sebelum diubah}
                            {--driver=auto : Driver konversi: auto|gd|cwebp}
                            {--force : Lewati konfirmasi}';

    protected $description = 'Kompres & konversi gambar JPG/PNG menjadi WebP, lalu update referensinya di Blade/CSS/JS';

    /** Folder berisi upload dinamis (path-nya tersimpan di DB) — aslinya selalu dipertahankan. */
    protected array $uploadMarkers = ['/uploads/', '\\uploads\\', '/storage/uploads', 'storage\\app\\public\\uploads'];

    protected array $convertedMap = []; // basename-lower => ['old_exts' => [], 'webp' => path, 'basenames' => []]

    public function __construct()
    {
        parent::__construct();
        $this->setAliases(['assets:convert-webp']);
    }

    public function handle(): int
    {
        $quality = max(1, min(100, (int) $this->option('quality')));
        $dryRun = (bool) $this->option('dry-run');

        // Gabungkan --paths dan --path (support array maupun comma-separated)
        $rawPaths = array_merge(
            (array) ($this->option('paths') ?: []),
            (array) ($this->option('path') ?: [])
        );
        $normalizedPaths = [];
        foreach ($rawPaths as $p) {
            foreach (explode(',', (string) $p) as $sub) {
                $sub = trim($sub);
                if ($sub !== '') {
                    $normalizedPaths[] = $sub;
                }
            }
        }
        $paths = ! empty($normalizedPaths) ? array_unique($normalizedPaths) : ['public', 'storage/app/public'];

        $excludes = $this->option('exclude') ?: ['/build/', '\\build\\', 'node_modules', '/vendor/'];

        // Menentukan retensi file asli
        $keepOriginals = (bool) $this->option('keep-originals');
        if ((bool) $this->option('delete-original') && ! $this->option('keep-originals')) {
            $keepOriginals = false;
        }

        // Mode backup
        $noBackup = (bool) $this->option('no-backup');
        if ((bool) $this->option('backup')) {
            $noBackup = false;
        }

        $imagesOnly = (bool) $this->option('images-only');
        $refsOnly = (bool) $this->option('references-only');
        $updateRefsFlag = (bool) ($this->option('update-references') || $this->option('update-refs'));

        if ($imagesOnly) {
            $doRefs = false;
        } elseif ($refsOnly || $updateRefsFlag) {
            $doRefs = true;
        } else {
            $doRefs = true;
        }

        if (! extension_loaded('gd') && $this->option('driver') !== 'cwebp') {
            $this->error('Ekstensi PHP GD tidak aktif. Aktifkan ext-gd di php.ini atau install libwebp (cwebp).');
            return self::FAILURE;
        }

        if (! function_exists('imagewebp') && $this->resolveDriver() === 'gd') {
            $this->error('Fungsi imagewebp() tidak tersedia (GD dikompilasi tanpa dukungan WebP). Install libwebp / gunakan driver cwebp.');
            return self::FAILURE;
        }

        $this->info($dryRun ? '=== DRY-RUN: tidak ada file yang diubah ===' : '=== Konversi gambar ke WebP ===');

        $converted = [];
        $skipped = 0;
        $failed = 0;
        $bytesBefore = 0;
        $bytesAfter = 0;

        if (! $refsOnly) {
            $files = $this->findImages($paths, $excludes);
            if (empty($files)) {
                $this->warn('Tidak ditemukan file .jpg/.jpeg/.png pada path: ' . implode(', ', $paths));
            } else {
                $this->info(sprintf('Ditemukan %d file kandidat. Driver: %s, kualitas: %d', count($files), $this->resolveDriver(), $quality));

                if (! $dryRun && ! $this->option('force') && ! $keepOriginals && ! $noBackup) {
                    $this->warn('File asli akan DIARSIPKAN (dipindah) ke ' . $this->archiveDir() . ' setelah konversi berhasil.');
                    if (! $this->confirm('Lanjutkan?', true)) {
                        return self::SUCCESS;
                    }
                }
                if (! $dryRun && $noBackup && ! $this->option('force')) {
                    $this->error('Mode --no-backup akan MENGHAPUS PERMANEN file asli!');
                    if (! $this->confirm('Saya paham dan tetap lanjutkan?', false)) {
                        return self::SUCCESS;
                    }
                }

                $bar = $this->output->createProgressBar(count($files));
                $bar->start();

                foreach ($files as $file) {
                    $result = $this->convertOne($file, $quality, $dryRun, $keepOriginals, $noBackup);
                    $bar->advance();
                    if ($result['status'] === 'ok') {
                        $converted[] = $result;
                        $bytesBefore += $result['before'];
                        $bytesAfter += $result['after'];
                        // Daftarkan untuk update referensi: semua varian ekstensi lama -> .webp
                        $base = strtolower(pathinfo($file, PATHINFO_FILENAME));
                        $this->convertedMap[$base]['old_exts'][] = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        $this->convertedMap[$base]['webp_path'] = $result['webp'];
                        $this->convertedMap[$base]['basenames'][] = pathinfo($file, PATHINFO_FILENAME);
                    } elseif ($result['status'] === 'skip') {
                        $skipped++;
                    } else {
                        $failed++;
                        $this->newLine();
                        $this->warn("GAGAL {$file}: {$result['message']}");
                    }
                }
                $bar->finish();
                $this->newLine(2);

                $saved = $bytesBefore - $bytesAfter;
                $pct = $bytesBefore > 0 ? round($saved / $bytesBefore * 100, 1) : 0;
                $this->table(
                    ['Metrik', 'Nilai'],
                    [
                        ['File dikonversi', count($converted)],
                        ['Dilewati (sudah ada / bukan gambar)', $skipped],
                        ['Gagal', $failed],
                        ['Ukuran sebelum', $this->human($bytesBefore)],
                        ['Ukuran sesudah (WebP)', $this->human($bytesAfter)],
                        ['Hemat', $this->human($saved) . " ({$pct}%)"],
                        ['Mode', $dryRun ? 'DRY-RUN' : ($keepOriginals ? 'Asli dipertahankan' : ($noBackup ? 'Asli DIHAPUS permanen' : 'Asli diarsipkan ke ' . $this->archiveDir()))],
                    ]
                );

                if ($dryRun && count($converted) > 0) {
                    $this->comment('Contoh konversi (5 pertama):');
                    foreach (array_slice($converted, 0, 5) as $c) {
                        $this->line("  {$c['src']} ({$this->human($c['before'])}) -> {$c['webp']} ({$this->human($c['after'])})");
                    }
                }
            }
        }

        // ---- Fase 2: update referensi ----
        if ($doRefs) {
            // Jika --references-only (tanpa fase konversi), bangun peta dari file .webp yang sudah ada.
            if ($refsOnly || empty($this->convertedMap)) {
                $this->buildMapFromExistingWebp($paths, $excludes);
            }
            $this->updateReferences($dryRun);
        } else {
            $this->comment('Update referensi dilewati (--images-only). Jalankan dengan --references-only untuk melakukannya terpisah.');
        }

        if ($dryRun) {
            $this->info('DRY-RUN selesai. Jalankan ulang tanpa --dry-run untuk eksekusi nyata. Disarankan: commit git dulu sebagai backup.');
        }

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    // ---------- Pencarian gambar ----------

    protected function resolvePath(string $path): string
    {
        if (str_starts_with($path, '/') || str_starts_with($path, '\\') || preg_match('/^[a-zA-Z]:[\\\\\/]/', $path)) {
            return $path;
        }

        return base_path($path);
    }

    protected function findImages(array $paths, array $excludes): array
    {
        $out = [];
        foreach ($paths as $p) {
            $full = $this->resolvePath($p);
            if (! is_dir($full)) {
                $this->warn("Path dilewati (tidak ada): {$p}");
                continue;
            }
            $it = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($full, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::LEAVES_ONLY
            );
            /** @var \SplFileInfo $f */
            foreach ($it as $f) {
                if (! $f->isFile()) {
                    continue;
                }
                $pathname = $f->getPathname();
                foreach ($excludes as $ex) {
                    if ($ex !== '' && str_contains($pathname, $ex)) {
                        continue 2;
                    }
                }
                if (preg_match('/\.(jpe?g|png)$/i', $f->getFilename())) {
                    $out[] = $pathname;
                }
            }
        }
        sort($out);

        return $out;
    }

    protected function isUploadPath(string $path): bool
    {
        foreach ($this->uploadMarkers as $m) {
            if (str_contains($path, $m)) {
                return true;
            }
        }

        return false;
    }

    // ---------- Konversi satu file ----------

    protected function resolveDriver(): string
    {
        $opt = strtolower((string) $this->option('driver'));
        if ($opt === 'gd' || $opt === 'cwebp') {
            return $opt;
        }
        // auto: pakai cwebp bila binary tersedia (hasil biasanya lebih kecil)
        return $this->cwebpAvailable() ? 'cwebp' : 'gd';
    }

    protected function cwebpAvailable(): bool
    {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }
        $cache = false;
        if (PHP_OS_FAMILY === 'Windows') {
            @exec('where cwebp 2>NUL', $o, $code);
            $cache = ($code === 0 && ! empty($o));
        } else {
            @exec('command -v cwebp >/dev/null 2>&1', $o = [], $code);
            // fallback: `which`
            if ($code !== 0) {
                @exec('which cwebp 2>/dev/null', $o2, $code2);
                $code = $code2;
                $o = $o2;
            }
            $cache = ($code === 0);
        }

        return $cache;
    }

    protected function convertOne(string $src, int $quality, bool $dryRun, bool $keepOriginals, bool $noBackup): array
    {
        $info = pathinfo($src);
        $webp = $info['dirname'] . DIRECTORY_SEPARATOR . $info['filename'] . '.webp';

        // Validasi gambar asli bisa dibaca
        $size = @getimagesize($src);
        if ($size === false) {
            return ['status' => 'skip', 'src' => $src];
        }

        // Proteksi folder uploads: jangan hapus aslinya (path tersimpan di DB).
        $isUpload = $this->isUploadPath($src);
        $forceDeleteUploads = (bool) $this->option('force-delete-uploads');
        $mustKeep = $keepOriginals || ($isUpload && ! $forceDeleteUploads);

        if ($dryRun) {
            // Estimasi: konversi ke temp untuk mengukur hasil tanpa menyentuh file asli.
            $tmp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'webp-dry-' . uniqid('', true) . '-' . md5($src) . '.webp';
            $ok = $this->encode($src, $tmp, $quality, $size['mime'] ?? '');
            if (! $ok || ! is_file($tmp)) {
                @unlink($tmp);

                return ['status' => 'error', 'src' => $src, 'message' => 'encode gagal (dry-run)'];
            }
            clearstatcache(true, $tmp);
            $after = @filesize($tmp) ?: 0;
            @unlink($tmp);

            return [
                'status' => 'ok', 'src' => $src, 'webp' => $webp,
                'before' => filesize($src), 'after' => $after,
                'kept' => true,
            ];
        }

        // Jika .webp sudah ada & lebih baru dari sumber → lewati encode, tinggal arsipkan bila perlu.
        if (is_file($webp) && filemtime($webp) >= filemtime($src)) {
            $this->archiveOriginal($src, $noBackup, $mustKeep);

            return ['status' => 'skip', 'src' => $src];
        }

        $tmp = $webp . '.tmp';
        if (! $this->encode($src, $tmp, $quality, $size['mime'] ?? '')) {
            @unlink($tmp);

            return ['status' => 'error', 'src' => $src, 'message' => 'encode gagal'];
        }

        // Validasi hasil adalah webp valid sebelum mengganti file
        $check = @getimagesize($tmp);
        if ($check === false || ($check['mime'] ?? '') !== 'image/webp') {
            @unlink($tmp);

            return ['status' => 'error', 'src' => $src, 'message' => 'hasil bukan WebP valid'];
        }

        @unlink($webp);
        if (! @rename($tmp, $webp)) {
            @unlink($tmp);

            return ['status' => 'error', 'src' => $src, 'message' => 'gagal memindahkan hasil'];
        }
        $beforeSize = @filesize($src) ?: 0;
        @touch($webp, @filemtime($src) ?: time());

        $this->archiveOriginal($src, $noBackup, $mustKeep);

        return [
            'status' => 'ok', 'src' => $src, 'webp' => $webp,
            'before' => $beforeSize,
            'after' => @filesize($webp) ?: 0,
            'kept' => $mustKeep,
        ];
    }

    /** Encode sumber JPG/PNG ke WebP. Return true bila sukses. */
    protected function encode(string $src, string $dest, int $quality, string $mime): bool
    {
        // Kasus khusus: ekstensi .png/.jpg tapi isi sudah WebP → tinggal salin.
        if (str_contains($mime, 'webp')) {
            return @copy($src, $dest);
        }        if ($this->resolveDriver() === 'cwebp') {
            $q = max(1, min(100, $quality));
            // -m 6 = kompresi lambat tapi kecil; -mt = multithread; -quiet
            $cmd = sprintf('cwebp -q %d -m 6 -mt -quiet %s -o %s 2>&1',
                $q, escapeshellarg($src), escapeshellarg($dest));
            @exec($cmd, $out, $code);
            if ($code === 0 && is_file($dest) && filesize($dest) > 0) {
                return true;
            }
            // fallback ke GD bila cwebp gagal
        }

        $img = $this->loadImage($src, $mime);
        if (! $img) {
            return false;
        }
        // Samakan ke truecolor + pertahankan transparansi PNG
        if (! imageistruecolor($img)) {
            imagepalettetotruecolor($img);
        }
        imagealphablending($img, false);
        imagesavealpha($img, true);
        $ok = imagewebp($img, $dest, $quality);
        imagedestroy($img);

        return (bool) $ok;
    }

    protected function loadImage(string $src, string $mime)
    {
        if ($mime === '' || $mime === 'application/octet-stream') {
            $s = @getimagesize($src);
            $mime = $s['mime'] ?? '';
        }
        try {
            if (str_contains($mime, 'webp')) {
                $img = @imagecreatefromwebp($src);
            } elseif (str_contains($mime, 'png')) {
                $img = @imagecreatefrompng($src);
            } else {
                $img = @imagecreatefromjpeg($src);
                if (! $img) { // coba sebagai png bila ekstensi salah
                    $img = @imagecreatefrompng($src);
                }
            }
        } catch (\Throwable) {
            return false;
        }

        return $img ?: false;
    }

    /** Pindahkan file asli ke arsip, hapus permanen, atau biarkan — sesuai opsi. */
    protected function archiveOriginal(string $src, bool $noBackup, bool $mustKeep): void
    {
        if ($mustKeep) {
            return; // biarkan berdampingan (terutama folder uploads)
        }
        if ($noBackup) {
            @unlink($src);

            return;
        }
        $rel = ltrim(str_replace(base_path(), '', $src), '/\\');
        $dest = $this->archiveDir() . DIRECTORY_SEPARATOR . $rel;
        @mkdir(dirname($dest), 0755, true);
        // rename antar-volume bisa gagal → fallback copy+unlink
        if (! @rename($src, $dest)) {
            if (@copy($src, $dest)) {
                @unlink($src);
            }
        }
    }

    protected function archiveDir(): string
    {
        static $dir = null;
        if ($dir !== null) {
            return $dir;
        }
        $custom = (string) $this->option('archive-dir');
        $dir = $custom !== ''
            ? $custom
            : storage_path('app/image-originals-backup/' . date('Ymd-His'));
        if (! $this->option('dry-run')) {
            @mkdir($dir, 0755, true);
        }

        return $dir;
    }

    // ---------- Fase update referensi ----------

    /** Bangun peta basename->webp dari file .webp yang sudah ada (untuk --references-only). */
    protected function buildMapFromExistingWebp(array $paths, array $excludes): void
    {
        foreach ($paths as $p) {
            $full = $this->resolvePath($p);
            if (! is_dir($full)) {
                continue;
            }
            $it = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($full, RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($it as $f) {
                /** @var \SplFileInfo $f */
                if (! $f->isFile() || ! preg_match('/\.webp$/i', $f->getFilename())) {
                    continue;
                }
                $base = strtolower(pathinfo($f->getFilename(), PATHINFO_FILENAME));
                $this->convertedMap[$base]['old_exts'] = ['png', 'jpg', 'jpeg'];
                $this->convertedMap[$base]['webp_path'] = $f->getPathname();
                $this->convertedMap[$base]['basenames'][] = pathinfo($f->getFilename(), PATHINFO_FILENAME);
            }
        }
    }

    protected function updateReferences(bool $dryRun): void
    {
        if (empty($this->convertedMap)) {
            $this->warn('Tidak ada peta konversi — lewati update referensi.');

            return;
        }

        $targets = [];
        foreach (['resources/views', 'resources/css', 'resources/js', 'public/css', 'public/js'] as $dir) {
            $full = base_path($dir);
            if (! is_dir($full)) {
                continue;
            }
            $it = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($full, RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($it as $f) {
                /** @var \SplFileInfo $f */
                if ($f->isFile() && preg_match('/\.(blade\.php|php|css|scss|js|vue|ts)$/i', $f->getFilename())) {
                    $targets[] = $f->getPathname();
                }
            }
        }

        if (empty($targets)) {
            $this->warn('Tidak ditemukan file Blade/CSS/JS untuk dipindai.');

            return;
        }

        $this->info(sprintf('Memindai %d file referensi...', count($targets)));
        $changedFiles = 0;
        $totalRepl = 0;
        $details = [];

        foreach ($targets as $file) {
            $content = @file_get_contents($file);
            if ($content === false) {
                continue;
            }
            $original = $content;
            $fileRepl = 0;

            foreach ($this->convertedMap as $baseLower => $meta) {
                foreach (array_unique($meta['basenames']) as $baseOrig) {
                    // Ganti: NamaFile.(png|jpg|jpeg) -> NamaFile.webp
                    // hanya bila diikuti penutup (quote, ?, #, spasi, kurung, <) agar tidak merusak nama lain.
                    // Contoh cocok: logo.png, assets/x/banner.JPG?v=2, url("bg.jpeg")
                    $pattern = '/(?<![a-zA-Z0-9_-])' . preg_quote($baseOrig, '/') . '\.(?:png|jpe?g)(?=([?#"\'\)\s<>]|$))/i';
                    $content = preg_replace_callback($pattern, function () use ($baseOrig, &$fileRepl) {
                        $fileRepl++;

                        return $baseOrig . '.webp';
                    }, $content);
                }
            }

            if ($fileRepl > 0) {
                $changedFiles++;
                $totalRepl += $fileRepl;
                $details[] = ['file' => str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file), 'replacements' => $fileRepl];
                if (! $dryRun) {
                    if (! $this->option('no-ref-backup')) {
                        $this->backupRefFile($file);
                    }
                    @file_put_contents($file, $content);
                } elseif (count($details) <= 15) {
                    // Tampilkan diff ringkas saat dry-run
                    $this->line("  ~ {$details[count($details)-1]['file']}: {$fileRepl} penggantian");
                }
                unset($original);
            }
        }

        $this->table(
            ['Metrik referensi', 'Nilai'],
            [
                ['File dipindai', count($targets)],
                ['File diubah' . ($dryRun ? ' (simulasi)' : ''), $changedFiles],
                ['Total penggantian ekstensi', $totalRepl],
            ]
        );

        if ($dryRun && $changedFiles > 15) {
            $this->comment('... (15 file pertama ditampilkan di atas)');
        }
        if (! $dryRun && $changedFiles > 0 && ! $this->option('no-ref-backup')) {
            $this->info('Backup file referensi tersimpan di: ' . $this->refBackupDir());
        }
    }

    protected function refBackupDir(): string
    {
        static $dir = null;
        if ($dir === null) {
            $dir = storage_path('app/ref-backup/' . date('Ymd-His'));
            @mkdir($dir, 0755, true);
        }

        return $dir;
    }

    protected function backupRefFile(string $file): void
    {
        $rel = ltrim(str_replace(base_path(), '', $file), '/\\');
        $dest = $this->refBackupDir() . DIRECTORY_SEPARATOR . $rel;
        @mkdir(dirname($dest), 0755, true);
        @copy($file, $dest);
    }

    protected function human(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = (int) floor(log($bytes, 1024));
        $i = min($i, count($units) - 1);

        return round($bytes / (1024 ** $i), 2) . ' ' . $units[$i];
    }

    /** Buat ZIP arsip dari folder backup terakhir (dipanggil manual bila perlu). */
    protected function zipDir(string $dir, string $zipPath): bool
    {
        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
            return false;
        }
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS));
        foreach ($it as $f) {
            /** @var \SplFileInfo $f */
            if ($f->isFile()) {
                $zip->addFile($f->getPathname(), substr($f->getPathname(), strlen($dir) + 1));
            }
        }

        return $zip->close();
    }
}
