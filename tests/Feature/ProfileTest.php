<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed_for_alumni(): void
    {
        $user = User::factory()->create(['role' => 'alumni']);

        $response = $this
            ->actingAs($user)
            ->get('/profile/settings');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create([
            'role' => 'alumni',
            'password' => bcrypt('password'),
        ]);

        $response = $this
            ->actingAs($user)
            ->put('/profile/settings', [
                'email' => 'newemail@example.com',
                'current_password' => 'password',
                'graduation_year' => 2021,
                'profession' => 'Software Engineer',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('home'));

        $user->refresh();

        $this->assertSame('newemail@example.com', $user->email);
    }
}
