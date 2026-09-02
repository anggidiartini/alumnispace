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
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug', 60)->index();
            $table->string('section_key', 60);
            $table->string('title', 255);
            $table->string('subtitle', 255)->nullable();
            $table->text('body_content')->nullable();
            $table->json('meta_data')->nullable();
            $table->string('media_url', 500)->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['page_slug', 'section_key'], 'uk_page_section');
        });

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('group', 50)->default('general');
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->string('data_type', 20)->default('string');
            $table->boolean('is_public')->default(true);
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('page_contents');
    }
};
