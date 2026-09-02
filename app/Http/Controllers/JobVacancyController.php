<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    public function index(Request $request)
    {
        $query = JobVacancy::where('is_active', true);

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('job_type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $jobs = $query->latest()->get();
        $totalActive = JobVacancy::where('is_active', true)->count();

        return view('lowongan.index', compact('jobs', 'totalActive'));
    }

    public function show($slug)
    {
        $job = JobVacancy::where('slug', $slug)->firstOrFail();
        $relatedJobs = JobVacancy::where('is_active', true)
            ->where('id', '!=', $job->id)
            ->where(function ($q) use ($job) {
                $q->where('category', $job->category)
                  ->orWhere('job_type', $job->job_type);
            })
            ->take(3)
            ->get();

        return view('lowongan.detail', compact('job', 'relatedJobs'));
    }

    public function apply(Request $request, $id)
    {
        $job = JobVacancy::findOrFail($id);

        $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'portfolio_url' => 'nullable|url',
        ]);

        $user = Auth::user();

        if ($user) {
            JobApplication::create([
                'job_vacancy_id' => $job->id,
                'applicant_id' => $user->id,
                'portfolio_url' => $request->portfolio_url,
                'cover_letter' => $request->cover_letter,
                'status' => 'pending',
            ]);
        }

        return back()->with('success', 'Lamaran berhasil dikirim ke perusahaan alumni!');
    }
}
