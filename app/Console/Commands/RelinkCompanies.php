<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Console\Command;

class RelinkCompanies extends Command
{
    protected $signature = 'company:relink';
    protected $description = 'Perbaiki company_id di job_vacancies supaya sesuai dengan data companies yang benar';

    public function handle()
    {
        $companies = Company::all()->keyBy(function ($c) {
            return strtolower(trim($c->name));
        });

        $fixed = 0;
        $notFound = [];

        foreach (JobVacancy::whereNotNull('company_name')->get() as $job) {
            $key = strtolower(trim($job->company_name));
            $company = $companies->get($key);

            if ($company) {
                if ($job->company_id !== $company->id) {
                    $job->update(['company_id' => $company->id]);
                    $fixed++;
                }
            } else {
                $notFound[] = $job->company_name;
            }
        }

        $this->info("Selesai. {$fixed} lowongan diperbaiki relasinya.");

        if (count($notFound)) {
            $this->warn("Nama perusahaan yang tidak ketemu match persis:");
            foreach (array_unique($notFound) as $n) {
                $this->line("- {$n}");
            }
        }
    }
}