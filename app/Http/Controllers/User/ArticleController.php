<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        // Hanya artikel yang sudah diterbitkan yang boleh tampil.
        $query = Article::where('is_published', 1);

        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        $articles = $query->latest()->paginate(9);

        $categories = Article::where('is_published', 1)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $heroArticle = Article::where('is_published', 1)
            ->latest()
            ->first();

        return view('user.artikel.index', compact(
            'articles',
            'categories',
            'heroArticle'
        ));
    }

    public function show($slug)
    {
        // Artikel draf tidak bisa dibuka melalui URL detail.
        $article = Article::where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        // Artikel terkait hanya yang sudah diterbitkan.
        $relatedArticles = Article::where('is_published', 1)
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        // Artikel terbaru hanya yang sudah diterbitkan.
        $latestArticles = Article::where('is_published', 1)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('user.artikel.detail', compact(
            'article',
            'relatedArticles',
            'latestArticles'
        ));
    }
}
