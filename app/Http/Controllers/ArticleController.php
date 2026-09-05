<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $articles = $query->latest()->paginate(9);

        return view('artikel.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('artikel.detail', compact('article'));
    }
}
