<?php

namespace App\Http\Controllers\Admin\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventsExport;
use App\Exports\EventRegistrationsExport;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest('event_date')->get();
        $this->shareSidebarCounts();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $this->shareSidebarCounts();

        return view('admin.events.form');
    }

    public function store(Request $request)
    {
        $event = new Event($this->validatedData($request));
        $event->created_by = Auth::id();
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Acara berhasil disimpan.');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $registrations = \App\Models\EventRegistration::with('user')
            ->where('event_id', $id)
            ->latest()
            ->get();
        $totalQuota = (int) ($event->quota ?? 0);
        $usedQuota = $event->used_quota;
        $remainingQuota = $event->remaining_quota;
        $percentFilled = $totalQuota > 0 ? min(100, round(($usedQuota / $totalQuota) * 100)) : 0;

        $this->shareSidebarCounts();

        return view('admin.events.show', compact('event', 'registrations', 'totalQuota', 'usedQuota', 'remainingQuota', 'percentFilled'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $currSold = (int) DB::table('event_registrations')
            ->where('event_id', $id)
            ->where('status', '!=', 'cancelled')
            ->sum('quantity');

        $this->shareSidebarCounts();

        return view('admin.events.form', compact('event', 'currSold'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if ($request->has('quota')) {
            $newQuota = (int) $request->input('quota');
            $usedQuota = (int) DB::table('event_registrations')
                ->where('event_id', $id)
                ->where('status', '!=', 'cancelled')
                ->sum('quantity');

            if ($newQuota < $usedQuota) {
                return back()->withInput()->with('error', "Nilai Kuota Peserta tidak bisa diubah menjadi {$newQuota} kursi karena sudah ada {$usedQuota} tiket/kuota yang telah terjual.");
            }
        }

        $event->fill($this->validatedData($request));
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Acara berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect()->route('admin.events.index')->with('success', 'Acara berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'badge_tag' => 'nullable|string|max:100',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg|max:500',
            'event_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after_or_equal:start_time',
            'time_display' => 'nullable|string|max:100',
            'location_type' => 'required|in:online,offline,hybrid',
            'venue' => 'nullable|string|max:255',
            'description' => 'required|string',
            'registration_link' => 'nullable|url|max:255',
            'quota' => 'nullable|integer|min:1',
            'status' => 'required|in:upcoming,completed',
        ]);

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename . '.' . $extension);
            $validated['banner_image'] = 'uploads/' . $filename . '.' . $extension;
        } else {
            unset($validated['banner_image']);
        }

        return $validated;
    }

    private function shareSidebarCounts(): void
    {
        View::share('counts', [
            'alumnis' => Schema::hasTable('alumni_profiles') ? DB::table('alumni_profiles')->count() : 0,
            'alumni_boards' => Schema::hasTable('alumni_committees') ? DB::table('alumni_committees')->count() : 0,
            'job_vacancies' => Schema::hasTable('job_vacancies') ? DB::table('job_vacancies')->count() : 0,
            'articles' => Schema::hasTable('articles') ? DB::table('articles')->count() : 0,
            'events' => Event::count(),
            'albums' => Schema::hasTable('albums') ? DB::table('albums')->count() : 0,
            'galleries' => Schema::hasTable('album_photos') ? DB::table('album_photos')->count() : 0,
            'contents' => Schema::hasTable('page_contents') ? DB::table('page_contents')->count() : 0,
        ]);
    }

    public function export()
    {
        return Excel::download(new EventsExport, 'Rekap_Acara_' . date('Ymd_His') . '.xlsx');
    }

    public function exportRegistrations($id)
    {
        $event = Event::findOrFail($id);
        $filename = 'Pendaftar_' . Str::slug($event->title) . '_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new EventRegistrationsExport($id), $filename);
    }
}