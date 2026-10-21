<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlumniProfile;
use App\Models\AlumniAchievement;

class AlumniDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $activeBase = AlumniProfile::active();

        $totalActiveAlumni = (clone $activeBase)->count();
        $minYear = (clone $activeBase)->min('graduation_year');
        $maxYear = (clone $activeBase)->max('graduation_year');

        $yearRange = ($minYear && $maxYear)
            ? ($minYear == $maxYear ? $minYear : "{$minYear}–{$maxYear}")
            : '-';

        $connectedCitiesCount = (clone $activeBase)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct('city')
            ->count('city');

        $generations = (clone $activeBase)
            ->whereNotNull('graduation_year')
            ->distinct()
            ->orderBy('graduation_year', 'desc')
            ->pluck('graduation_year');

        $cities = (clone $activeBase)
            ->whereNotNull('city')
            ->where('city', '!=', '')
            ->distinct()
            ->orderBy('city', 'asc')
            ->pluck('city');

        $query = AlumniProfile::active()->with('user');

        if ($request->filled('generation')) {
            $query->where('graduation_year', $request->generation);
        }

        if ($request->filled('city')) {
            $query->where('city', $request->city);
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

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'total_active' => $totalActiveAlumni,
                'count' => $alumni->count(),
                'data' => $alumni->map(function ($item) {
                    $name = $item->user->name ?? 'Alumni';
                    $words = preg_split('/\s+/', trim($name));

                    $initials = strtoupper(
                        mb_substr($words[0] ?? '', 0, 1)
                        . mb_substr($words[1] ?? '', 0, 1)
                    );


                    return [
                        'id' => $item->id,
                        'slug' => $item->slug ?? $item->id,
                        'name' => $name,
                        'graduation_year' => $item->graduation_year,
                        'profession' => $item->profession,
                        'company' => $item->company,
                        'city' => $item->city,
                        'bio' => $item->bio
                            ? \Illuminate\Support\Str::limit($item->bio, 60)
                            : null,
                        'avatar_url' => $item->avatar_url,
                        'initials' => $initials,
                        'profile_url' => route(
                            'alumni.show',
                            $item->slug ?? $item->id
                        ),
                    ];
                }),
            ])->header(
                'Cache-Control',
                'no-store, no-cache, must-revalidate, max-age=0'
            );
        }

        return response()
            ->view('user.alumni.index', compact(
                'alumni',
                'generations',
                'cities',
                'totalActiveAlumni',
                'yearRange',
                'connectedCitiesCount'
            ))
            ->header(
                'Cache-Control',
                'no-store, no-cache, must-revalidate, max-age=0'
            );
    }

    public function show($slug)
    {
        $profile = AlumniProfile::active()
            ->with('user')
            ->where(function ($q) use ($slug) {
                $q->where('slug', $slug);

                if (is_numeric($slug)) {
                    $q->orWhere('id', $slug);
                }
            })
            ->firstOrFail();

        // Ambil prestasi aktif milik alumni ini dari tabel prestasi.
        $achievements = AlumniAchievement::where(
                'user_id',
                $profile->user_id
            )
            ->where('status', 1)
            ->orderBy('date', 'desc')
            ->get();

        return response()
            ->view('user.alumni.detail', compact(
                'profile',
                'achievements'
            ))
            ->header(
                'Cache-Control',
                'no-store, no-cache, must-revalidate, max-age=0'
            );
    }
}
