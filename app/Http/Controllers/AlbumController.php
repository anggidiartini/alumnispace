<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $query = Album::with('photos');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $albums = $query->orderBy('event_date', 'desc')->get();
        $totalAlbums = Album::count();

        return view('album.index', compact('albums', 'totalAlbums'));
    }

    public function show($slug)
    {
        $album = Album::with('photos')->where('slug', $slug)->firstOrFail();
        return view('album.detail', compact('album'));
    }
}
