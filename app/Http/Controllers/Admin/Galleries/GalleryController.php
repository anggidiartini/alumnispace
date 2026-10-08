<?php

namespace App\Http\Controllers\Admin\Galleries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Services\ImageOptimizerService;

class GalleryController extends Controller
{
    private function getMapping()
    {
        return [
            'title' => 'Galeri Foto',
            'table' => 'album_photos',
            'list_columns' => ['caption', 'photo_path'],
            'fields' => [
                'caption' => ['label' => 'Keterangan Gambar', 'type' => 'text', 'required' => true],
                'photo_path' => ['label' => 'Foto Kenangan', 'type' => 'file', 'required' => false, 'hint' => 'Format: JPG, PNG, WEBP, HEIC (Maks output ~500KB)'],
            ]
        ];
    }

    private function shareSidebarCounts()
    {
        $counts = [
            'alumnis' => Schema::hasTable('alumni_profiles') ? DB::table('alumni_profiles')->count() : 0,
            'alumni_boards' => Schema::hasTable('alumni_committees') ? DB::table('alumni_committees')->count() : 0,
            'job_vacancies' => Schema::hasTable('job_vacancies') ? DB::table('job_vacancies')->count() : 0,
            'articles' => Schema::hasTable('articles') ? DB::table('articles')->count() : 0,
            'events' => Schema::hasTable('events') ? DB::table('events')->count() : 0,
            'albums' => Schema::hasTable('albums') ? DB::table('albums')->count() : 0,
            'galleries' => Schema::hasTable('album_photos') ? DB::table('album_photos')->count() : 0,
            'contents' => Schema::hasTable('page_contents') ? DB::table('page_contents')->count() : 0,
        ];
        View::share('counts', $counts);
    }

    public function index()
    {
        $mapping = $this->getMapping();
        $table_key = 'galleries';
        
        $rows = DB::table($mapping['table'])->get();

        $this->shareSidebarCounts();
        return view('admin.galleries.index', compact('rows', 'mapping', 'table_key'));
    }

    public function show($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'galleries';

        $row = DB::table($mapping['table'])->where('id', $id)->first();

        if (!$row) abort(404);

        $this->shareSidebarCounts();
        return view('admin.galleries.show', compact('row', 'mapping', 'table_key'));
    }

    public function create()
    {
        $mapping = $this->getMapping();
        $table_key = 'galleries';
        
        $this->shareSidebarCounts();
        return view('admin.galleries.form', compact('mapping', 'table_key'));
    }

    public function store(Request $request)
    {
        $mapping = $this->getMapping();
        $tableName = $mapping['table'];

        $rules = [];
        if ($request->hasFile('photo_path')) {
            $rules['photo_path'] = 'file|mimes:jpeg,png,jpg,webp,heic,heif|max:15360';
        }

        if (!empty($rules)) {
            $request->validate($rules);
        }

        $insertData = [];
        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($config['type'] === 'file' && $request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $insertData[$fieldName] = ImageOptimizerService::optimizePhoto($file, 'albums/photos');
            } elseif ($request->has($fieldName)) {
                $insertData[$fieldName] = $request->input($fieldName);
            }
        }

        $allFields = Schema::getColumnListing($tableName);
        if (in_array('user_id', $allFields)) {
            $insertData['user_id'] = Auth::id();
        }
        if (in_array('uploaded_by', $allFields)) {
            $insertData['uploaded_by'] = Auth::id();
        }
        if (in_array('posted_by', $allFields)) {
            $insertData['posted_by'] = Auth::id();
        }

        DB::table($tableName)->insert($insertData);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil disimpan dan dioptimasi.');
    }

    public function edit($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'galleries';

        $row = DB::table($mapping['table'])->where('id', $id)->first();

        if (!$row) abort(404);

        $this->shareSidebarCounts();
        return view('admin.galleries.form', compact('row', 'mapping', 'table_key'));
    }

    public function update(Request $request, $id)
    {
        $mapping = $this->getMapping();

        $rules = [];
        if ($request->hasFile('photo_path')) {
            $rules['photo_path'] = 'file|mimes:jpeg,png,jpg,webp,heic,heif|max:15360';
        }

        if (!empty($rules)) {
            $request->validate($rules);
        }

        $currentRow = DB::table($mapping['table'])->where('id', $id)->first();

        $updateData = [];
        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($config['type'] === 'file' && $request->hasFile($fieldName)) {
                if ($currentRow && !empty($currentRow->$fieldName)) {
                    ImageOptimizerService::deleteFile($currentRow->$fieldName);
                }
                $file = $request->file($fieldName);
                $updateData[$fieldName] = ImageOptimizerService::optimizePhoto($file, 'albums/photos');
            } elseif ($request->has($fieldName)) {
                $updateData[$fieldName] = $request->input($fieldName);
            }
        }

        DB::table($mapping['table'])->where('id', $id)->update($updateData);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diperbarui dan dioptimasi.');
    }

    public function destroy($id)
    {
        $mapping = $this->getMapping();
        $row = DB::table($mapping['table'])->where('id', $id)->first();
        if ($row && !empty($row->photo_path)) {
            ImageOptimizerService::deleteFile($row->photo_path);
        }

        DB::table($mapping['table'])->where('id', $id)->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil dihapus.');
    }
}
