<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Memetakan parameter URL ke model kategori.
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
     * Membuat slug unik berdasarkan nama kategori.
     */
    private function generateUniqueSlug($model, string $name, $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);

        if ($baseSlug === '') {
            $baseSlug = 'kategori';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            $model::where('slug', $slug)
                ->when($ignoreId !== null, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Tampilkan daftar kategori.
     */
    public function index($type)
    {
        $categoryData = $this->getCategoryModel($type);

        $categories = $categoryData['model']::latest()->get();
        $title = $categoryData['title'];

        return view('admin.categories.index', compact('categories', 'title', 'type'));
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request, $type)
    {
        $categoryData = $this->getCategoryModel($type);
        $model = $categoryData['model'];

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $model::create([
            'name'        => $request->name,
            'slug'        => $this->generateUniqueSlug($model, $request->name),
            'description' => $request->description,
            'status'      => $request->status === 'active' ? 1 : 0,
        ]);

        return redirect()->back()->with(
            'success',
            $categoryData['title'] . ' berhasil ditambahkan!'
        );
    }

    /**
     * Perbarui kategori.
     */
    public function update(Request $request, $type, $id)
    {
        $categoryData = $this->getCategoryModel($type);
        $model = $categoryData['model'];
        $category = $model::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:active,inactive',
        ]);

        $oldName = $category->name;
        $newName = $request->name;

        // Jika nama kategori lowongan berubah, sesuaikan juga
        // kategori lowongan yang masih menyimpan nama lama.
        if ($type === 'job_vacancies' && $oldName !== $newName) {
            \Illuminate\Support\Facades\DB::table('job_vacancies')
                ->where('category', $oldName)
                ->update(['category' => $newName]);
        }

        // Jika nama kategori album berubah, sesuaikan juga
        // album yang masih menyimpan nama lama.
        if ($type === 'albums' && $oldName !== $newName) {
            \Illuminate\Support\Facades\DB::table('albums')
                ->where('category', $oldName)
                ->update(['category' => $newName]);
        }

        $category->update([
            'name'        => $newName,
            'slug'        => $this->generateUniqueSlug($model, $newName, $category->id),
            'description' => $request->description,
            'status'      => $request->status === 'active' ? 1 : 0,
        ]);

        return redirect()->back()->with(
            'success',
            $categoryData['title'] . ' berhasil diperbarui!'
        );
    }
}
