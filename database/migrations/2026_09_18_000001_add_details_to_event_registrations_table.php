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
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->unsignedInteger('quantity')->default(1)->after('user_id');
            $table->string('name', 255)->nullable()->after('quantity');
            $table->string('email', 255)->nullable()->after('name');
            $table->string('phone', 50)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'name', 'email', 'phone']);
        });
    }
};
