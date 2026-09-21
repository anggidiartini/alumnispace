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
        // 1. Relasi di Tabel Albums
        Schema::table('albums', function (Blueprint $table) {
            if (!Schema::hasColumn('albums', 'category_id')) {
                $table->bigInteger('category_id')->unsigned()->nullable()->after('id');
            } else {
                $table->bigInteger('category_id')->unsigned()->nullable()->change();
            }
            
            $table->foreign('category_id')
                  ->references('id')->on('album_categories')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });

        // 2. Relasi di Tabel Job Vacancies
        Schema::table('job_vacancies', function (Blueprint $table) {
            if (!Schema::hasColumn('job_vacancies', 'category_id')) {
                $table->bigInteger('category_id')->unsigned()->nullable()->after('id');
            } else {
                $table->bigInteger('category_id')->unsigned()->nullable()->change();
            }
            
            $table->foreign('category_id')
                  ->references('id')->on('job_categories')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });

        // 3. Relasi di Tabel Companies
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'category_id')) {
                $table->bigInteger('category_id')->unsigned()->nullable()->after('id');
            } else {
                $table->bigInteger('category_id')->unsigned()->nullable()->change();
            }
            
            $table->foreign('category_id')
                  ->references('id')->on('company_categories')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });

        // 4. Relasi di Tabel Events
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'category_id')) {
                $table->bigInteger('category_id')->unsigned()->nullable()->after('id');
            } else {
                $table->bigInteger('category_id')->unsigned()->nullable()->change();
            }
            
            $table->foreign('category_id')
                  ->references('id')->on('event_categories')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
    }
};
