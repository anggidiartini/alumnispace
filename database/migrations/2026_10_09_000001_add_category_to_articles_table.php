<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'category')) {
                $table->string('category', 100)->default('Sekolah')->after('slug');
            }
        });

        if (Schema::hasColumn('articles', 'category')) {
            DB::table('articles')
                ->where('slug', 'peresmian-gedung-baru-lab-komputer')
                ->update(['category' => 'Sekolah']);

            DB::table('articles')
                ->where('slug', 'tips-lolos-interview-kerja-unicorn')
                ->update(['category' => 'Karier']);

            DB::table('articles')
                ->where('slug', 'persiapan-grand-reunion-2027')
                ->update(['category' => 'Reuni']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};
