<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlumniProfile;

class AlumniDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = AlumniProfile::with('user');

        if ($request->filled('generation')) {
            $query->where('graduation_year', $request->generation);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('profession', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $alumni = $query->latest()->get();
        $generations = AlumniProfile::distinct()->orderBy('graduation_year', 'desc')->pluck('graduation_year');

        return view('alumni.index', compact('alumni', 'generations'));
    }

    public function show($slug)
    {
        // GANTI baris findOrFail($slug) dengan baris di bawah ini:
        $profile = AlumniProfile::with('user')->where('slug', $slug)->firstOrFail();

        return view('alumni.detail', compact('profile'));
    }
}
