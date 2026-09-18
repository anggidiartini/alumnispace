<?php

namespace App\Http\Controllers\Admin\Albums;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('photos')->latest()->get();
        $this->shareSidebarCounts();

        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        $this->shareSidebarCounts();

        return view('admin.albums.form');
    }

    public function store(Request $request)
    {
        $album = Album::create($this->validatedData($request));

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil disimpan.');
    }

    public function show($id)
    {
        $album = Album::withCount('photos')->findOrFail($id);
        $this->shareSidebarCounts();

        return view('admin.albums.show', compact('album'));
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $this->shareSidebarCounts();

        return view('admin.albums.form', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        $album->update($this->validatedData($request));

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Album::findOrFail($id)->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|string|max:50',
            'subtitle_label' => 'nullable|string|max:100',
            'sticker_tag' => 'nullable|string|max:50',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:500',
            'event_date' => 'nullable|date',
            'date_display' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'target_generation' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename . '.' . $extension);
            $validated['cover_photo'] = 'uploads/' . $filename . '.' . $extension;
        } else {
            unset($validated['cover_photo']);
        }

        return $validated;
    }

    private function shareSidebarCounts(): void
    {
        View::share('counts', [
            'alumnis' => Schema::hasTable('alumni_profiles') ? DB::table('alumni_profiles')->count() : 0,
            'alumni_boards' => Schema::hasTable('alumni_committees') ? DB::table('alumni_committees')->count() : 0,
            'job_vacancies' => Schema::hasTable('job_vacancies') ? DB::table('job_vacancies')->count() : 0,
            'articles' => Schema::hasTable('articles') ? DB::table('articles')->count() : 0,
            'events' => Schema::hasTable('events') ? DB::table('events')->count() : 0,
            'albums' => Album::count(),
            'galleries' => Schema::hasTable('album_photos') ? DB::table('album_photos')->count() : 0,
            'contents' => Schema::hasTable('page_contents') ? DB::table('page_contents')->count() : 0,
        ]);
    }
}