<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncCompanies extends Command
{
    protected $signature = 'company:sync';
    protected $description = 'Buat row Company untuk setiap company_name di job_vacancies yang belum ada';

    public function handle()
    {
        $companyNames = JobVacancy::whereNotNull('company_name')
            ->pluck('company_name')
            ->unique();

        $created = 0;
        $linked = 0;

        foreach ($companyNames as $name) {
            $slug = Str::slug($name);

            $company = Company::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'industry' => 'Lainnya',
                    'location' => '-',
                    'description' => 'Profil perusahaan ini dibuat otomatis dari data lowongan yang tersedia.',
                    'address' => '-',
                    'city' => '-',
                    'email' => 'info@' . $slug . '.com',
                ]
            );

            if ($company->wasRecentlyCreated) {
                $created++;
                $this->info("Dibuat: {$name} ({$slug})");
            }

            if (\Illuminate\Support\Facades\Schema::hasColumn('job_vacancies', 'company_id')) {
                $updated = JobVacancy::where('company_name', $name)
                    ->whereNull('company_id')
                    ->update(['company_id' => $company->id]);
                $linked += $updated;
            }
        }

        $this->info("Selesai. {$created} perusahaan baru dibuat, {$linked} lowongan dihubungkan.");
    }
}