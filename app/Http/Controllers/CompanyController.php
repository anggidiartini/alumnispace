<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Menampilkan halaman detail/profil perusahaan berdasarkan slug unik.
     * rute: /perusahaan/{slug}
     */
    public function index($slug)
    {
        // 1. CARI PERUSAHAAN: Langsung cari ke tabel companies berdasarkan slug resminya
        // firstOrFail() otomatis melempar halaman 404 jika slug tidak ditemukan di database
        $company = Company::where('slug', $slug)->firstOrFail();

        // 2. AMBIL DAFTAR LOWONGAN: Ambil semua bursa lowongan kerja aktif khusus dari perusahaan ini
        // Menggunakan foreign key 'company_id' agar query pencarian data jauh lebih cepat dan akurat
        $jobs = JobVacancy::where('company_id', $company->id)
            ->where('is_active', true)
            ->latest()
            ->get();

        // 3. OPER KE VIEW: Variabel 'companyProfile' dan 'jobs' di-oper ke view blade
        // agar sinkron dengan variabel bawaan yang ada di file resources/views/perusahaan/index.blade.php Anda
        $companyProfile = $company;

        return view('perusahaan.index', compact('companyProfile', 'jobs'));
    }
}
