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
        Schema::table('job_vacancies', function (Blueprint $table) {
            if (!Schema::hasColumn('job_vacancies', 'category')) {
                $table->string('category', 100)->nullable()->after('title');
            }
        });

        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'category')) {
                $table->string('category', 100)->default('Meetup')->after('title');
            }
        });

        Schema::table('albums', function (Blueprint $table) {
            if (!Schema::hasColumn('albums', 'category')) {
                $table->string('category', 100)->default('outdoor')->after('title');
            }
        });

        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'category')) {
                $table->string('category', 100)->nullable()->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            if (Schema::hasColumn('job_vacancies', 'category')) {
                $table->dropColumn('category');
            }
        });

        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'category')) {
                $table->dropColumn('category');
            }
        });

        Schema::table('albums', function (Blueprint $table) {
            if (Schema::hasColumn('albums', 'category')) {
                $table->dropColumn('category');
            }
        });

        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};
