<?php

namespace App\Http\Controllers\Admin\Alumnis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumnisExport;
use App\Imports\AlumnisImport;

class AlumniController extends Controller
{
    private function getMapping()
    {
        return [
            'title' => 'Data Alumni',
            'table' => 'alumni_profiles',

            'list_columns' => [
                'name',
                'graduation_year',
                'profession',
                'phone_number',
                'study_status',
            ],

            'fields' => [
                'name' => [
                    'label' => 'Nama Lengkap',
                    'type' => 'text',
                    'required' => true,
                ],

                'student_number' => [
                    'label' => 'Nomor Induk Alumni',
                    'type' => 'text',
                    'required' => false,
                ],

                'graduation_year' => [
                    'label' => 'Tahun Kelulusan',
                    'type' => 'number',
                    'required' => true,
                    'min' => 1901,
                ],

                'major' => [
                    'label' => 'Jurusan / Program Studi',
                    'type' => 'text',
                    'required' => true,
                ],

                'profession' => [
                    'label' => 'Profesi Saat Ini',
                    'type' => 'text',
                    'required' => true,
                ],

                'company' => [
                    'label' => 'Nama Instansi / Perusahaan',
                    'type' => 'text',
                    'required' => true,
                ],

                'city' => [
                    'label' => 'Kota Domisili',
                    'type' => 'text',
                    'required' => true,
                ],

                'phone_number' => [
                    'label' => 'Nomor WhatsApp',
                    'type' => 'text',
                    'required' => true,
                ],

                'avatar' => [
                    'label' => 'Foto Profil Utama',
                    'type' => 'file',
                    'required' => false,
                    'hint' => 'Pilih foto profil.',
                ],

                'bio' => [
                    'label' => 'Biografi Singkat',
                    'type' => 'textarea',
                    'required' => true,
                ],

                'linkedin_url' => [
                    'label' => 'URL LinkedIn',
                    'type' => 'url',
                    'required' => false,
                ],

                'instagram_url' => [
                    'label' => 'URL Instagram',
                    'type' => 'url',
                    'required' => false,
                ],

                'github_url' => [
                    'label' => 'URL GitHub',
                    'type' => 'url',
                    'required' => false,
                ],

                'twitter_url' => [
                    'label' => 'URL Twitter / X',
                    'type' => 'url',
                    'required' => false,
                ],

                'youtube_url' => [
                    'label' => 'URL YouTube',
                    'type' => 'url',
                    'required' => false,
                ],

                'tiktok_url' => [
                    'label' => 'URL TikTok',
                    'type' => 'url',
                    'required' => false,
                ],

                'portfolio_url' => [
                    'label' => 'URL Portofolio',
                    'type' => 'url',
                    'required' => false,
                ],

                'achievements' => [
                    'label' => 'Penghargaan dan Prestasi',
                    'type' => 'textarea',
                    'required' => false,
                ],

                'organization_role' => [
                    'label' => 'Pengalaman Organisasi',
                    'type' => 'textarea',
                    'required' => false,
                ],

                'current_university' => [
                    'label' => 'Universitas Saat Ini',
                    'type' => 'text',
                    'required' => false,
                ],

                'study_status' => [
                    'label' => 'Status',
                    'type' => 'select',
                    'required' => true,
                    'options' => [
                        'Aktif' => 'Aktif',
                        'Non-aktif' => 'Tidak Aktif',
                    ],
                ],
            ],
        ];
    }

    private function shareSidebarCounts()
    {
        $counts = [
            'alumnis' => Schema::hasTable('alumni_profiles')
                ? DB::table('alumni_profiles')->count()
                : 0,

            'alumni_boards' => Schema::hasTable('alumni_committees')
                ? DB::table('alumni_committees')->count()
                : 0,

            'job_vacancies' => Schema::hasTable('job_vacancies')
                ? DB::table('job_vacancies')->count()
                : 0,

            'articles' => Schema::hasTable('articles')
                ? DB::table('articles')->count()
                : 0,

            'events' => Schema::hasTable('events')
                ? DB::table('events')->count()
                : 0,

            'albums' => Schema::hasTable('albums')
                ? DB::table('albums')->count()
                : 0,

            'galleries' => Schema::hasTable('album_photos')
                ? DB::table('album_photos')->count()
                : 0,

            'contents' => Schema::hasTable('page_contents')
                ? DB::table('page_contents')->count()
                : 0,
        ];

        View::share('counts', $counts);
    }

