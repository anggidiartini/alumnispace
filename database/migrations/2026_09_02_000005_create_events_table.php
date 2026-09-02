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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title', 255); // e.g. "Webinar UI/UX & AI Integration"
            $table->string('slug', 255)->unique();
            $table->string('category', 50)->default('Meetup'); // Meetup, Webinar, Workshop, Gathering
            $table->string('badge_tag', 100)->nullable(); // Webinar Karir, Gathering Offline, Workshop
            $table->string('banner_image', 255)->nullable();
            $table->date('event_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('time_display', 100)->nullable(); // e.g. "19:30 - 21:00 WIB"
            $table->string('location_type', 30)->default('offline'); // online, offline, hybrid
            $table->string('venue', 255)->nullable(); // Denpasar, Bali / Online via Zoom / Pancoran Soccer Field
            $table->text('description');
            $table->string('registration_link', 255)->nullable();
            $table->unsignedInteger('quota')->nullable();
            $table->string('status', 30)->default('upcoming'); // upcoming, ongoing, completed, cancelled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
