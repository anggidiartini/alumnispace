<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\Album;
use App\Models\AlumniProfile;
use App\Models\JobVacancy;
use App\Models\Event;

class LandingController extends Controller
{
    public function index()
    {
        $stats = [
            'total_alumni' => AlumniProfile::count() ?: 5000,
            'total_generations' => AlumniProfile::distinct('graduation_year')->count('graduation_year') ?: 25,
            'total_jobs' => JobVacancy::where('is_active', true)->count() ?: 150,
            'total_events' => Event::count() ?: 40,
        ];

        $testimonials = Testimonial::where('is_featured', true)->latest()->take(6)->get();
        $articles = Article::where('is_published', true)->latest('published_at')->take(3)->get();
        $albums = Album::where('is_featured', true)->latest()->take(4)->get();

        return view('landing.index', compact('stats', 'testimonials', 'articles', 'albums'));
    }
}
