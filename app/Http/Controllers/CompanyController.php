<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index($slug)
    {
        // 1. CARI PERUSAHAAN: Langsung cari ke tabel companies berdasarkan slug resminya
        $companyProfile = Company::where('slug', $slug)->firstOrFail();

        // 2. AMBIL DAFTAR LOWONGAN: Tarik bursa loker aktif lewat relasi id perusahaan
        $jobs = JobVacancy::where('company_id', $companyProfile->id)
            ->where('is_active', true)
            ->latest()
            ->get();

        // 3. OPER KE VIEW: Mengarah ke file resources/views/perusahaan/index.blade.php
        return view('perusahaan.index', compact('companyProfile', 'jobs'));
    }
}
