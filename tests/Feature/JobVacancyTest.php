<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class JobVacancyTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('category', 100)->nullable();
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
                $table->foreignId('posted_by')->nullable();
                $table->foreignId('company_id')->nullable();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('category', 100)->nullable();
                $table->string('company_name');
                $table->string('company_logo')->nullable();
                $table->text('company_description')->nullable();
                $table->string('company_maps_url')->nullable();
                $table->string('company_instagram')->nullable();
                $table->string('company_linkedin')->nullable();
                $table->string('alumni_contact')->nullable();
                $table->string('job_type', 50)->default('Full-Time');
                $table->string('workplace_type')->default('Onsite');
                $table->string('highlight_badge')->nullable();
                $table->string('location')->default('Jakarta');
                $table->string('salary_display')->nullable();
                $table->string('salary_type')->nullable();
                $table->text('description')->nullable();
                $table->text('requirements')->nullable();
                $table->json('skills_tags')->nullable();
                $table->string('application_link')->nullable();
                $table->string('application_email')->nullable();
                $table->date('deadline')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('job_applications')) {
            Schema::create('job_applications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('job_vacancy_id');
                $table->foreignId('applicant_id');
                $table->string('portfolio_url')->nullable();
                $table->text('cover_letter')->nullable();
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('role')->default('user');
                $table->boolean('is_active')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    public function test_lowongan_index_page_loads_successfully(): void
    {
        JobVacancy::create([
            'title' => 'Software Engineer',
            'slug' => 'software-engineer-test',
            'company_name' => 'Acme Corp',
            'job_type' => 'Full-Time',
            'location' => 'Jakarta',
            'is_active' => true,
        ]);

        $response = $this->get('/lowongan');

        $response->assertStatus(200);
        $response->assertViewIs('user.lowongan.index');
        $response->assertViewHas('jobs');
        $response->assertViewHas('totalActive');
    }

    public function test_lowongan_detail_page_loads_with_null_category_without_sql_errors(): void
    {
        $job = JobVacancy::create([
            'title' => 'Freelance Web Designer',
            'slug' => 'freelance-web-designer-slug',
            'company_name' => 'Design Studio',
            'job_type' => 'Freelance',
            'category' => null,
            'location' => 'Remote',
            'is_active' => true,
        ]);

        $otherJob = JobVacancy::create([
            'title' => 'Freelance Copywriter',
            'slug' => 'freelance-copywriter-slug',
            'company_name' => 'Creative Agency',
            'job_type' => 'Freelance',
            'category' => null,
            'location' => 'Remote',
            'is_active' => true,
        ]);

        $response = $this->get('/lowongan/' . $job->slug);

        $response->assertStatus(200);
        $response->assertViewIs('user.lowongan.detail');
        $response->assertSee('Freelance Web Designer');
        $response->assertViewHas('relatedJobs');
    }

    public function test_guest_cannot_apply_and_is_redirected(): void
    {
        $job = JobVacancy::create([
            'title' => 'Product Manager',
            'slug' => 'product-manager-slug',
            'company_name' => 'Startup Inc',
            'job_type' => 'Full-Time',
            'location' => 'Bandung',
            'is_active' => true,
        ]);

        $response = $this->post('/lowongan/' . $job->id . '/apply', [
            'cover_letter' => 'Saya tertarik melamar',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_apply_successfully(): void
    {
        $user = User::create([
            'name' => 'Pelamar Test',
            'email' => 'pelamar@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'is_active' => true,
        ]);

        $job = JobVacancy::create([
            'title' => 'Data Analyst',
            'slug' => 'data-analyst-slug',
            'company_name' => 'Data Labs',
            'job_type' => 'Full-Time',
            'location' => 'Surabaya',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->post('/lowongan/' . $job->id . '/apply', [
            'cover_letter' => 'Saya memiliki pengalaman 2 tahun.',
            'portfolio_url' => 'https://portfolio.example.com',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('job_applications', [
            'job_vacancy_id' => $job->id,
            'applicant_id' => $user->id,
            'status' => 'pending',
        ]);
    }
}
