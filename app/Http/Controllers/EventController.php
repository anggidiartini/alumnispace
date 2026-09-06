<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('venue', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $events = $query->orderBy('event_date', 'desc')->get()->map(function($event) {
            $event->status = ucfirst(strtolower($event->status));
            return $event;
        });
        
        $totalEvents = Event::count();

        return view('event.index', compact('events', 'totalEvents'));
    }

            public function show($slug)
    {
        $event = Event::where('slug', $slug)->first();

        if (!$event && is_numeric($slug)) {
            $event = Event::find($slug);
        }

        if (!$event) {
            $event = Event::firstOrFail();
        }
        
        return view('event.detail', compact('event'));
    }


        public function register(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        // Pastikan user sudah login
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Kamu harus login terlebih dahulu.'], 401);
        }

        $user = \Illuminate\Support\Facades\Auth::user();

        // Daftarkan jika belum terdaftar
        EventRegistration::firstOrCreate([
            'event_id' => $event->id,
            'user_id' => $user->id,
        ], [
            'ticket_code' => 'TCK-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5)),
            'status' => 'registered',
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran event berhasil dikonfirmasi!',
            'registered_count' => $event->fresh()->registered_count
        ]);
    

        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mendaftar.'], 500);
    }

}