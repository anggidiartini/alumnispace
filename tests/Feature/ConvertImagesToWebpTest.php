<?php

namespace Tests\Feature;

use Tests\TestCase;

class ConvertImagesToWebpTest extends TestCase
{
    protected string $testDir;
    protected string $testViewFile;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testDir = storage_path('testing_images_' . uniqid());
        @mkdir($this->testDir, 0755, true);

        // Buat dummy PNG 10x10
        $img = imagecreatetruecolor(10, 10);
        imagepng($img, $this->testDir . DIRECTORY_SEPARATOR . 'test-sample.png');
        imagedestroy($img);

        // Buat file blade sementara di resources/views
        $this->testViewFile = resource_path('views/test_webp_temp_' . uniqid() . '.blade.php');
        file_put_contents($this->testViewFile, '<img src="{{ asset(\'images/test-sample.png\') }}"><link href="other.css">');
    }

    protected function tearDown(): void
    {
        $files = glob($this->testDir . '/*');
        if (is_array($files)) {
            foreach ($files as $file) {
                @unlink($file);
            }
        }
        @rmdir($this->testDir);

        if (file_exists($this->testViewFile)) {
            @unlink($this->testViewFile);
        }

        parent::tearDown();
    }

    public function test_command_runs_with_dry_run_option(): void
    {
        $this->artisan('images:to-webp', [
            '--paths' => [$this->testDir],
            '--dry-run' => true,
        ])->assertSuccessful();
    }

    public function test_command_alias_assets_convert_webp_runs_successfully(): void
    {
        $this->artisan('assets:convert-webp', [
            '--paths' => [$this->testDir],
            '--dry-run' => true,
        ])->assertSuccessful();
    }

    public function test_command_accepts_user_friendly_flags_and_converts(): void
    {
        $this->artisan('assets:convert-webp', [
            '--path' => [$this->testDir],
            '--backup' => true,
            '--delete-original' => true,
            '--update-refs' => true,
            '--force' => true,
        ])->assertSuccessful();

        $this->assertFileExists($this->testDir . DIRECTORY_SEPARATOR . 'test-sample.webp');

        // Pastikan referensi blade otomatis ter-update ke .webp
        $viewContent = file_get_contents($this->testViewFile);
        $this->assertStringContainsString('test-sample.webp', $viewContent);
        $this->assertStringNotContainsString('test-sample.png', $viewContent);
    }
}
