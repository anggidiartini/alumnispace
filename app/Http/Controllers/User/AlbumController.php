<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $query = Album::where('status', 1)->with('photos');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $albums = $query->orderBy('event_date', 'desc')->get();
        $totalAlbums = Album::where('status', 1)->count();

        return view('user.album.index', compact('albums', 'totalAlbums'));
    }

    public function show($slug)
    {
        $album = Album::where('status', 1)->with('photos')->where('slug', $slug)->firstOrFail();
        return view('user.album.detail', compact('album'));
    }
}