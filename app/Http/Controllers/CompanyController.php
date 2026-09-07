<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    // Menggunakan fungsi index agar sesuai dengan rute perusahaan.index
    public function index($slug)
    {
        // 1. CARI PERUSAHAAN: Mengubah tanda hubung (-) menjadi % agar pencarian SQL LIKE lebih akurat
        $searchName = str_replace('-', '%', $slug);
        
        $companyProfile = JobVacancy::where('company_name', 'LIKE', "%{$searchName}%")->first();

        // 2. FALLBACK: Jika tidak ketemu, coba cari barangkali yang terkirim di URL adalah slug lowongannya
        if (!$companyProfile) {
            $companyProfile = JobVacancy::where('slug', $slug)->first();
        }

        // 3. PROTEKSI 404: Jika data tidak ditemukan, hentikan proses dengan aman
        if (!$companyProfile) {
            abort(404, 'Perusahaan tidak ditemukan di database.');
        }

        // 4. AMBIL DAFTAR LOWONGAN: Ambil semua lowongan kerja aktif khusus dari perusahaan ini
        $jobs = JobVacancy::where('company_name', $companyProfile->company_name)
            ->where('is_active', true)
            ->latest()
            ->get();

        // 5. OPER KE VIEW: Mengarah ke file resources/views/perusahaan/index.blade.php
        return view('perusahaan.index', compact('companyProfile', 'jobs'));
    }
}
