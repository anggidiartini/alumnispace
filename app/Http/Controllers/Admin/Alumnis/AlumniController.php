<?php

namespace App\Http\Controllers\Admin\Alumnis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
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
            'list_columns' => ['name', 'graduation_year', 'profession', 'phone_number', 'study_status'],
            'fields' => [
                'name' => ['label' => 'Nama Lengkap', 'type' => 'text', 'required' => true],
                'graduation_year' => ['label' => 'Tahun Kelulusan', 'type' => 'number', 'required' => true, 'min' => 1901],
                'major' => ['label' => 'Jurusan / Program Studi', 'type' => 'text', 'required' => true],
                'profession' => ['label' => 'Profesi Saat Ini', 'type' => 'text', 'required' => true],
                'company' => ['label' => 'Nama Instansi / Perusahaan', 'type' => 'text', 'required' => true],
                'city' => ['label' => 'Kota Domisili', 'type' => 'text', 'required' => true],
                'phone_number' => ['label' => 'Nomor WhatsApp', 'type' => 'text', 'required' => true],
                'avatar' => ['label' => 'Foto Profil Utama', 'type' => 'file', 'required' => false, 'hint' => 'Maks berkas: 300KB - 500KB'],
                'bio' => ['label' => 'Biografi Singkat', 'type' => 'textarea', 'required' => true],
                'study_status' => ['label' => 'Status', 'type' => 'select', 'required' => true, 'options' => ['Aktif' => 'Aktif', 'Non-aktif' => 'Tidak Aktif']],
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
        $table_key = 'alumnis';
        
        $rows = DB::table('alumni_profiles')
            ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
            ->select('alumni_profiles.*', 'users.name as name')
            ->get();

        $this->shareSidebarCounts();
        return view('admin.alumnis.index', compact('rows', 'mapping', 'table_key'));
    }

    public function show($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'alumnis';

        $row = DB::table('alumni_profiles')
            ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
            ->select('alumni_profiles.*', 'users.name as name')
            ->where('alumni_profiles.id', $id)
            ->first();

        if (!$row) abort(404);

        $this->shareSidebarCounts();
        return view('admin.alumnis.show', compact('row', 'mapping', 'table_key'));
    }

    public function create()
    {
        $mapping = $this->getMapping();
        $table_key = 'alumnis';
        
        $this->shareSidebarCounts();
        return view('admin.alumnis.form', compact('mapping', 'table_key'));
    }

    public function store(Request $request)
    {
        $mapping = $this->getMapping();
        $tableName = $mapping['table'];

        $rules = [];
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = 'image|mimes:jpeg,png,jpg|min:300|max:500';
        }

        if (!empty($rules)) {
            $request->validate($rules);
        }

        $insertData = [];
        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($fieldName === 'name') continue;

            if ($config['type'] === 'file' && $request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $insertData[$fieldName] = 'uploads/' . $filename;
            } elseif ($request->has($fieldName)) {
                $insertData[$fieldName] = $request->input($fieldName);
            }
        }

        $name = $request->input('name', 'Alumni');
        $baseSlug = Str::slug($name);
        if (empty($baseSlug)) {
            $baseSlug = 'alumni';
        }
        $email = $baseSlug . '.' . rand(100, 9999) . '@alumni.id';

        $userId = DB::table('users')->insertGetId([
            'name' => $name,
            'email' => $email,
            'password' => \Hash::make('password123'),
            'role' => 'user',
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $insertData['user_id'] = $userId;
        if (Schema::hasColumn($tableName, 'slug')) {
            $insertData['slug'] = $baseSlug . '-' . rand(100, 999);
        }

        DB::table($tableName)->insert($insertData);

        return redirect()->route('admin.alumnis.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $mapping = $this->getMapping();
        $table_key = 'alumnis';

        $row = DB::table('alumni_profiles')
            ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
            ->select('alumni_profiles.*', 'users.name as name')
            ->where('alumni_profiles.id', $id)
            ->first();

        if (!$row) abort(404);

        $this->shareSidebarCounts();
        return view('admin.alumnis.form', compact('row', 'mapping', 'table_key'));
    }

    public function update(Request $request, $id)
    {
        $mapping = $this->getMapping();

        $rules = [];
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = 'image|mimes:jpeg,png,jpg|min:300|max:500';
        }

        if (!empty($rules)) {
            $request->validate($rules);
        }

        $updateData = [];
        foreach ($mapping['fields'] as $fieldName => $config) {
            if ($fieldName === 'name') continue;

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

        if ($request->filled('name')) {
            $profile = DB::table('alumni_profiles')->where('id', $id)->first();
            if ($profile && $profile->user_id) {
                DB::table('users')->where('id', $profile->user_id)->update([
                    'name' => $request->input('name'),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.alumnis.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profile = DB::table('alumni_profiles')->where('id', $id)->first();
        if ($profile && $profile->user_id) {
            DB::table('users')->where('id', $profile->user_id)->delete();
        }

        DB::table('alumni_profiles')->where('id', $id)->delete();

        return redirect()->route('admin.alumnis.index')->with('success', 'Data berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new AlumnisExport, 'Data_Alumni_' . date('Ymd_His') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new AlumnisImport, $request->file('import_file'));
            return redirect()->route('admin.alumnis.index')->with('success', 'Data alumni berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->route('admin.alumnis.index')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}
