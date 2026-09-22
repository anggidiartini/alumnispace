<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique()->nullable();
                $table->string('name');
                $table->string('category')->nullable();
                $table->boolean('is_verified')->default(false);
                $table->string('industry')->nullable();
                $table->string('location')->nullable();
                $table->string('logo')->nullable();
                $table->text('description')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('instagram')->nullable();
                $table->string('facebook')->nullable();
                $table->string('whatsapp')->nullable();
                $table->string('website')->nullable();
                $table->text('address')->nullable();
                $table->string('city')->nullable();
                $table->text('maps_url')->nullable();
                $table->decimal('latitude', 10, 8)->nullable();
                $table->decimal('longitude', 11, 8)->nullable();
                $table->string('work_type')->nullable();
                $table->integer('founded_year')->nullable();
                $table->string('email')->nullable();
                $table->integer('followers_count')->default(0);
                $table->decimal('rating', 3, 2)->default(0);
                $table->integer('review_count')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('job_vacancies', 'company_id')) {
            Schema::table('job_vacancies', function (Blueprint $table) {
                $table->foreignId('company_id')->nullable()->after('posted_by')->constrained('companies')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('job_vacancies') && Schema::hasColumn('job_vacancies', 'company_id')) {
            Schema::table('job_vacancies', function (Blueprint $table) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            });
        }

        Schema::dropIfExists('companies');
    }
};
