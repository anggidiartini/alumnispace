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
        Schema::create('alumni_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('student_number', 50)->nullable(); // NISN / Nomor Anggota
            $table->unsignedSmallInteger('graduation_year')->index(); // Angkatan (e.g. 2018, 2020)
            $table->string('major', 100)->nullable(); // Jurusan
            $table->string('profession', 150)->nullable(); // Profesi / Jabatan
            $table->string('company', 150)->nullable(); // Perusahaan / Studio
            $table->string('city', 100)->nullable(); // Kota Domisili
            $table->string('phone_number', 30)->nullable(); // No WA / Telp
            $table->string('avatar', 255)->nullable(); // Foto Profil
            $table->text('bio')->nullable(); // Deskripsi Singkat
            $table->string('linkedin_url', 255)->nullable();
            $table->string('instagram_url', 255)->nullable();
            $table->string('github_url', 255)->nullable();
            $table->string('twitter_url', 255)->nullable();
            $table->string('youtube_url', 255)->nullable();
            $table->string('portfolio_url', 255)->nullable();
            $table->boolean('is_online')->default(false);
            $table->boolean('is_verified')->default(false); // Status Terverifikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_profiles');
    }
};
