<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\AlumniProfile;
use App\Models\Event;
use App\Models\Album;
use App\Models\Testimonial;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user() ?? AlumniProfile::with('user')
            ->whereHas('user', function ($q) {
                $q->where('email', 'kanya.salsabila@alumni.id');
            })
            ->first()?->user;

        $jobs = JobVacancy::where('is_active', true)
            ->latest()
            ->take(10)
            ->get();

        $alumni = AlumniProfile::with('user')
            ->latest()
            ->take(8)
            ->get();

        $events = Event::latest('event_date')->take(3)->get();
        $albums = Album::latest()->take(4)->get();

        $testimonials = Testimonial::where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        $articles = Article::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Ambil periode kepengurusan yang sedang aktif.
        $today = now()->toDateString();

        $activePeriod = DB::table('committee_periods')
            ->whereDate('start_date', '<=', $today)
            ->where(function ($query) use ($today) {
                $query->whereNull('finish_date')
                    ->orWhereDate('finish_date', '>=', $today);
            })
            ->orderByDesc('start_date')
            ->orderByDesc('id')
            ->first();

        // Ambil data pengurus beserta periode kepengurusannya.
        $pengurusQuery = DB::table('alumni_committees')
            ->join(
                'alumni_profiles',
                'alumni_committees.alumni_profile_id',
                '=',
                'alumni_profiles.id'
            )
            ->join(
                'users',
                'alumni_profiles.user_id',
                '=',
                'users.id'
            )
            ->join(
                'committee_periods',
                'alumni_committees.committee_period_id',
                '=',
                'committee_periods.id'
            )
            ->select(
                'alumni_committees.id',
                'alumni_committees.position',
                'alumni_committees.alumni_profile_id',
                'alumni_committees.committee_period_id',
                'users.name as nama',
                'alumni_profiles.avatar as foto',
                'committee_periods.period_name',
                'committee_periods.start_date',
                'committee_periods.finish_date'
            );

        if ($activePeriod) {
            $pengurusQuery->where(
                'alumni_committees.committee_period_id',
                $activePeriod->id
            );
        }

        $pengurus = $pengurusQuery
            ->orderBy('alumni_committees.id')
            ->get()
            ->map(function ($p) {
                // Resolve foto pengurus (uploads/xxx.jpg) jadi URL yang valid
                $p->foto_url = AlumniProfile::resolveAvatarUrl($p->foto);
                return $p;
            });

        $stats = [
            'total_alumni' => AlumniProfile::active()->count() ?: 2540,
            'total_generations' => AlumniProfile::active()
                ->distinct('graduation_year')
                ->count('graduation_year') ?: 45,
            'total_jobs' => JobVacancy::where('is_active', true)->count() ?: 180,
            'total_countries' => 35,
        ];

        $contents = \App\Models\PageContent::where('page_slug', 'home')
            ->where('is_active', true)
            ->get()
            ->keyBy('section_key');

        $settings = \App\Models\SiteSetting::where('is_public', true)
            ->pluck('value', 'key');

        return view('user.home.index', compact(
            'currentUser',
            'jobs',
            'alumni',
            'events',
            'albums',
            'testimonials',
            'articles',
            'stats',
            'contents',
            'settings',
            'pengurus',
            'activePeriod'
        ));
    }
}