    public function index()
    {
        $mapping = $this->getMapping();
        $table_key = 'alumnis';

        $rows = DB::table('alumni_profiles')
            ->join(
                'users',
                'alumni_profiles.user_id',
                '=',
                'users.id'
            )
            ->select(
                'alumni_profiles.*',
                'users.name as name'
            )
            ->get();

        $this->shareSidebarCounts();

        return view(
            'admin.alumnis.index',
            compact('rows', 'mapping', 'table_key')
        );
    }

    public function show($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'alumnis';

        $row = DB::table('alumni_profiles')
            ->join(
                'users',
                'alumni_profiles.user_id',
                '=',
                'users.id'
            )
            ->select(
                'alumni_profiles.*',
                'users.name as name'
            )
            ->where('alumni_profiles.id', $id)
            ->first();

        if (!$row) {
            abort(404);
        }

        // Ambil prestasi terstruktur untuk halaman Detail.
        $achievements = collect();

        if (
            $row->user_id &&
            Schema::hasTable('alumni_achievements')
        ) {
            $achievements = \App\Models\AlumniAchievement::where(
                'user_id',
                $row->user_id
            )
                ->orderBy('date', 'desc')
                ->get();
        }

        $this->shareSidebarCounts();

        return view(
            'admin.alumnis.show',
            compact('row', 'mapping', 'table_key', 'achievements')
        );
    }

    public function create()
    {
        $mapping = $this->getMapping();
        $table_key = 'alumnis';

        $this->shareSidebarCounts();

        return view(
            'admin.alumnis.form',
            compact('mapping', 'table_key')
        );
    }

    public function store(Request $request)
    {
        $mapping = $this->getMapping();
        $tableName = $mapping['table'];

        $rules = [];

        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($fieldName === 'name') {
                $rules[$fieldName] = 'required|string|max:255';
            } elseif ($fieldName === 'avatar') {
                $rules[$fieldName] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
            } elseif ($fieldName === 'graduation_year') {
                $rules[$fieldName] = 'required|integer|min:1901';
            } elseif ($fieldName === 'study_status') {
                $rules[$fieldName] = 'required|in:Aktif,Non-aktif';
            } elseif ($config['type'] === 'url') {
                $rules[$fieldName] = 'nullable|url|max:2048';
            } elseif ($config['required'] ?? false) {
                $rules[$fieldName] = 'required|string|max:10000';
            } else {
                $rules[$fieldName] = 'nullable|string|max:10000';
            }
        }

        $request->validate($rules);

        $name = $request->input('name');
        $baseSlug = Str::slug($name);

        if (empty($baseSlug)) {
            $baseSlug = 'alumni';
        }

        $email = $baseSlug . '.' . Str::random(8) . '@alumni.id';

        $userId = DB::table('users')->insertGetId([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make(Str::random(32)),
            'role' => 'user',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $insertData = [];

        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($fieldName === 'name') {
                continue;
            }

            if (!Schema::hasColumn($tableName, $fieldName)) {
                continue;
            }

            if ($fieldName === 'avatar') {
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');

                    $filename = time() . '_' . Str::random(8) . '.' .
                        $file->getClientOriginalExtension();

                    $file->move(public_path('uploads'), $filename);

                    $insertData['avatar'] = 'uploads/' . $filename;
                }

                continue;
            }

            $insertData[$fieldName] = $request->input($fieldName);
        }

        $insertData['user_id'] = $userId;

        if (Schema::hasColumn($tableName, 'slug')) {
            $insertData['slug'] = $baseSlug . '-' . Str::lower(Str::random(6));
        }

        if (Schema::hasColumn($tableName, 'created_at')) {
            $insertData['created_at'] = now();
        }

        if (Schema::hasColumn($tableName, 'updated_at')) {
            $insertData['updated_at'] = now();
        }

