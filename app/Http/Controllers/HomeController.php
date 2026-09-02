<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobVacancy;
use App\Models\AlumniProfile;
use App\Models\Event;
use App\Models\Album;
use App\Models\Testimonial;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user() ?? AlumniProfile::with('user')->whereHas('user', function ($q) {
            $q->where('email', 'kanya.salsabila@alumni.id');
        })->first()?->user;

        $jobs = JobVacancy::where('is_active', true)->latest()->take(10)->get();
        $alumni = AlumniProfile::with('user')->latest()->take(8)->get();
        $events = Event::latest('event_date')->take(3)->get();
        $albums = Album::latest()->take(4)->get();
        $testimonials = Testimonial::where('is_featured', true)->latest()->take(3)->get();
        $articles = Article::where('is_published', true)->latest('published_at')->take(3)->get();

        $stats = [
            'total_alumni' => AlumniProfile::count() ?: 2540,
            'total_generations' => AlumniProfile::distinct('graduation_year')->count('graduation_year') ?: 45,
            'total_jobs' => JobVacancy::where('is_active', true)->count() ?: 180,
            'total_countries' => 35,
        ];

        return view('home.index', compact('currentUser', 'jobs', 'alumni', 'events', 'albums', 'testimonials', 'articles', 'stats'));
    }
}
