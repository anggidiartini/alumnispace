<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

        $jobs = JobVacancy::where('company_name', $company->name)
            ->where('is_active', true)
            ->latest()
            ->get();

        $companyProfile = $company;

        return view('lowongan.perusahaan.index', compact('companyProfile', 'jobs'));
    }
}
