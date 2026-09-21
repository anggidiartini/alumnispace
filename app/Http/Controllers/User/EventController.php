<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::whereIn('status', ['upcoming', 'completed']);

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
        
        $totalEvents = Event::whereIn('status', ['upcoming', 'completed'])->count();

        return view('user.event.index', compact('events', 'totalEvents'));
    }

    public function show($slug)
    {
        $event = Event::whereIn('status', ['upcoming', 'completed'])
            ->where('slug', $slug)
            ->first();

        if (!$event && is_numeric($slug)) {
            $event = Event::whereIn('status', ['upcoming', 'completed'])->find($slug);
        }

        if (!$event) {
            abort(404);
        }
        
        return view('user.event.detail', compact('event'));
    }

    public function register(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Kamu harus login terlebih dahulu.'], 401);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'quantity' => 'nullable|integer|min:1|max:50',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'quantity.min' => 'Jumlah kuota minimal 1.',
        ]);

        $quantity = (int) ($validated['quantity'] ?? 1);
        $user = Auth::user();

        try {
            $registration = DB::transaction(function () use ($id, $user, $validated, $quantity) {
                $lockedEvent = Event::where('id', $id)->lockForUpdate()->firstOrFail();

                $statusLower = strtolower($lockedEvent->status);
                if ($statusLower !== 'upcoming') {
                    throw new \Exception('Pendaftaran ditutup karena event ini sudah selesai.');
                }

                $usedQuota = (int) $lockedEvent->registrations()
                    ->where('status', '!=', 'cancelled')
                    ->sum('quantity');

                $totalQuota = (int) ($lockedEvent->quota ?? 0);
                if ($totalQuota > 0) {
                    $remaining = max(0, $totalQuota - $usedQuota);
                    if ($remaining <= 0) {
                        throw new \Exception('Maaf, kuota untuk event ini sudah habis.');
                    }
                    if ($quantity > $remaining) {
                        throw new \Exception("Maaf, kuota tidak mencukupi. Sisa kuota hanya {$remaining} kursi.");
                    }
                }

                return EventRegistration::create([
                    'event_id' => $lockedEvent->id,
                    'user_id' => $user->id,
                    'quantity' => $quantity,
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'ticket_code' => 'TCK-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                    'status' => 'registered',
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }

        $event = Event::findOrFail($id);

        $adminPusat = \App\Models\User::whereIn('role', ['admin', 'super_admin'])->first();
        $nomorWaPanitia = '6281234567890'; 

        if ($adminPusat && !empty($adminPusat->phone)) {
            $nomorBersih = preg_replace('/[^0-9]/', '', $adminPusat->phone);
            
            if (str_starts_with($nomorBersih, '0')) {
                $nomorBersih = '62' . substr($nomorBersih, 1);
            }
            
            $nomorWaPanitia = $nomorBersih;
        }

        $pesanTeks = "Halo Panitia, saya telah mendaftar di Event ini dan ingin konfirmasi pendaftaran.\n\n"
                   . "📄 *DATA PENDAFTARAN*\n"
                   . "• Nama: " . $registration->name . "\n"
                   . "• Event: " . $event->title . "\n"
                   . "• Jumlah Kuota Diambil: " . $registration->quantity . " kursi\n"
                   . "• Kode Tiket: " . $registration->ticket_code . "\n\n"
                   . "Mohon kesediaannya untuk memverifikasi data saya dan *memasukkan saya ke grup WhatsApp resmi event* ini. Terima kasih! 🙏";
                   
        $whatsappUrl = "https://wa.me/" . $nomorWaPanitia . "?text=" . urlencode($pesanTeks);

        $refreshed = $event->fresh();

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil! Mengalihkan ke WhatsApp panitia untuk konfirmasi masuk grup...',
            'ticket_code' => $registration->ticket_code,
            'quantity' => $registration->quantity,
            'registered_count' => $refreshed->registered_count,
            'used_quota' => $refreshed->used_quota,
            'remaining_quota' => $refreshed->remaining_quota,
            'total_quota' => $refreshed->quota,
            'whatsapp_url' => $whatsappUrl
        ]);
    }

}

