<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EventRegistrationModalTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('category')->nullable();
                $table->string('badge_tag')->nullable();
                $table->string('banner_image')->nullable();
                $table->date('event_date')->nullable();
                $table->time('start_time')->nullable();
                $table->time('end_time')->nullable();
                $table->string('time_display')->nullable();
                $table->string('location_type')->default('online');
                $table->string('venue')->nullable();
                $table->text('description')->nullable();
                $table->string('registration_link')->nullable();
                $table->integer('quota')->default(100);
                $table->string('status')->default('upcoming');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('event_registrations')) {
            Schema::create('event_registrations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('event_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('name');
                $table->string('email');
                $table->string('phone');
                $table->integer('quantity')->default(1);
                $table->string('ticket_code')->nullable();
                $table->string('status')->default('registered');
                $table->timestamps();
            });
        }

        Event::updateOrCreate(
            ['slug' => 'test-event-modal-state'],
            [
                'title' => 'Test Event Modal State',
                'slug' => 'test-event-modal-state',
                'description' => 'Test Event Description',
                'status' => 'upcoming',
                'quota' => 100,
            ]
        );
    }

    public function test_event_detail_page_contains_modal_state_control_directives(): void
    {
        $response = $this->get('/event/test-event-modal-state');

        $response->assertStatus(200);
        // Verify Alpine state definition
        $response->assertSee('x-data="{ isSubmitted: false }"', false);
        // Verify form has x-show="!isSubmitted"
        $response->assertSee('id="erStepForm" x-show="!isSubmitted"', false);
        // Verify success view has x-show="isSubmitted" and x-cloak
        $response->assertSee('id="erStepSuccess" x-show="isSubmitted" x-cloak', false);
        // Verify closing button and Done button resets state
        $response->assertSee('id="erDoneBtn" @click="isSubmitted = false"', false);
        $response->assertSee('id="erClose" aria-label="Tutup" @click="isSubmitted = false"', false);
    }
}
