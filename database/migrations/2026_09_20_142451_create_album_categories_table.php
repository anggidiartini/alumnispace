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
    Schema::create('album_categories', function (Blueprint $table) {
        $table->id(); // Ini otomatis bigint UNSIGNED
        $table->string('name', 100);
        $table->string('slug', 120)->unique();
        $table->text('description')->nullable();
        $table->boolean('status')->default(true);
        $table->timestamps(); // Ini otomatis membuat created_at & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_categories');
    }
};
