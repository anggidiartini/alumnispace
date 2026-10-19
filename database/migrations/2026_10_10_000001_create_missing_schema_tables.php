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
        if (!Schema::hasTable('committee_periods')) {
            Schema::create('committee_periods', function (Blueprint $table) {
                $table->id();
                $table->string('period_name', 50);
                $table->date('start_date');
                $table->date('finish_date')->nullable();
                $table->boolean('status')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('alumni_committees')) {
            Schema::create('alumni_committees', function (Blueprint $table) {
                $table->id();
                $table->string('position', 100);
                $table->foreignId('alumni_profile_id')->constrained('alumni_profiles')->onDelete('cascade');
                $table->foreignId('committee_period_id')->constrained('committee_periods')->onDelete('cascade');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('galleries')) {
            Schema::create('galleries', function (Blueprint $table) {
                $table->id();
                $table->foreignId('album_id')->constrained('albums')->onDelete('cascade');
                $table->string('file_url', 255);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('education_historys')) {
            Schema::create('education_historys', function (Blueprint $table) {
                $table->increments('id');
                $table->string('education_place', 200);
                $table->string('educational_level', 50);
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->string('progress', 50);
                $table->boolean('status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_historys');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('alumni_committees');
        Schema::dropIfExists('committee_periods');
    }
};
