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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posted_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title', 200); // Judul Posisi (e.g. Junior UI/UX Designer)
            $table->string('slug', 255)->unique();
            $table->string('company_name', 150); // Nama Perusahaan
            $table->string('company_logo', 255)->nullable(); // Logo path or initials
            $table->string('alumni_contact', 150)->nullable(); // e.g. "Kak Bayu (2016)"
            $table->string('job_type', 50)->default('Full-Time'); // Full-Time, Remote, Freelance, Magang
            $table->string('workplace_type', 50)->default('On-Site'); // Remote, Hybrid, WFO Jakarta, On-Site Surabaya
            $table->string('category', 100)->nullable(); // Tech Lead, Design, Marketing, etc.
            $table->string('highlight_badge', 100)->nullable(); // Rekomendasi Alumni, Hot Project, Fresh Grad
            $table->string('location', 150)->nullable(); // Kota / Lokasi
            $table->string('salary_display', 100)->nullable(); // e.g. "Rp 6.0M - 8.5M / bln", "Berdasarkan Project"
            $table->string('salary_type', 50)->default('per_month'); // per_month, per_project, per_episode, incentive
            $table->text('description'); // Deskripsi Pekerjaan
            $table->text('requirements')->nullable(); // Kualifikasi / Syarat
            $table->json('skills_tags')->nullable(); // ["Figma", "Remote", "Full-Time"]
            $table->string('application_link', 255)->nullable();
            $table->string('application_email', 150)->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
