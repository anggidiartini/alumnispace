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
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->string('tiktok_url')->nullable();
            $table->text('achievements')->nullable();
            $table->string('organization_role')->nullable();
            $table->string('current_university')->nullable();
            $table->string('study_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'tiktok_url', 
                'achievements', 
                'organization_role', 
                'current_university', 
                'study_status'
            ]);
        });
    }
};
