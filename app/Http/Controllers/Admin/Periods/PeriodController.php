<?php

namespace App\Http\Controllers\Admin\Periods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class PeriodController extends Controller
{
    private function shareSidebarCounts()
    {
        $counts = [
            'alumnis' => Schema::hasTable('alumni_profiles') ? DB::table('alumni_profiles')->count() : 0,
            'alumni_boards' => Schema::hasTable('alumni_committees') ? DB::table('alumni_committees')->count() : 0,
            'job_vacancies' => Schema::hasTable('job_vacancies') ? DB::table('job_vacancies')->count() : 0,
            'articles' => Schema::hasTable('articles') ? DB::table('articles')->count() : 0,
            'events' => Schema::hasTable('events') ? DB::table('events')->count() : 0,
            'albums' => Schema::hasTable('albums') ? DB::table('albums')->count() : 0,
            'galleries' => Schema::hasTable('album_photos') ? DB::table('album_photos')->count() : 0,
            'contents' => Schema::hasTable('page_contents') ? DB::table('page_contents')->count() : 0,
        ];
        View::share('counts', $counts);
    }

    public function index()
    {
        $today = now()->toDateString();
        $activePeriod = DB::table('committee_periods')
            ->whereDate('start_date', '<=', $today)
            ->orderByDesc('start_date')
            ->orderByDesc('id')
            ->first();

        $periods = DB::table('committee_periods')
            ->orderByDesc('id')
            ->get()
            ->map(function ($period) use ($activePeriod) {
                $period->is_active = $activePeriod && (int) $period->id === (int) $activePeriod->id;
                return $period;
            });

        $this->shareSidebarCounts();

        return view('admin.periods.index', compact('periods', 'activePeriod'));
    }

    public function create()
    {
        $this->shareSidebarCounts();

        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'period_name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        DB::table('committee_periods')->insert([
            'period_name' => $request->period_name,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.committee-periods.index')
            ->with('success', 'Periode kepengurusan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $period = DB::table('committee_periods')->where('id', $id)->first();

        if (!$period) abort(404);

        $this->shareSidebarCounts();
        return view('admin.periods.detail', compact('period'));
    }

    public function edit($id)
    {
        $period = DB::table('committee_periods')->where('id', $id)->first();

        if (!$period) abort(404);

        $this->shareSidebarCounts();
        return view('admin.periods.edit', compact('period'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'period_name' => 'required|string|max:100',
            'start_date' => 'required|date',
            'finish_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        DB::table('committee_periods')->where('id', $id)->update([
            'period_name' => $request->period_name,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.committee-periods.index')
            ->with('success', 'Periode kepengurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('committee_periods')->where('id', $id)->delete();

        return redirect()->route('admin.committee-periods.index')
            ->with('success', 'Periode kepengurusan berhasil dihapus.');
    }
}
