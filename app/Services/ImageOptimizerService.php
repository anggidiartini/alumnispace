<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageOptimizerService
{
    /**
     * Target ukuran thumbnail album: maksimal ~50 KB (51.200 bytes).
     * Dimensi maksimal lebar/tinggi: 800px.
     */
    public static function optimizeThumbnail(UploadedFile $file, string $subfolder = 'albums/covers'): string
    {
        return self::processAndSave($file, $subfolder, 50 * 1024, 800, 80);
    }

    /**
     * Target ukuran gambar reguler/isi album: maksimal ~500 KB (512.000 bytes).
     * Dimensi maksimal lebar/tinggi: 1920px.
     */
    public static function optimizePhoto(UploadedFile $file, string $subfolder = 'albums/photos'): string
    {
        return self::processAndSave($file, $subfolder, 500 * 1024, 1920, 85);
    }

    /**
     * Proses kompresi adaptif, rotasi EXIF, konversi ke format WebP, dan simpan ke disk public.
     */
    public static function processAndSave(
        UploadedFile $file,
        string $subfolder,
        int $maxBytes,
        int $maxDimension,
        int $initialQuality = 85
    ): string {
        $realPath = $file->getRealPath();
        $rawContents = file_get_contents($realPath);
        if ($rawContents === false) {
            throw new \RuntimeException('Gagal membaca berkas gambar yang diunggah.');
        }

        $image = @imagecreatefromstring($rawContents);
        if (!$image) {
            throw new \RuntimeException('Format gambar tidak didukung atau berkas rusak.');
        }

        // 1. Tangani orientasi EXIF (khususnya untuk foto jepretan kamera ponsel)
        $image = self::fixExifOrientation($image, $realPath);

        // 2. Hitung dimensi proporsional baru tanpa merusak aspek rasio
        $origWidth = imagesx($image);
        $origHeight = imagesy($image);

        if ($origWidth > $maxDimension || $origHeight > $maxDimension) {
            $ratio = min($maxDimension / $origWidth, $maxDimension / $origHeight);
            $newWidth = (int) max(1, round($origWidth * $ratio));
            $newHeight = (int) max(1, round($origHeight * $ratio));
        } else {
            $newWidth = $origWidth;
            $newHeight = $origHeight;
        }

        // 3. Buat canvas truecolor dan pertahankan transparansi
        $canvas = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);

        // Pertahankan warna transparan jika ada
        $transparentColor = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
        imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $transparentColor);

        imagecopyresampled(
            $canvas,
            $image,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );
        imagedestroy($image);

        // 4. Kompresi adaptif ke WebP agar file berada di bawah batas target ukuran (maxBytes)
        $quality = $initialQuality;
        $encodedData = null;

        while ($quality >= 20) {
            ob_start();
            imagewebp($canvas, null, $quality);
            $encodedData = ob_get_clean();

            if (strlen($encodedData) <= $maxBytes || $quality <= 25) {
                break;
            }
            $quality -= 10;
        }

        // Jika kualitas minimum 20 masih melebihi batas ukuran (misal gambar sangat kompleks/noisy),
        // turunkan dimensi sebesar 20% dan ulangi encoding
        if (strlen($encodedData) > $maxBytes) {
            $scaledWidth = (int) max(1, round($newWidth * 0.8));
            $scaledHeight = (int) max(1, round($newHeight * 0.8));

            $scaledCanvas = imagecreatetruecolor($scaledWidth, $scaledHeight);
            imagealphablending($scaledCanvas, false);
            imagesavealpha($scaledCanvas, true);
            imagecopyresampled(
                $scaledCanvas,
                $canvas,
                0,
                0,
                0,
                0,
                $scaledWidth,
                $scaledHeight,
                $newWidth,
                $newHeight
            );
            imagedestroy($canvas);
            $canvas = $scaledCanvas;

            $quality = 65;
            while ($quality >= 20) {
                ob_start();
                imagewebp($canvas, null, $quality);
                $encodedData = ob_get_clean();

                if (strlen($encodedData) <= $maxBytes || $quality <= 25) {
                    break;
                }
                $quality -= 10;
            }
        }

        imagedestroy($canvas);

        // 5. Tentukan nama berkas unik berekstensi .webp dan simpan
        $cleanName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        if (empty($cleanName)) {
            $cleanName = 'image';
        }
        $filename = time() . '_' . Str::random(6) . '_' . $cleanName . '.webp';

        $destinationDir = public_path('uploads/' . trim($subfolder, '/'));
        File::ensureDirectoryExists($destinationDir);

        $fullPath = $destinationDir . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($fullPath, $encodedData);

        // Bersihkan memori buffer
        unset($encodedData);

        return 'uploads/' . trim($subfolder, '/') . '/' . $filename;
    }

    /**
     * Memperbaiki orientasi gambar berdasarkan metadata EXIF kamera jika tersedia.
     *
     * @param \GdImage $image
     * @param string $path
     * @return \GdImage
     */
    protected static function fixExifOrientation($image, string $path)
    {
        if (!function_exists('exif_read_data')) {
            return $image;
        }

        try {
            $exif = @exif_read_data($path);
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3:
                        $rotated = imagerotate($image, 180, 0);
                        imagedestroy($image);
                        return $rotated;
                    case 6:
                        $rotated = imagerotate($image, -90, 0);
                        imagedestroy($image);
                        return $rotated;
                    case 8:
                        $rotated = imagerotate($image, 90, 0);
                        imagedestroy($image);
                        return $rotated;
                }
            }
        } catch (\Throwable $e) {
            // Abaikan jika berkas tidak memiliki header EXIF valid
        }

        return $image;
    }

    /**
     * Hapus berkas gambar dari direktori public/uploads jika ada.
     */
    public static function deleteFile(?string $relativePath): void
    {
        if (empty($relativePath)) {
            return;
        }

        // Hindari menghapus default asset images
        if (Str::startsWith($relativePath, 'assets/')) {
            return;
        }

        $fullPath = public_path($relativePath);
        if (File::exists($fullPath) && is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
