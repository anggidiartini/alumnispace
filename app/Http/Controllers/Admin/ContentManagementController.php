<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ContentManagementController extends Controller
{
    /**
     * Display CMS page with content editor.
     */
    public function index(Request $request)
    {
        $contents = PageContent::orderBy('page_slug')->orderBy('section_key')->get();
        $settings = SiteSetting::orderBy('group')->get();

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
            'alumni' => \App\Models\Album::count(),
            'event' => \App\Models\Event::count(),
            'job_vacancy' => \App\Models\JobVacancy::count(),
            'Article' => \App\Models\Article::count(),
        ];

        // Bagian ambil data list/tabel terbaru untuk ditampilkan di dashboard admin
        $recentAlumni = \App\Models\AlumniProfile::with('user')->latest()->take(5)->get();
        $upcomingAcara = \App\Models\Event::latest()->take(5)->get();
        $latestArticles = \App\Models\Article::latest()->take(5)->get();
        $recentTestimonies = \App\Models\Testimony::latest()->take(5)->get();
        $recentPrestasi = \App\Models\Prestasi::latest()->take(5)->get();
        

        return view('dashboard', compact(
            'counts',
            'recentAlumni',
            'upcomingAcara',
            'latestArticles',
            'recentTestimonies',
            'recentPrestasi'
        ));
    }

    /**
     * Store new page content section.
     */
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

    /**
     * Update page content section.
     */
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

    /**
     * Batch update site settings.
     */
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

    /**
     * Delete a page content section.
     */
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
