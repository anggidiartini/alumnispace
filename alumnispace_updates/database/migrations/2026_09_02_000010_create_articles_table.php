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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title', 255); // e.g. "Peresmian Gedung Baru Lab Komputer"
            $table->string('slug', 255)->unique();
            $table->string('category', 100)->default('Sekolah'); // Sekolah, Karier, Reuni, Prestasi
            $table->string('thumbnail', 255)->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
