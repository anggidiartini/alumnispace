<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;

class ContentManagementController extends Controller
{
    /**
     * Sinkronisasi data hitungan lencana sidebar secara dinamis.
     */
    private function shareSidebarCounts()
    {
        \View::share('counts', [
            'alumnis' => \Schema::hasTable('alumni_profiles') ? \DB::table('alumni_profiles')->count() : 0,
            'graduations' => \Schema::hasTable('alumni_profiles') ? \DB::table('alumni_profiles')->distinct('graduation_year')->count('graduation_year') : 0,
            'schoolclasses' => 0,
            'alumni_achievements' => 0,
            'board_periods' => 0,
            'alumni_boards' => 0,
            'job_categories' => 0,
            'job_vacancies' => \Schema::hasTable('job_vacancies') ? \DB::table('job_vacancies')->count() : 0,
            'articles' => \Schema::hasTable('articles') ? \DB::table('articles')->count() : 0,
            'event' => \Schema::hasTable('events') ? \DB::table('events')->count() : 0,
            'albums' => \Schema::hasTable('albums') ? \DB::table('albums')->count() : 0,
            'galleries' => \Schema::hasTable('album_photos') ? \DB::table('album_photos')->count() : 0,
            'contents' => \Schema::hasTable('page_contents') ? \DB::table('page_contents')->count() : 0
        ]);
    }

    /**
     * Display CMS page with content editor.
     */
    public function index(Request $request)
    {
        $contents = PageContent::orderBy('page_slug')->orderBy('section_key')->get();
        $settings = SiteSetting::orderBy('group')->get();

        $this->shareSidebarCounts();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'contents' => $contents,
                'settings' => $settings,
            ]);
        }

        return view('admin.content.index', compact('contents', 'settings'));
    }

    public function dashboard()
    {
        $count = [
            'alumni' => \Schema::hasTable('albums') ? \App\Models\Album::count() : 0,
            'event' => \Schema::hasTable('events') ? \App\Models\Event::count() : 0,
            'job_vacancy' => \Schema::hasTable('job_vacancies') ? \App\Models\JobVacancy::count() : 0,
            'Article' => \Schema::hasTable('articles') ? \App\Models\Article::count() : 0,
        ];

        $recentAlumni = \Schema::hasTable('alumni_profiles') ? \App\Models\AlumniProfile::with('user')->latest()->take(5)->get() : collect();
        $upcomingAcara = \Schema::hasTable('events') ? \App\Models\Event::latest()->take(5)->get() : collect();
        $latestArticles = \Schema::hasTable('articles') ? \App\Models\Article::latest()->take(5)->get() : collect();
        $recentTestimonials = \Schema::hasTable('testimonials') ? \DB::table('testimonials')->latest()->take(5)->get() : collect();
        $recentPrestasi = collect(); 

        $statistikHariIni = \Schema::hasTable('visitors') ? \DB::table('visitors')->whereDate('created_at', today())
            ->selectRaw('HOUR(created_at) as jam, COUNT(*) as total')
            ->groupBy('jam')
            ->orderBy('jam', 'asc')
            ->get() : collect();

        $labels = [];
        $data = [];

        foreach ($statistikHariIni as $row) {
            $labels[] = sprintf('%02d:00', $row->jam);
            $data[] = $row->total;
        }

        $this->shareSidebarCounts();

        return view('admin.dashboard.index', compact(
            'count',
            'recentAlumni',
            'upcomingAcara',
            'latestArticles',
            'recentTestimonials',
            'recentPrestasi',
            'labels',  
            'data'    
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_slug' => 'required|string|max:60',
            'section_key' => 'required|string|max:60|unique:page_contents,section_key',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'body_content' => 'nullable|string',
            'meta_data' => 'nullable|array',
            'media_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = Auth::id();
        $content = PageContent::create($validated);

        Cache::forget("page_content_{$content->page_slug}");
        Cache::forget("section_{$content->section_key}");

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Konten seksi '{$content->section_key}' berhasil dibuat.",
                'data' => $content,
            ], 201);
        }

        return back()->with('status', "Seksi '{$content->section_key}' berhasil ditambahkan.");
    }

    public function update(Request $request, $id)
    {
        $content = PageContent::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'body_content' => 'nullable|string',
            'meta_data' => 'nullable|array',
            'media_url' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['updated_by'] = Auth::id();
        if ($request->has('is_active')) {
            $validated['is_active'] = $request->boolean('is_active');
        }

        $content->update($validated);

        Cache::forget("page_content_{$content->page_slug}");
        Cache::forget("section_{$content->section_key}");

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Konten seksi '{$content->section_key}' berhasil diperbarui.",
                'data' => $content,
            ]);
        }

        return back()->with('status', "Konten '{$content->title}' berhasil diperbarui.");
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        foreach ($validated['settings'] as $key => $value) {
            SiteSetting::set($key, $value);
        }

        Cache::forget('public_site_settings');

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pengaturan situs berhasil disimpan.',
            ]);
        }

        return back()->with('status', 'Pengaturan situs berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $content = PageContent::findOrFail($id);
        $slug = $content->page_slug;
        $key = $content->section_key;

        $content->delete();

        Cache::forget("page_content_{$slug}");
        Cache::forget("section_{$key}");

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Seksi '{$key}' berhasil dihapus.",
            ]);
        }

        return back()->with('status', "Seksi '{$key}' berhasil dihapus.");
    }
}
