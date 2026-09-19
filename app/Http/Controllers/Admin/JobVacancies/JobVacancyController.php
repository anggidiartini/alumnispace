<?php

namespace App\Http\Controllers\Admin\JobVacancies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobVacanciesExport;
use App\Exports\JobApplicationsExport;
use App\Models\JobVacancy;

class JobVacancyController extends Controller
{
    private function getMapping()
    {
        return [
            'title' => 'Lowongan Kerja',
            'table' => 'job_vacancies',
            'list_columns' => ['company_logo', 'company_name', 'title', 'job_type', 'is_active'],
            'fields' => [
                'company_name' => ['label' => 'Nama Perusahaan', 'type' => 'text', 'required' => true],
                'company_logo' => ['label' => 'Logo Perusahaan', 'type' => 'file', 'required' => false, 'hint' => 'Maks berkas: 300KB (Disarankan rasio kotak 1:1)'],
                'title' => ['label' => 'Posisi Lowongan', 'type' => 'text', 'required' => true],
                'job_type' => [
                    'label' => 'Sifat Pekerjaan',
                    'type' => 'select',
                    'required' => true,
                    'options' => [
                        'Full-Time' => 'Full-Time',
                        'Part-Time' => 'Part-Time',
                        'Freelance' => 'Freelance',
                        'Remote' => 'Remote',
                        'Magang' => 'Magang',
                        'Kontrak' => 'Kontrak',
                    ]
                ],
                'workplace_type' => ['label' => 'Sistem Kerja', 'type' => 'text', 'required' => true],
                'location' => ['label' => 'Lokasi Penempatan', 'type' => 'text', 'required' => true],
                'salary_display' => ['label' => 'Informasi Gaji', 'type' => 'text', 'required' => true],
                'description' => ['label' => 'Deskripsi Pekerjaan', 'type' => 'textarea', 'required' => true],
                'requirements' => ['label' => 'Syarat Kualifikasi', 'type' => 'textarea', 'required' => true],
                'is_active' => ['label' => 'Status', 'type' => 'toggle', 'required' => true, 'options' => [1 => 'Buka', 0 => 'Tutup']],
            ]
        ];
    }

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
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';
        
        $rows = DB::table($mapping['table'])->get();

        $this->shareSidebarCounts();
        return view('admin.job-vacancies.index', compact('rows', 'mapping', 'table_key'));
    }

    public function show($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';

        $row = DB::table($mapping['table'])->where('id', $id)->first();

        if (!$row) abort(404);

        $this->shareSidebarCounts();
        return view('admin.job-vacancies.show', compact('row', 'mapping', 'table_key'));
    }

    public function create()
    {
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';
        
        $this->shareSidebarCounts();
        return view('admin.job-vacancies.form', compact('mapping', 'table_key'));
    }

    public function store(Request $request)
    {
        $mapping = $this->getMapping();
        $tableName = $mapping['table'];

        $rules = [];
        if ($request->hasFile('company_logo')) {
            $rules['company_logo'] = 'image|mimes:jpeg,png,jpg|max:300';
        }

        if (!empty($rules)) {
            $request->validate($rules);
        }

        $insertData = [];
        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($config['type'] === 'file' && $request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $insertData[$fieldName] = 'uploads/' . $filename;
            } elseif ($request->has($fieldName)) {
                $insertData[$fieldName] = $request->input($fieldName);
            }
        }

        if (Schema::hasColumn($tableName, 'slug') && $request->filled('title')) {
            $insertData['slug'] = Str::slug($request->title) . '-' . rand(100, 999);
        }

        $allFields = Schema::getColumnListing($tableName);
        if (in_array('user_id', $allFields)) {
            $insertData['user_id'] = Auth::id();
        }
        if (in_array('posted_by', $allFields)) {
            $insertData['posted_by'] = Auth::id();
        }

        DB::table($tableName)->insert($insertData);

        return redirect()->route('admin.job-vacancies.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';

        $row = DB::table($mapping['table'])->where('id', $id)->first();

        if (!$row) abort(404);

        $this->shareSidebarCounts();
        return view('admin.job-vacancies.form', compact('row', 'mapping', 'table_key'));
    }

    public function update(Request $request, $id)
    {
        $mapping = $this->getMapping();

        $rules = [];
        if ($request->hasFile('company_logo')) {
            $rules['company_logo'] = 'image|mimes:jpeg,png,jpg|max:300';
        }

        if (!empty($rules)) {
            $request->validate($rules);
        }

        $updateData = [];
        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($config['type'] === 'file' && $request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $updateData[$fieldName] = 'uploads/' . $filename;
            } elseif ($request->has($fieldName)) {
                $updateData[$fieldName] = $request->input($fieldName);
            }
        }

        DB::table($mapping['table'])->where('id', $id)->update($updateData);

        return redirect()->route('admin.job-vacancies.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapping = $this->getMapping();
        DB::table($mapping['table'])->where('id', $id)->delete();

        return redirect()->route('admin.job-vacancies.index')->with('success', 'Data berhasil dihapus.');
    }

    public function updateJobType(Request $request, $id)
    {
        $validated = $request->validate([
            'job_type' => 'required|string|in:Full-Time,Part-Time,Freelance,Remote,Magang,Kontrak'
        ]);

        $job = DB::table('job_vacancies')->where('id', $id)->first();
        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Lowongan tidak ditemukan.'], 404);
        }

        DB::table('job_vacancies')->where('id', $id)->update([
            'job_type' => $validated['job_type'],
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sifat pekerjaan berhasil diperbarui menjadi ' . $validated['job_type'] . '.',
            'job_type' => $validated['job_type']
        ]);
    }

    public function export()
    {
        return Excel::download(new JobVacanciesExport, 'Rekap_Lowongan_Kerja_' . date('Ymd_His') . '.xlsx');
    }

    public function exportApplications($id)
    {
        $job = JobVacancy::findOrFail($id);
        $filename = 'Pelamar_' . Str::slug($job->title) . '_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new JobApplicationsExport($id), $filename);
    }
}
