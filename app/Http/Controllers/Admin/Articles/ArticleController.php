<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        $this->shareSidebarCounts();

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $this->shareSidebarCounts();

        return view('admin.articles.form');
    }

    public function store(Request $request)
    {
        $article = new Article($this->validatedData($request));
        $article->author_id = Auth::id();
        $article->is_published = $request->boolean('is_published');
        $article->published_at = $article->is_published ? now() : null;
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil disimpan.');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $this->shareSidebarCounts();

        return view('admin.articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->shareSidebarCounts();

        return view('admin.articles.form', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $this->validatedData($request, $article->id);

        $article->fill($data);
        $article->is_published = $request->boolean('is_published');
        $article->published_at = $article->is_published
            ? ($article->published_at ?: now())
            : null;
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function validatedData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:50',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename . '.' . $extension);
            $validated['thumbnail'] = 'uploads/' . $filename . '.' . $extension;
        } else {
            unset($validated['thumbnail']);
        }

        return $validated;
    }

    private function shareSidebarCounts(): void
    {
        View::share('counts', [
            'alumnis' => Schema::hasTable('alumni_profiles') ? DB::table('alumni_profiles')->count() : 0,
            'alumni_boards' => Schema::hasTable('alumni_committees') ? DB::table('alumni_committees')->count() : 0,
            'job_vacancies' => Schema::hasTable('job_vacancies') ? DB::table('job_vacancies')->count() : 0,
            'articles' => Article::count(),
            'events' => Schema::hasTable('events') ? DB::table('events')->count() : 0,
            'albums' => Schema::hasTable('albums') ? DB::table('albums')->count() : 0,
            'galleries' => Schema::hasTable('album_photos') ? DB::table('album_photos')->count() : 0,
            'contents' => Schema::hasTable('page_contents') ? DB::table('page_contents')->count() : 0,
        ]);
    }
}