        DB::table($tableName)->insert($insertData);

        return redirect()
            ->route('admin.alumnis.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'alumnis';

        $row = DB::table('alumni_profiles')
            ->join(
                'users',
                'alumni_profiles.user_id',
                '=',
                'users.id'
            )
            ->select(
                'alumni_profiles.*',
                'users.name as name'
            )
            ->where('alumni_profiles.id', $id)
            ->first();

        if (!$row) {
            abort(404);
        }

        // Ambil prestasi terstruktur untuk ditampilkan di halaman Edit.
        $achievements = collect();

        if (
            $row->user_id &&
            Schema::hasTable('alumni_achievements')
        ) {
            $achievements = \App\Models\AlumniAchievement::where(
                'user_id',
                $row->user_id
            )
                ->orderBy('date', 'desc')
                ->get();
        }

        $this->shareSidebarCounts();

        return view(
            'admin.alumnis.form',
            compact(
                'row',
                'mapping',
                'table_key',
                'achievements'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $mapping = $this->getMapping();
        $tableName = $mapping['table'];

        $profile = DB::table($tableName)
            ->where('id', $id)
            ->first();

        if (!$profile) {
            abort(404);
        }

        $rules = [];

        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($fieldName === 'name') {
                $rules[$fieldName] = 'required|string|max:255';
            } elseif ($fieldName === 'avatar') {
                $rules[$fieldName] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
            } elseif ($fieldName === 'graduation_year') {
                $rules[$fieldName] = 'required|integer|min:1901';
            } elseif ($fieldName === 'study_status') {
                $rules[$fieldName] = 'required|in:Aktif,Non-aktif';
            } elseif ($config['type'] === 'url') {
                $rules[$fieldName] = 'nullable|url|max:2048';
            } elseif ($config['required'] ?? false) {
                $rules[$fieldName] = 'required|string|max:10000';
            } else {
                $rules[$fieldName] = 'nullable|string|max:10000';
            }
        }

        $request->validate($rules);

        $updateData = [];

        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($fieldName === 'name') {
                continue;
            }

            if (!Schema::hasColumn($tableName, $fieldName)) {
                continue;
            }

            if ($fieldName === 'avatar') {
                if ($request->hasFile('avatar')) {
                    $file = $request->file('avatar');

                    $filename = time() . '_' . Str::random(8) . '.' .
                        $file->getClientOriginalExtension();

                    $file->move(public_path('uploads'), $filename);

                    $updateData['avatar'] = 'uploads/' . $filename;
                }

                continue;
            }

            // Input kosong tetap disimpan agar data lama bisa dihapus.
            $updateData[$fieldName] = $request->input($fieldName);
        }

        if (Schema::hasColumn($tableName, 'updated_at')) {
            $updateData['updated_at'] = now();
        }

        DB::table($tableName)
            ->where('id', $id)
            ->update($updateData);

        if ($profile->user_id) {
            DB::table('users')
                ->where('id', $profile->user_id)
                ->update([
                    'name' => $request->input('name'),
                    'updated_at' => now(),
                ]);
        }

        return redirect()
            ->route('admin.alumnis.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profile = DB::table('alumni_profiles')
            ->where('id', $id)
            ->first();

        if (!$profile) {
            abort(404);
        }

        DB::transaction(function () use ($profile, $id) {
            if (
                $profile->user_id &&
                Schema::hasTable('alumni_achievements')
            ) {
                DB::table('alumni_achievements')
                    ->where('user_id', $profile->user_id)
                    ->delete();
            }

            DB::table('alumni_profiles')
                ->where('id', $id)
                ->delete();

            if ($profile->user_id) {
                DB::table('users')
                    ->where('id', $profile->user_id)
                    ->delete();
            }
        });

        return redirect()
            ->route('admin.alumnis.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(
            new AlumnisExport,
            'Data_Alumni_' . date('Ymd_His') . '.xlsx'
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(
                new AlumnisImport,
                $request->file('import_file')
            );

            return redirect()
                ->route('admin.alumnis.index')
                ->with('success', 'Data alumni berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.alumnis.index')
                ->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}
