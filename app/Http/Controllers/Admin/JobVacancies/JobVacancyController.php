<?php

namespace App\Http\Controllers\Admin\JobVacancies;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use App\Services\ImageOptimizerService;
use App\Exports\JobVacanciesExport;
use App\Exports\JobApplicationsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class JobVacancyController extends Controller
{
    private function getMapping()
    {
        return [
            'title' => 'Lowongan Kerja',
            'table' => 'job_vacancies',

            'list_columns' => [
                'company_logo',
                'company_name',
                'title',
                'job_type',
                'workplace_type',
                'location',
                'salary_display',
                'is_active',
            ],

            'fields' => [
                'company_name' => [
                    'label' => 'Nama Perusahaan',
                    'type' => 'text',
                    'required' => true,
                ],

                'company_logo' => [
                    'label' => 'Logo Perusahaan',
                    'type' => 'file',
                    'required' => false,
                    'hint' => 'Maks berkas: 300KB. Disarankan rasio kotak 1:1.',
                ],

                'title' => [
                    'label' => 'Posisi Lowongan',
                    'type' => 'text',
                    'required' => true,
                ],

                'category' => [
                    'label' => 'Kategori Pekerjaan',
                    'type' => 'text',
                    'required' => false,
                ],

                'skills_tags' => [
                    'label' => 'Skill yang Dibutuhkan',
                    'type' => 'textarea',
                    'required' => false,
                ],

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
                    ],
                ],

                'workplace_type' => [
                    'label' => 'Sistem Kerja',
                    'type' => 'text',
                    'required' => true,
                ],

                'location' => [
                    'label' => 'Lokasi Penempatan',
                    'type' => 'text',
                    'required' => true,
                ],

                'salary_display' => [
                    'label' => 'Informasi Gaji',
                    'type' => 'text',
                    'required' => true,
                ],

                'description' => [
                    'label' => 'Deskripsi Pekerjaan',
                    'type' => 'textarea',
                    'required' => true,
                ],

                'requirements' => [
                    'label' => 'Syarat Kualifikasi',
                    'type' => 'textarea',
                    'required' => true,
                ],

                'is_active' => [
                    'label' => 'Status',
                    'type' => 'toggle',
                    'required' => true,
                    'options' => [
                        1 => 'Buka',
                        0 => 'Tutup',
                    ],
                ],
            ],
        ];
    }

    private function shareSidebarCounts()
    {
        $tables = [
            'alumnis' => 'alumni_profiles',
            'alumni_boards' => 'alumni_committees',
            'job_vacancies' => 'job_vacancies',
            'articles' => 'articles',
            'events' => 'events',
            'albums' => 'albums',
            'galleries' => 'album_photos',
            'contents' => 'page_contents',
        ];

        $counts = [];

        foreach ($tables as $key => $table) {
            $counts[$key] = Schema::hasTable($table)
                ? DB::table($table)->count()
                : 0;
        }

        View::share('counts', $counts);
    }

    private function validateJob(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'company_name' => 'required|string|max:255',

            'company_logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'skills_tags' => 'nullable',
            'job_type' => 'required|string|in:Full-Time,Part-Time,Freelance,Remote,Magang,Kontrak',
            'workplace_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_display' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'is_active' => 'required|in:0,1',
        ]);
    }

    private function normalizeSkills($rawSkills): string
    {
        if (is_array($rawSkills)) {
            $skills = $rawSkills;
        } else {
            $skills = preg_split(
                '/[\r\n,]+/',
                (string) $rawSkills
            );
        }

        $skills = array_values(array_filter(
            array_map(
                fn ($skill) => trim((string) $skill),
                $skills
            ),
            fn ($skill) => $skill !== ''
        ));

        return json_encode($skills, JSON_UNESCAPED_UNICODE) ?: '[]';
    }

    private function storeCompanyLogo(Request $request): ?string
    {
        if (!$request->hasFile('company_logo')) {
            return null;
        }

        return ImageOptimizerService::processAndSave(
            $request->file('company_logo'),
            'company-logos',
            300 * 1024,
            1200,
            85
        );
    }

    public function index()
    {
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';

        $rows = DB::table($mapping['table'])
            ->orderByDesc('id')
            ->get();

        $this->shareSidebarCounts();

        return view(
            'admin.job-vacancies.index',
            compact('rows', 'mapping', 'table_key')
        );
    }

    public function show($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';

        $row = DB::table($mapping['table'])
            ->where('id', $id)
            ->first();

        if (!$row) {
            abort(404);
        }

        $this->shareSidebarCounts();

        return view(
            'admin.job-vacancies.show',
            compact('row', 'mapping', 'table_key')
        );
    }

    public function create()
    {
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';

        $this->shareSidebarCounts();

        return view(
            'admin.job-vacancies.form',
            compact('mapping', 'table_key')
        );
    }

    public function store(Request $request)
    {
        $mapping = $this->getMapping();
        $tableName = $mapping['table'];

        $this->validateJob($request);

        $insertData = [];

        foreach ($mapping['fields'] as $fieldName => $config) {
            if (!Schema::hasColumn($tableName, $fieldName)) {
                continue;
            }

            if (($config['type'] ?? '') === 'file') {
                if ($request->hasFile($fieldName)) {
                    $path = $this->storeCompanyLogo($request);

                    if ($path !== null) {
                        $insertData[$fieldName] = $path;
                    }
                }

                continue;
            }

            if ($fieldName === 'skills_tags') {
                $insertData[$fieldName] = $this->normalizeSkills(
                    $request->input($fieldName, '')
                );

                continue;
            }

            if ($request->exists($fieldName)) {
                $insertData[$fieldName] = $request->input($fieldName);
            }
        }

        if (
            Schema::hasColumn($tableName, 'slug')
            && $request->filled('title')
        ) {
            $slug = Str::slug($request->input('title'));

            $insertData['slug'] = $slug . '-'
                . Str::lower(Str::random(6));
        }

        if (Schema::hasColumn($tableName, 'user_id')) {
            $insertData['user_id'] = Auth::id();
        }

        if (Schema::hasColumn($tableName, 'posted_by')) {
            $insertData['posted_by'] = Auth::id();
        }

        if (Schema::hasColumn($tableName, 'created_at')) {
            $insertData['created_at'] = now();
        }

        if (Schema::hasColumn($tableName, 'updated_at')) {
            $insertData['updated_at'] = now();
        }

        DB::table($tableName)->insert($insertData);

        return redirect()
            ->route('admin.job-vacancies.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'job_vacancies';

        $row = DB::table($mapping['table'])
            ->where('id', $id)
            ->first();

        if (!$row) {
            abort(404);
        }

        $this->shareSidebarCounts();

        return view(
            'admin.job-vacancies.form',
            compact('row', 'mapping', 'table_key')
        );
    }

    public function update(Request $request, $id)
    {
        $mapping = $this->getMapping();
        $tableName = $mapping['table'];

        $this->validateJob($request, true);

        $existingJob = DB::table($tableName)
            ->where('id', $id)
            ->first();

        if (!$existingJob) {
            abort(404);
        }

        $updateData = [];

        foreach ($mapping['fields'] as $fieldName => $config) {
            if (!Schema::hasColumn($tableName, $fieldName)) {
                continue;
            }

            if (($config['type'] ?? '') === 'file') {
                if ($request->hasFile($fieldName)) {
                    $path = $this->storeCompanyLogo($request);

                    if ($path !== null) {
                        $updateData[$fieldName] = $path;
                    }
                }

                continue;
            }

            if ($fieldName === 'skills_tags') {
                $updateData[$fieldName] = $this->normalizeSkills(
                    $request->input($fieldName, '')
                );

                continue;
            }

            if ($request->exists($fieldName)) {
                $updateData[$fieldName] = $request->input($fieldName);
            }
        }

        if (Schema::hasColumn($tableName, 'updated_at')) {
            $updateData['updated_at'] = now();
        }

        DB::table($tableName)
            ->where('id', $id)
            ->update($updateData);

        if (
            !empty($updateData['company_logo'])
            && !empty($existingJob->company_logo)
            && $existingJob->company_logo !== $updateData['company_logo']
        ) {
            ImageOptimizerService::deleteFile(
                $existingJob->company_logo
            );
        }

        return redirect()
            ->route('admin.job-vacancies.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mapping = $this->getMapping();

        $job = DB::table($mapping['table'])
            ->where('id', $id)
            ->first();

        if (!$job) {
            abort(404);
        }

        DB::table($mapping['table'])
            ->where('id', $id)
            ->delete();

        if (!empty($job->company_logo)) {
            ImageOptimizerService::deleteFile(
                $job->company_logo
            );
        }

        return redirect()
            ->route('admin.job-vacancies.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function updateJobType(Request $request, $id)
    {
        $validated = $request->validate([
            'job_type' => 'required|string|in:Full-Time,Part-Time,Freelance,Remote,Magang,Kontrak',
        ]);

        $job = DB::table('job_vacancies')
            ->where('id', $id)
            ->first();

        if (!$job) {
            return response()->json([
                'success' => false,
                'message' => 'Lowongan tidak ditemukan.',
            ], 404);
        }

        $updateData = [
            'job_type' => $validated['job_type'],
        ];

        if (Schema::hasColumn('job_vacancies', 'updated_at')) {
            $updateData['updated_at'] = now();
        }

        DB::table('job_vacancies')
            ->where('id', $id)
            ->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Sifat pekerjaan berhasil diperbarui menjadi '
                . $validated['job_type'] . '.',
            'job_type' => $validated['job_type'],
        ]);
    }

    public function export()
    {
        return Excel::download(
            new JobVacanciesExport,
            'Rekap_Lowongan_Kerja_' . date('Ymd_His') . '.xlsx'
        );
    }

    public function exportApplications($id)
    {
        $job = JobVacancy::findOrFail($id);

        $filename = 'Pelamar_' . Str::slug($job->title)
            . '_' . date('Ymd_His') . '.xlsx';

        return Excel::download(
            new JobApplicationsExport($id),
            $filename
        );
    }
}
