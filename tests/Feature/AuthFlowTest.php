<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class AuthFlowTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        User::create([
            'name' => 'Kanya Salsabila',
            'email' => 'kanya.salsabila@alumni.id',
            'password' => Hash::make('password123'),
            'role' => 'alumni',
            'status' => 'active',
        ]);
    }
    public function test_login_page_renders_properly(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Masuk ke akun');
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'kanya.salsabila@alumni.id',
            'password' => 'wrongpass',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_succeeds_and_unlocks_features_on_home(): void
    {
        $user = User::where('email', 'kanya.salsabila@alumni.id')->first();
        $this->assertNotNull($user);

        // Submit credentials
        $response = $this->post('/login', [
            'email' => 'kanya.salsabila@alumni.id',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);

        // Access /home as authenticated user
        $homeResponse = $this->actingAs($user)->get('/home');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($user->name);
        $homeResponse->assertSee('unlocked');
        $homeResponse->assertDontSee('data-auth-link');
    }

    public function test_user_can_logout_and_features_relock(): void
    {
        $user = User::where('email', 'kanya.salsabila@alumni.id')->first();

        $response = $this->actingAs($user)->post('/logout');
        $response->assertRedirect(route('home'));
        $this->assertGuest();

        $guestHomeResponse = $this->get('/home');
        $guestHomeResponse->assertStatus(200);
        $guestHomeResponse->assertSee('locked-teaser');
        $guestHomeResponse->assertSee('data-auth-link');
    }
}
