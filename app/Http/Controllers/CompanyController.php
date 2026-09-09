<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index($slug)
    {
        $company = Company::where('slug', $slug)->first();

        if (!$company) {
            $namaAsli = str_replace('-', ' ', $slug);
            $company = Company::where('name', 'like', "%{$namaAsli}%")->first();
        }

        if (!$company) {
            abort(404);
        }

        $jobs = JobVacancy::where('company_id', $company->id)
            ->where('is_active', true)
            ->latest()
            ->get();

        $companyProfile = $company;

        return view('perusahaan.index', compact('companyProfile', 'jobs'));
    }
}
