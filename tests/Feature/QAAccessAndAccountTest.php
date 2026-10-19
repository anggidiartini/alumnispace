<?php

namespace Tests\Feature;

use App\Models\AlumniProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class QAAccessAndAccountTest extends TestCase
{
    use RefreshDatabase;

    /*
    |--------------------------------------------------------------------------
    | QA-001: Akun & Akses — Pemisahan Akses Role User vs Alumni
    |--------------------------------------------------------------------------
    */

    public function test_regular_user_cannot_access_alumni_directory(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/alumni');
        $response->assertRedirect(route('home', ['locked' => 'alumni']));
        $response->assertSessionHas('locked_feature', 'Direktori Alumni');

        $detailResponse = $this->actingAs($user)->get('/alumni/1');
        $detailResponse->assertRedirect(route('home', ['locked' => 'alumni']));
        $detailResponse->assertSessionHas('locked_feature', 'Direktori Alumni');
    }

    public function test_guest_is_redirected_when_accessing_alumni_directory(): void
    {
        $response = $this->get('/alumni');
        $response->assertRedirect(route('login'));
    }

    public function test_alumni_can_access_alumni_directory(): void
    {
        $alumniUser = User::factory()->create(['role' => 'alumni']);
        AlumniProfile::create([
            'user_id' => $alumniUser->id,
            'graduation_year' => 2020,
            'study_status' => 'Aktif',
        ]);

        $response = $this->actingAs($alumniUser)->get('/alumni');
        $response->assertStatus(200);
    }

    public function test_regular_user_menu_separates_alumni_link(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
        // The navbar should present the Alumni link locked with data-role-locked for regular user
        $response->assertSee('data-role-locked="true"', false);
        $response->assertSee('Direktori Alumni');
        $response->assertSee('Pengguna');
        // Profile settings should be separated and restricted from regular user
        $response->assertDontSee(route('profile.settings'));
    }

    /*
    |--------------------------------------------------------------------------
    | QA-004: Akun & Akses — Otorisasi Pembuatan Akun Super Admin
    |--------------------------------------------------------------------------
    */

    public function test_ordinary_admin_cannot_create_super_admin(): void
    {
        $admin = User::factory()->asAdmin()->create();

        $response = $this->actingAs($admin)->post(route('admin.admins.store'), [
            'name' => 'Calon Super Admin',
            'email' => 'hacked@superadmin.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'super_admin',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('users', ['email' => 'hacked@superadmin.com']);
    }

    public function test_ordinary_admin_create_form_does_not_contain_super_admin_option(): void
    {
        $admin = User::factory()->asAdmin()->create();

        $response = $this->actingAs($admin)->get(route('admin.admins.create'));
        $response->assertStatus(200);
        $response->assertDontSee('<option value="super_admin"', false);
    }

    public function test_ordinary_admin_cannot_edit_or_update_super_admin(): void
    {
        $admin = User::factory()->asAdmin()->create();
        $superAdmin = User::factory()->asSuperAdmin()->create([
            'email' => 'super@admin.com',
        ]);

        $editResponse = $this->actingAs($admin)->get(route('admin.admins.edit', $superAdmin->id));
        $editResponse->assertStatus(403);

        $updateResponse = $this->actingAs($admin)->put(route('admin.admins.update', $superAdmin->id), [
            'name' => 'Attempted Change',
            'email' => 'super@admin.com',
            'role' => 'admin',
        ]);
        $updateResponse->assertStatus(403);
    }

    public function test_super_admin_can_create_super_admin(): void
    {
        $superAdmin = User::factory()->asSuperAdmin()->create();

        $response = $this->actingAs($superAdmin)->post(route('admin.admins.store'), [
            'name' => 'Legit Super Admin',
            'email' => 'legit.super@alumnispace.id',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'super_admin',
        ]);

        $response->assertRedirect(route('admin.admins.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'legit.super@alumnispace.id',
            'role' => 'super_admin',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | QA-006: Akun & Akses — Penanganan Akun Nonaktif
    |--------------------------------------------------------------------------
    */

    public function test_inactive_account_login_returns_clear_blocking_message(): void
    {
        $inactiveUser = User::factory()->inactive()->create([
            'email' => 'inactive.user@example.com',
            'password' => Hash::make('correctpassword'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'inactive.user@example.com',
            'password' => 'correctpassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors([
            'email' => 'Akun Anda dinonaktifkan. Silakan hubungi administrator untuk informasi lebih lanjut.',
        ]);
        $this->assertGuest();
    }

    public function test_wrong_credentials_on_inactive_account_returns_generic_error(): void
    {
        User::factory()->inactive()->create([
            'email' => 'inactive.user2@example.com',
            'password' => Hash::make('correctpassword'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'inactive.user2@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors([
            'email' => 'Kredensial login tidak cocok dengan data kami.',
        ]);
        $this->assertGuest();
    }

    public function test_inactive_user_accessing_protected_route_is_logged_out_with_message(): void
    {
        $user = User::factory()->inactive()->create();

        $response = $this->actingAs($user)->get('/profile/settings');
        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /*
    |--------------------------------------------------------------------------
    | QA-014: Akun & Akses — Halaman Registrasi / Verifikasi Email
    |--------------------------------------------------------------------------
    */

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Daftar Akun Baru');
        $response->assertSee('name="name"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('name="password_confirmation"', false);
    }

    public function test_new_user_can_register_and_receives_user_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi Pengguna',
            'email' => 'budi.pengguna@alumnispace.id',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'Budi Pengguna',
            'email' => 'budi.pengguna@alumnispace.id',
            'role' => 'user',
            'is_active' => true,
        ]);
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_registration_fails_with_invalid_data(): void
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }

    public function test_registration_fails_when_email_already_registered(): void
    {
        User::factory()->create([
            'email' => 'existing@alumnispace.id',
        ]);

        $response = $this->post('/register', [
            'name' => 'Duplicate Person',
            'email' => 'existing@alumnispace.id',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_page_displays_registration_link(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee(route('register'));
        $response->assertSee('Daftar sekarang');
    }

    /*
    |--------------------------------------------------------------------------
    | QA-016: Akun & Akses — Proteksi Akses Footer di Halaman Landing
    |--------------------------------------------------------------------------
    */

    public function test_landing_footer_locks_member_links_for_guest(): void
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
        // Guest footer contains data-auth-link for member features
        $response->assertSee('data-auth-link data-auth-label="Direktori Alumni"', false);
        $response->assertSee('data-auth-link data-auth-label="Album Kenangan"', false);
        $response->assertSee('data-auth-link data-auth-label="Lowongan Kerja"', false);
        $response->assertSee('data-auth-link data-auth-label="Agenda Event"', false);
    }

    public function test_landing_footer_locks_alumni_and_album_for_regular_user(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        // Regular user should see locked Alumni, Album, and Lowongan links
        $response->assertSee('Direktori Alumni');
        $response->assertSee('Album Kenangan');
        $response->assertSee('Bursa Lowongan');
        $response->assertSee('data-role-locked="true"', false);
        // But can see general event link in footer
        $response->assertSee('Agenda Event');
    }

    public function test_landing_footer_shows_unlocked_links_for_alumni(): void
    {
        $alumni = User::factory()->create(['role' => 'alumni']);

        $response = $this->actingAs($alumni)->get('/home');

        $response->assertStatus(200);
        $response->assertSee('Direktori Alumni');
        $response->assertSee('Album Kenangan');
        $response->assertSee('Bursa Lowongan');
        $response->assertSee('Agenda Event');
    }

    /*
    |--------------------------------------------------------------------------
    | QA-017: Akun & Akses — Proteksi Akses Footer di Halaman Alumni
    |--------------------------------------------------------------------------
    */

    public function test_alumni_page_footer_verifies_authorization_for_alumni(): void
    {
        $alumni = User::factory()->create(['role' => 'alumni']);
        AlumniProfile::create([
            'user_id' => $alumni->id,
            'graduation_year' => 2021,
            'study_status' => 'Aktif',
        ]);

        $response = $this->actingAs($alumni)->get('/alumni');

        $response->assertStatus(200);
        $response->assertSee('Direktori Alumni');
        $response->assertSee('Album Kenangan');
        $response->assertSee('Bursa Lowongan');
        $response->assertSee('Agenda Event');
    }

    public function test_alumni_page_denies_guest_and_user_access(): void
    {
        // Guest redirected
        $guestResponse = $this->get('/alumni');
        $guestResponse->assertRedirect(route('login'));

        // Regular user receives redirect to landing page with locked popup
        $user = User::factory()->asUser()->create();
        $userResponse = $this->actingAs($user)->get('/alumni');
        $userResponse->assertRedirect(route('home', ['locked' => 'alumni']));
        $userResponse->assertSessionHas('locked_feature', 'Direktori Alumni');

        // Following redirect lands on home and displays lock popup modal
        $followResponse = $this->actingAs($user)->get(route('home', ['locked' => 'alumni']));
        $followResponse->assertStatus(200);
        $followResponse->assertSee('Akses Khusus Alumni');
        $followResponse->assertSee('Direktori Alumni');
        $followResponse->assertSee('auth-modal-overlay active', false);
    }

    /*
    |--------------------------------------------------------------------------
    | QA-018: Akun & Akses — Proteksi Akses Footer di Halaman Lowongan
    |--------------------------------------------------------------------------
    */

    public function test_lowongan_page_footer_locks_lowongan_link_for_guest(): void
    {
        $response = $this->get('/lowongan');

        $response->assertStatus(200);
        $response->assertSee('data-auth-link data-auth-label="Lowongan Kerja"', false);
    }

    public function test_lowongan_page_redirects_user_role_to_home_with_popup(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/lowongan');

        $response->assertRedirect(route('home', ['locked' => 'lowongan']));
        $response->assertSessionHas('locked_feature', 'Lowongan Kerja');

        // Following redirect lands on home and displays lock popup modal
        $followResponse = $this->actingAs($user)->get(route('home', ['locked' => 'lowongan']));
        $followResponse->assertStatus(200);
        $followResponse->assertSee('Akses Khusus Alumni');
        $followResponse->assertSee('Lowongan Kerja');
        $followResponse->assertSee('auth-modal-overlay active', false);
    }

    public function test_lowongan_page_footer_shows_unlocked_link_for_alumni(): void
    {
        $alumni = User::factory()->create(['role' => 'alumni']);

        $response = $this->actingAs($alumni)->get('/lowongan');

        $response->assertStatus(200);
        $response->assertSee('Bursa Lowongan');
    }

    /*
    |--------------------------------------------------------------------------
    | QA-019: Akun & Akses — Proteksi Akses Footer di Halaman Acara
    |--------------------------------------------------------------------------
    */

    public function test_event_page_footer_locks_agenda_event_for_guest(): void
    {
        $response = $this->get('/event');

        $response->assertStatus(200);
        $response->assertSee('data-auth-link data-auth-label="Agenda Event"', false);
    }

    public function test_event_page_footer_shows_agenda_event_for_authenticated_user(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/event');

        $response->assertStatus(200);
        $response->assertSee('Agenda Event');
    }

    /*
    |--------------------------------------------------------------------------
    | QA-020: Akun & Akses — Proteksi Akses Footer di Halaman Album
    |--------------------------------------------------------------------------
    */

    public function test_album_page_footer_locks_album_for_guest(): void
    {
        $response = $this->get('/album');

        $response->assertStatus(200);
        $response->assertSee('data-auth-link data-auth-label="Album Kenangan"', false);
    }

    public function test_album_page_redirects_user_role_to_home_with_popup(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/album');

        $response->assertRedirect(route('home', ['locked' => 'album']));
        $response->assertSessionHas('locked_feature', 'Album Kenangan');

        // Following redirect lands on home and displays lock popup modal
        $followResponse = $this->actingAs($user)->get(route('home', ['locked' => 'album']));
        $followResponse->assertStatus(200);
        $followResponse->assertSee('Akses Khusus Alumni');
        $followResponse->assertSee('Album Kenangan');
        $followResponse->assertSee('auth-modal-overlay active', false);
    }

    public function test_album_page_footer_shows_unlocked_album_for_alumni(): void
    {
        $alumni = User::factory()->create(['role' => 'alumni']);

        $response = $this->actingAs($alumni)->get('/album');

        $response->assertStatus(200);
        $response->assertSee('Album Kenangan');
    }

    /*
    |--------------------------------------------------------------------------
    | QA-021: Akun & Akses — Proteksi Akses Footer di Halaman Artikel
    |--------------------------------------------------------------------------
    */

    public function test_artikel_page_footer_adheres_to_access_matrix_for_guest(): void
    {
        $response = $this->get('/artikel');

        $response->assertStatus(200);
        // Guest is gated with data-auth-link across member features
        $response->assertSee('data-auth-link data-auth-label="Direktori Alumni"', false);
        $response->assertSee('data-auth-link data-auth-label="Album Kenangan"', false);
        $response->assertSee('data-auth-link data-auth-label="Lowongan Kerja"', false);
        $response->assertSee('data-auth-link data-auth-label="Agenda Event"', false);
    }

    public function test_artikel_page_footer_adheres_to_access_matrix_for_regular_user(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/artikel');

        $response->assertStatus(200);
        // Alumni, Album & Lowongan are present and locked for role user
        $response->assertSee('Direktori Alumni');
        $response->assertSee('Album Kenangan');
        $response->assertSee('Bursa Lowongan');
        $response->assertSee('data-role-locked="true"', false);
        $response->assertSee('Agenda Event');
    }

    public function test_artikel_page_footer_adheres_to_access_matrix_for_alumni(): void
    {
        $alumni = User::factory()->create(['role' => 'alumni']);

        $response = $this->actingAs($alumni)->get('/artikel');

        $response->assertStatus(200);
        $response->assertSee('Direktori Alumni');
        $response->assertSee('Album Kenangan');
        $response->assertSee('Bursa Lowongan');
        $response->assertSee('Agenda Event');
    }

    public function test_user_role_sees_alumni_and_album_locked_in_navbar_and_footer(): void
    {
        $user = User::factory()->asUser()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        // Navbar and footer have locked Alumni, Album, and Lowongan attributes
        $response->assertSee('data-role-locked="true"', false);
        $response->assertSee('data-auth-label="Direktori Alumni"', false);
        $response->assertSee('data-auth-label="Album Kenangan"', false);
        $response->assertSee('data-auth-label="Lowongan Kerja"', false);
        // Footer has locked message modal
        $response->assertSee('Akses Khusus Alumni');
        $response->assertSee('Fitur <strong id="auth-modal-label">fitur ini</strong> hanya dapat diakses oleh akun Alumni terverifikasi.', false);
    }

    public function test_alumni_role_sees_alumni_and_album_unlocked_in_navbar_and_footer(): void
    {
        $alumni = User::factory()->create(['role' => 'alumni']);

        $response = $this->actingAs($alumni)->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('data-role-locked');
    }
}
