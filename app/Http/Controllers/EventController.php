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
    public function creator(): BelongsTo {
        
    return $this->belongsTo(User::class, 'created_by');
}


    public function register(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        // Pastikan user sudah login
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Kamu harus login terlebih dahulu.'], 401);
        }

        $user = Auth::user();

        // Daftarkan atau ambil jika sudah terdaftar
        $registration = EventRegistration::firstOrCreate([
            'event_id' => $event->id,
            'user_id' => $user->id,
        ], [
            'ticket_code' => 'TCK-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
            'status' => 'registered',
        ]);
        $adminPusat = \App\Models\User::whereIn('role', ['admin', 'super_admin'])->first();

        $nomorWaPanitia = '6281234567890'; // <-- Nomor Cadangan Tetap (jika admin belum isi nomor HP di web)

        if ($adminPusat && $adminPusat->phone) {
            // Bersihkan nomor dari spasi, strip (-), atau tanda (+) agar tersisa angka saja
            $nomorBersih = preg_replace('/[^0-9]/', '', $adminPusat->phone);
            if (str_starts_with($nomorBersih, '0')) {
                $nomorBersih = '62' . substr($nomorBersih, 1);
            }
            
            $nomorWaPanitia = $nomorBersih;
        }

        // Susun template teks pesan WhatsApp otomatis
        $pesanTeks = "Halo Admin, saya ingin konfirmasi pendaftaran event.\n\n"
                    . "Nama: " . $user->name . "\n"
                    . "Event: " . $event->title . "\n"
                    . "Kode Tiket: " . $registration->ticket_code . "\n\n"
                    . "Mohon untuk segera diverifikasi. Terima kasih!";

        $whatsappUrl = "https://wa.me" . $nomorWaPanitia . "?text=" . urlencode($pesanTeks);

        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mendaftar.'], 500);
    }

}

