<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Memetakan parameter URL {type} ke Model dan Nama Halaman yang sesuai.
     */
    private function getCategoryModel($type)
    {
        return match ($type) {
            'articles'      => ['model' => \App\Models\ArticleCategory::class, 'title' => 'Kategori Artikel'],
            'albums'        => ['model' => \App\Models\AlbumCategory::class, 'title' => 'Kategori Album'],
            'companies'     => ['model' => \App\Models\CompanyCategory::class, 'title' => 'Kategori Perusahaan'],
            'events'        => ['model' => \App\Models\EventCategory::class, 'title' => 'Kategori Event'],
            'job_vacancies' => ['model' => \App\Models\JobCategory::class, 'title' => 'Kategori Lowongan Kerja'],
            default         => abort(404),
        };
    }

    /**
     * Tampilkan Halaman Daftar Kategori (Untuk DataTables)
     */
    public function index($type)
    {
        $categoryData = $this->getCategoryModel($type);
        
        $categories = $categoryData['model']::latest()->get();
        $title = $categoryData['title'];

        return view('admin.categories.index', compact('categories', 'title', 'type'));
    }

    /**
     * Simpan Data Kategori Baru
     */
    public function store(Request $request, $type)
    {
        $categoryData = $this->getCategoryModel($type);
        
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $categoryData['model']::create([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status === 'active' ? 1 : 0,
        ]);

        return redirect()->back()->with('success', $categoryData['title'] . ' berhasil ditambahkan!');
    }

    /**
     * Update Data Kategori
     */
    public function update(Request $request, $type, $id)
    {
        $categoryData = $this->getCategoryModel($type);
        $category = $categoryData['model']::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $category->update([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status === 'active' ? 1 : 0,
        ]);

        return redirect()->back()->with('success', $categoryData['title'] . ' berhasil diperbarui!');
    }
}
