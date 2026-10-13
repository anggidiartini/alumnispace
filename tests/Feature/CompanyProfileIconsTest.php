<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CompanyProfileIconsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('industry')->nullable();
                $table->string('location')->nullable();
                $table->text('description')->nullable();
                $table->string('whatsapp')->nullable();
                $table->string('website')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('instagram')->nullable();
                $table->string('email')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('job_vacancies')) {
            Schema::create('job_vacancies', function (Blueprint $table) {
                $table->id();
                $table->string('company_name')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        Company::updateOrCreate(
            ['slug' => 'test-company-icons'],
            [
                'name' => 'Test Company Icons',
                'slug' => 'test-company-icons',
                'whatsapp' => '6281234567890',
                'website' => 'https://example.com',
                'linkedin' => 'https://linkedin.com',
                'email' => 'info@example.com',
                'description' => 'Test company description',
            ]
        );
    }

    public function test_company_page_renders_social_icons_with_consistent_button_styling(): void
    {
        $response = $this->get('/perusahaan/test-company-icons');

        $response->assertStatus(200);
        $response->assertSee('w-10 h-10 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center');
    }

    public function test_whatsapp_and_website_svg_icons_use_clean_outline_attributes(): void
    {
        $response = $this->get('/perusahaan/test-company-icons');

        $response->assertStatus(200);
        // Verify WhatsApp SVG attributes and outline path
        $response->assertSee('class="whatsapp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"', false);
        // Verify Globe SVG attributes and latitude/longitude lines
        $response->assertSee('class="globe-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"', false);
        $response->assertSee('<circle cx="12" cy="12" r="10"></circle>', false);
        $response->assertSee('<line x1="2" y1="12" x2="22" y2="12"></line>', false);
    }
}
