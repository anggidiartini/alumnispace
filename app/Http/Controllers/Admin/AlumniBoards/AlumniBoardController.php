<?php

namespace App\Http\Controllers\Admin\AlumniBoards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AlumniBoardController extends Controller
{
    public function index()
    {
        $boards = $this->boardQuery()->get();
        $this->shareSidebarCounts();

        return view('admin.alumni-boards.index', compact('boards'));
    }

    public function create()
    {
        $this->shareSidebarCounts();
        $alumni = $this->alumniOptions();
        $periods = DB::table('committee_periods')->orderByDesc('id')->get();

        return view('admin.alumni-boards.form', compact('alumni', 'periods'));
    }

    public function store(Request $request)
    {
        DB::table('alumni_committees')->insert($this->validatedData($request));

        return redirect()->route('admin.alumni-boards.index')->with('success', 'Data pengurus alumni berhasil disimpan.');
    }

    public function show($id)
    {
        $board = $this->boardQuery()->where('alumni_committees.id', $id)->firstOrFail();
        $this->shareSidebarCounts();

        return view('admin.alumni-boards.show', compact('board'));
    }

    public function edit($id)
    {
        $board = DB::table('alumni_committees')->where('id', $id)->firstOrFail();
        $this->shareSidebarCounts();
        $alumni = $this->alumniOptions();
        $periods = DB::table('committee_periods')->orderByDesc('id')->get();

        return view('admin.alumni-boards.form', compact('board', 'alumni', 'periods'));
    }

    public function update(Request $request, $id)
    {
        DB::table('alumni_committees')->where('id', $id)->update($this->validatedData($request));

        return redirect()->route('admin.alumni-boards.index')->with('success', 'Data pengurus alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('alumni_committees')->where('id', $id)->delete();

        return redirect()->route('admin.alumni-boards.index')->with('success', 'Data pengurus alumni berhasil dihapus.');
    }

    private function boardQuery()
    {
        return DB::table('alumni_committees')
            ->join('alumni_profiles', 'alumni_committees.alumni_profile_id', '=', 'alumni_profiles.id')
            ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
            ->join('committee_periods', 'alumni_committees.committee_period_id', '=', 'committee_periods.id')
            ->select('alumni_committees.*', 'users.name as alumni_name', 'committee_periods.period_name', 'committee_periods.start_date', 'committee_periods.finish_date')
            ->orderByDesc('alumni_committees.id');
    }

    private function alumniOptions()
    {
        return DB::table('alumni_profiles')->join('users', 'alumni_profiles.user_id', '=', 'users.id')->select('alumni_profiles.id', 'users.name')->orderBy('users.name')->get();
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'alumni_profile_id' => 'required|exists:alumni_profiles,id',
            'position' => 'required|string|max:100',
            'committee_period_id' => 'required|exists:committee_periods,id',
        ]);
    }

    private function shareSidebarCounts(): void
    {
        View::share('counts', [
            'alumnis' => Schema::hasTable('alumni_profiles') ? DB::table('alumni_profiles')->count() : 0,
            'alumni_boards' => Schema::hasTable('alumni_committees') ? DB::table('alumni_committees')->count() : 0,
            'job_vacancies' => Schema::hasTable('job_vacancies') ? DB::table('job_vacancies')->count() : 0,
            'articles' => Schema::hasTable('articles') ? DB::table('articles')->count() : 0,
            'events' => Schema::hasTable('events') ? DB::table('events')->count() : 0,
            'albums' => Schema::hasTable('albums') ? DB::table('albums')->count() : 0,
            'galleries' => Schema::hasTable('album_photos') ? DB::table('album_photos')->count() : 0,
            'contents' => Schema::hasTable('page_contents') ? DB::table('page_contents')->count() : 0,
        ]);
    }
}