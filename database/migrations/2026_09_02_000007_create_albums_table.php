<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150); // e.g. "Class Trip", "Graduation", "School Event"
            $table->string('slug', 180)->unique();
            $table->string('category', 50)->default('outdoor'); // indoor, outdoor, reunion
            $table->string('subtitle_label', 100)->nullable(); // "liburan sekelas", "akhir dari sebuah babak"
            $table->string('sticker_tag', 50)->nullable(); // "seru banget!", "so proud", "asik banget"
            $table->string('cover_photo', 255)->nullable();
            $table->date('event_date')->nullable();
            $table->string('date_display', 100)->nullable(); // e.g. "14 Maret 2026 · Bandung"
            $table->string('location', 150)->nullable(); // Bandung, Aula Sekolah, etc.
            $table->string('target_generation', 50)->nullable(); // Angkatan 2018, Semua Angkatan
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
