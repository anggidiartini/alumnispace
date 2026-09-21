<?php

namespace App\Http\Controllers\Admin\Albums;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

use App\Models\AlbumPhoto;
use App\Services\ImageOptimizerService;
use Illuminate\Support\Facades\Auth;

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
        $data = $this->validatedData($request);
        $album = Album::create($data);

        // Simpan foto-foto isi album jika ada yang diunggah
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photoFile) {
                if ($photoFile && $photoFile->isValid()) {
                    $photoPath = ImageOptimizerService::optimizePhoto($photoFile, 'albums/photos');
                    $album->photos()->create([
                        'uploaded_by' => Auth::id(),
                        'photo_path' => $photoPath,
                        'caption' => $album->title,
                    ]);
                }
            }
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album dan foto dokumentasi berhasil disimpan.');
    }

    public function show($id)
    {
        $album = Album::withCount('photos')->with('photos')->findOrFail($id);
        $this->shareSidebarCounts();

        return view('admin.albums.show', compact('album'));
    }

    public function edit($id)
    {
        $album = Album::with('photos')->findOrFail($id);
        $this->shareSidebarCounts();

        return view('admin.albums.form', compact('album'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        $data = $this->validatedData($request, $album);
        $album->update($data);

        // Hapus foto yang ditandai untuk dihapus pada saat edit
        if ($request->filled('delete_photos') && is_array($request->delete_photos)) {
            $photosToDelete = AlbumPhoto::where('album_id', $album->id)
                ->whereIn('id', $request->delete_photos)
                ->get();

            foreach ($photosToDelete as $p) {
                ImageOptimizerService::deleteFile($p->photo_path);
                $p->delete();
            }
        }

        // Tambah foto dokumentasi baru jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photoFile) {
                if ($photoFile && $photoFile->isValid()) {
                    $photoPath = ImageOptimizerService::optimizePhoto($photoFile, 'albums/photos');
                    $album->photos()->create([
                        'uploaded_by' => Auth::id(),
                        'photo_path' => $photoPath,
                        'caption' => $album->title,
                    ]);
                }
            }
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $album = Album::with('photos')->findOrFail($id);

        // Hapus berkas cover dari disk
        ImageOptimizerService::deleteFile($album->cover_photo);

        // Hapus berkas foto-foto galeri dari disk
        foreach ($album->photos as $photo) {
            ImageOptimizerService::deleteFile($photo->photo_path);
        }
        $album->photos()->delete();
        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album dan seluruh foto terkait berhasil dihapus.');
    }

    private function validatedData(Request $request, ?Album $currentAlbum = null): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|string|max:50',
            'subtitle_label' => 'nullable|string|max:100',
            'sticker_tag' => 'nullable|string|max:50',
            'cover_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:15360',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|file|mimes:jpeg,png,jpg,webp,heic,heif|max:15360',
            'delete_photos' => 'nullable|array',
            'delete_photos.*' => 'integer',
            'event_date' => 'nullable|date',
            'date_display' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:150',
            'target_generation' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->boolean('status');

        if ($request->hasFile('cover_photo')) {
            // Hapus cover lama jika ada cover pengganti
            if ($currentAlbum && $currentAlbum->cover_photo) {
                ImageOptimizerService::deleteFile($currentAlbum->cover_photo);
            }

            // Kompres dan konversi otomatis menjadi .webp (maks ~50 KB)
            $coverPath = ImageOptimizerService::optimizeThumbnail($request->file('cover_photo'), 'albums/covers');
            $validated['cover_photo'] = $coverPath;
        } else {
            unset($validated['cover_photo']);
        }

        unset($validated['photos'], $validated['delete_photos']);

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