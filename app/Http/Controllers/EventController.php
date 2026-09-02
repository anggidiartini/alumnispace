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

        $events = $query->orderBy('event_date', 'desc')->get();
        $totalEvents = Event::count();

        return view('event.index', compact('events', 'totalEvents'));
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('event.detail', compact('event'));
    }

    public function register(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $user = Auth::user();

        if ($user) {
            EventRegistration::firstOrCreate([
                'event_id' => $event->id,
                'user_id' => $user->id,
            ], [
                'ticket_code' => 'TCK-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                'status' => 'registered',
            ]);
        }

        return back()->with('success', 'Pendaftaran event berhasil dikonfirmasi!');
    }
}
