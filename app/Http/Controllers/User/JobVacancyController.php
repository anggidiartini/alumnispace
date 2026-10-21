<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Models\JobVacancy;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    /**
     * Menampilkan daftar lowongan aktif.
     */
    public function index(Request $request)
    {
        // Batasi akses halaman lowongan untuk role user biasa.
        if (auth()->check() && auth()->user()->role === 'user') {
            return redirect()
                ->route('home', ['locked' => 'lowongan'])
                ->with('locked_feature', 'Lowongan Kerja');
        }

        $query = JobVacancy::where('is_active', true);

        // Filter berdasarkan sifat pekerjaan.
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('job_type', $request->type);
        }

        // Pencarian berdasarkan posisi, perusahaan, dan deskripsi.
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $jobs = $query
            ->with('company')
            ->latest()
            ->get();

        $totalActive = JobVacancy::where('is_active', true)->count();

        // Ambil kategori aktif yang dikelola melalui menu Kelola Kategori.
        $categories = JobCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'user.lowongan.index',
            compact('jobs', 'totalActive', 'categories')
        );
    }

    /**
     * Menampilkan detail lowongan berdasarkan slug.
     */
    public function show($slug)
    {
        // Batasi akses halaman detail untuk role user biasa.
        if (auth()->check() && auth()->user()->role === 'user') {
            return redirect()
                ->route('home', ['locked' => 'lowongan'])
                ->with('locked_feature', 'Lowongan Kerja');
        }

        $job = JobVacancy::where('is_active', true)
            ->with('company')
            ->where('slug', $slug)
            ->firstOrFail();

        // Cari lowongan lain yang memiliki kategori atau jenis pekerjaan
        // yang sama. Kategori tetap menggunakan nama dari job_vacancies.
        $relatedJobs = JobVacancy::where('is_active', true)
            ->where('id', '!=', $job->id)
            ->where(function ($query) use ($job) {
                if (!empty($job->category)) {
                    $query->where('category', $job->category);

                    if (!empty($job->job_type)) {
                        $query->orWhere('job_type', $job->job_type);
                    }
                } elseif (!empty($job->job_type)) {
                    $query->where('job_type', $job->job_type);
                } else {
                    $query->whereRaw('1 = 0');
                }
            })
            ->latest()
            ->take(3)
            ->get();

        // Ambil data kategori untuk menampilkan deskripsinya di halaman detail.
        $category = null;

        if (!empty($job->category)) {
            $category = JobCategory::where('name', $job->category)
                ->where('status', 1)
                ->first();
        }

        return view(
            'user.lowongan.detail',
            compact('job', 'relatedJobs', 'category')
        );
    }

    /**
     * Mengirim lamaran untuk lowongan aktif.
     */
    public function apply(Request $request, $id)
    {
        $job = JobVacancy::where('is_active', true)
            ->findOrFail($id);

        $user = Auth::user();

        // Pengguna harus login sebelum melamar.
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Silakan login terlebih dahulu untuk melamar pekerjaan ini.',
                    'redirect' => route('login'),
                ], 401);
            }

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu untuk melamar pekerjaan ini.'
                );
        }

        $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'portfolio_url' => 'nullable|url',
        ]);

        // Cegah pengguna melamar lowongan yang sama lebih dari sekali.
        $alreadyApplied = JobApplication::where(
            'job_vacancy_id',
            $job->id
        )
            ->where('applicant_id', $user->id)
            ->exists();

        if ($alreadyApplied) {
            $message = 'Kamu sudah pernah melamar untuk posisi ini.';

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $message,
                ], 409);
            }

            return back()->with('error', $message);
        }

        JobApplication::create([
            'job_vacancy_id' => $job->id,
            'applicant_id' => $user->id,
            'portfolio_url' => $request->portfolio_url,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Lamaran berhasil dikirim ke perusahaan alumni!',
            ], 201);
        }

        return back()->with(
            'success',
            'Lamaran berhasil dikirim ke perusahaan alumni!'
        );
    }
}
