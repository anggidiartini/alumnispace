<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PageContent;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class CmsAndRoleAccessTest extends TestCase
{
    use DatabaseMigrations;

    protected User $adminUser;
    protected User $alumniUser;
    protected PageContent $heroContent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::create([
            'name' => 'Administrator',
            'email' => 'admin@alumnispace.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->alumniUser = User::create([
            'name' => 'Kanya Alumni',
            'email' => 'kanya@alumni.id',
            'password' => Hash::make('password123'),
            'role' => 'alumni',
            'status' => 'active',
        ]);

        $this->heroContent = PageContent::create([
            'page_slug' => 'home',
            'section_key' => 'hero_banner',
            'title' => 'Judul Awal Komunitas',
            'subtitle' => 'Subjudul awal komunitas alumni.',
            'is_active' => true,
        ]);

        SiteSetting::create([
            'key' => 'brand_name',
            'value' => 'Alumni Connect Test',
            'is_public' => true,
        ]);
    }

    public function test_public_can_fetch_content_via_api(): void
    {
        $response = $this->getJson('/api/v1/public/content/home');

        $response->assertStatus(200);
        $response->assertJsonPath('status', 'success');
        $response->assertJsonPath('sections.hero_banner.title', 'Judul Awal Komunitas');
    }

    public function test_guest_is_redirected_when_accessing_admin(): void
    {
        $response = $this->get('/admin/content');
        $response->assertRedirect('/login');
    }

    public function test_regular_alumni_is_forbidden_from_admin_content(): void
    {
        $response = $this->actingAs($this->alumniUser)->get('/admin/content');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_content_cms(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/content');
        $response->assertStatus(200);
        $response->assertSee('AlumniSpace CMS');
        $response->assertSee('Judul Awal Komunitas');
    }

    public function test_admin_can_update_content_and_it_reflects_on_home(): void
    {
        // Admin updates the hero title & subtitle
        $updateResponse = $this->actingAs($this->adminUser)->put("/admin/content/{$this->heroContent->id}", [
            'title' => 'Judul Baru Dari Admin Super',
            'subtitle' => 'Subjudul terupdate dan terverifikasi.',
        ]);

        $updateResponse->assertSessionHas('status');

        // Check on home view
        $homeResponse = $this->get('/home');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Judul Baru Dari Admin Super');
        $homeResponse->assertSee('Subjudul terupdate dan terverifikasi.');
    }
}
