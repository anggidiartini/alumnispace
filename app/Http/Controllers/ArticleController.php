<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        // Kolom di tabel bernama 'category', bukan 'kategori'.
        // Nama parameter query string (?kategori=...) tetap boleh 'kategori',
        // yang penting kolom yang di-where() harus 'category'.
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('category', $request->kategori);
        }

        $articles = $query->latest()->paginate(9);

        return view('artikel.index', compact('articles'));
    }

    public function show($slug)
    {
        // Disamakan dengan pola AlbumController@show: pakai $slug manual +
        // firstOrFail(), bukan route-model-binding, supaya cocok dengan
        // parameter {slug} yang dipakai di routes/web.php.
        $article = Article::where('slug', $slug)->firstOrFail();

        // Artikel Terkait: kategori sama, exclude artikel yang lagi dibuka.
        $relatedArticles = Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        // Artikel Terbaru: terbaru secara umum, exclude artikel yang lagi dibuka.
        $latestArticles = Article::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('artikel.detail', compact('article', 'relatedArticles', 'latestArticles'));
    }
}