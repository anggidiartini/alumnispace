<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TableController extends Controller
{
    /**
     * Konfigurasi Pemetaan Kamus Data (Metadata Mapping)
     * Disesuaikan dengan instruksi visual pengguna tanpa kebocoran kode/ID.
     */
    private function getTableMapping($table_key)
    {
        $registry = [
            'alumnis' => [
                'title' => 'Data Alumni',
                'table' => 'alumni_profiles',
                'list_columns' => ['student_number', 'name', 'graduation_year', 'profession', 'phone_number', 'study_status'],
                'fields' => [
                    'student_number' => ['label' => 'Nomor Anggota', 'type' => 'text', 'required' => true],
                    'name' => ['label' => 'Nama Lengkap', 'type' => 'text', 'required' => true, 'readonly' => true],
                    'graduation_year' => ['label' => 'Tahun Kelulusan', 'type' => 'number', 'required' => true, 'min' => 1901],
                    'major' => ['label' => 'Jurusan / Program Studi', 'type' => 'text', 'required' => true],
                    'profession' => ['label' => 'Profesi Saat Ini', 'type' => 'text', 'required' => true],
                    'company' => ['label' => 'Nama Instansi / Perusahaan', 'type' => 'text', 'required' => true],
                    'city' => ['label' => 'Kota Domisili', 'type' => 'text', 'required' => true],
                    'phone_number' => ['label' => 'Nomor WhatsApp', 'type' => 'text', 'required' => true],
                    'avatar' => ['label' => 'Foto Profil Utama', 'type' => 'file', 'required' => false, 'hint' => 'Maks berkas: 300KB - 500KB'],
                    'bio' => ['label' => 'Biografi Singkat', 'type' => 'textarea', 'required' => true],
                    'study_status' => ['label' => 'Status Keaktifan Komunitas', 'type' => 'select', 'required' => true, 'options' => ['Aktif' => 'Aktif', 'Non-aktif' => 'Tidak Aktif']],
                ]
            ],
            'job_vacancies' => [
                'title' => 'Lowongan Kerja',
                'table' => 'job_vacancies',
                'list_columns' => ['company_name', 'title', 'job_type', 'is_active'],
                'fields' => [
                    'company_name' => ['label' => 'Nama Perusahaan', 'type' => 'text', 'required' => true],
                    'title' => ['label' => 'Posisi Lowongan', 'type' => 'text', 'required' => true],
                    'job_type' => ['label' => 'Sifat Pekerjaan', 'type' => 'text', 'required' => true],
                    'workplace_type' => ['label' => 'Sistem Kerja', 'type' => 'text', 'required' => true],
                    'location' => ['label' => 'Lokasi Penempatan', 'type' => 'text', 'required' => true],
                    'salary_display' => ['label' => 'Informasi Gaji', 'type' => 'text', 'required' => true],
                    'description' => ['label' => 'Deskripsi Pekerjaan', 'type' => 'textarea', 'required' => true],
                    'requirements' => ['label' => 'Syarat Kualifikasi', 'type' => 'textarea', 'required' => true],
                    'is_active' => ['label' => 'Status Lowongan', 'type' => 'toggle', 'required' => true, 'options' => [1 => 'Buka', 0 => 'Tutup']],
                ]
            ],
            'articles' => [
                'title' => 'Artikel & Berita',
                'table' => 'articles',
                'list_columns' => ['title', 'category', 'is_published'],
                'fields' => [
                    'title' => ['label' => 'Judul Berita', 'type' => 'text', 'required' => true],
                    'category' => ['label' => 'Kategori Berita', 'type' => 'text', 'required' => true],
                    'thumbnail' => ['label' => 'Gambar Mini (Thumbnail)', 'type' => 'file', 'required' => false, 'hint' => 'Maks berkas: 50KB'],
                    'excerpt' => ['label' => 'Kutipan / Ringkasan Awal', 'type' => 'textarea', 'required' => true],
                    'content' => ['label' => 'Isi Lengkap Berita', 'type' => 'textarea', 'required' => true],
                    'is_published' => ['label' => 'Status Tayang', 'type' => 'toggle', 'required' => true, 'options' => [1 => 'Diterbitkan', 0 => 'Disimpan sebagai Draf']],
                ]
            ],
            'event' => [
                'title' => 'Acara & Agenda',
                'table' => 'events',
                'list_columns' => ['title', 'event_date', 'status'],
                'fields' => [
                    'title' => ['label' => 'Nama Agenda Acara', 'type' => 'text', 'required' => true],
                    'category' => ['label' => 'Kategori Kegiatan', 'type' => 'text', 'required' => true],
                    'event_date' => ['label' => 'Tanggal Kegiatan', 'type' => 'date', 'required' => true],
                    'time_display' => ['label' => 'Keterangan Waktu / Jam', 'type' => 'text', 'required' => true],
                    'venue' => ['label' => 'Lokasi / Tempat Acara', 'type' => 'text', 'required' => true],
                    'description' => ['label' => 'Deskripsi Lengkap Acara', 'type' => 'textarea', 'required' => true],
                    'quota' => ['label' => 'Kuota Peserta', 'type' => 'number', 'required' => true],
                    'status' => ['label' => 'Status Pelaksanaan', 'type' => 'select', 'required' => true, 'options' => ['upcoming' => 'Segera Hadir', 'completed' => 'Selesai']],
                ]
            ],
            'albums' => [
                'title' => 'Album Foto',
                'table' => 'albums',
                'list_columns' => ['title', 'category', 'target_generation'],
                'fields' => [
                    'title' => ['label' => 'Nama Album Galeri', 'type' => 'text', 'required' => true],
                    'category' => ['label' => 'Jenis Kegiatan (Indoor/Outdoor)', 'type' => 'text', 'required' => true],
                    'subtitle_label' => ['label' => 'Label Sub-Keterangan', 'type' => 'text', 'required' => true],
                    'target_generation' => ['label' => 'Target Angkatan', 'type' => 'text', 'required' => true],
                    'description' => ['label' => 'Keterangan Singkat Album', 'type' => 'textarea', 'required' => true],
                ]
            ],
            'galleries' => [
                'title' => 'Galeri Foto',
                'table' => 'album_photos',
                'list_columns' => ['caption', 'photo_path'],
                'fields' => [
                    'caption' => ['label' => 'Keterangan Gambar', 'type' => 'text', 'required' => true],
                    'photo_path' => ['label' => 'Foto Kenangan', 'type' => 'file', 'required' => false, 'hint' => 'Maks berkas berkas: 500KB'],
                ]
            ]
        ];

        if (!isset($registry[$table_key])) {
            $tableName = $this->mapTable($table_key);
            $rawColumns = Schema::getColumnListing($tableName);
            $cleanColumns = array_filter($rawColumns, function($col) {
                return !in_array($col, ['id', 'created_at', 'updated_at', 'remember_token', 'email_verified_at']) 
                    && !Str::endsWith($col, '_id') && !Str::startsWith($col, 'posted_');
            });

            $fields = [];
            foreach ($cleanColumns as $col) {
                $fields[$col] = ['label' => ucwords(str_replace('_', ' ', $col)), 'type' => 'text'];
            }

            return [
                'title' => ucwords($table_key),
                'table' => $tableName,
                'list_columns' => array_slice($cleanColumns, 0, 4),
                'fields' => $fields
            ];
        }

        return $registry[$table_key];
    }
    private function shareSidebarCounts()
    {
        $tables = [
            'alumnis' => 'alumni_profiles',
            'job_vacancies' => 'job_vacancies',
            'articles' => 'articles',
            'event' => 'events',
            'albums' => 'albums',
            'galleries' => 'album_photos'
        ];

        $counts = [];
        foreach ($tables as $key => $dbTable) {
            $counts[$key] = Schema::hasTable($dbTable) ? DB::table($dbTable)->count() : 0;
        }
        $counts['contents'] = Schema::hasTable('page_contents') ? DB::table('page_contents')->count() : 0;
        \View::share('counts', $counts);
    }

    private function mapTable($key)
    {
        $map = [
            'alumnis' => 'alumni_profiles',
            'job_vacancies' => 'job_vacancies',
            'articles' => 'articles',
            'event' => 'events',
            'albums' => 'albums',
            'galleries' => 'album_photos',
        ];
        return $map[$key] ?? $key;
    }

    public function index($table_key)
    {
        $mapping = $this->getTableMapping($table_key);
        if (!Schema::hasTable($mapping['table'])) {
            return redirect()->route('admin.dashboard')->with('error', "Halaman tidak dapat ditemukan.");
        }

        if ($table_key === 'alumnis') {
            $rows = DB::table('alumni_profiles')
                ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                ->select('alumni_profiles.*', 'users.name as name')
                ->paginate(10);
        } else {
            $rows = DB::table($mapping['table'])->paginate(10);
        }

        $this->shareSidebarCounts();
        return view('admin.dashboard.table_index', compact('rows', 'mapping', 'table_key'));
    }

    public function show($table_key, $id)
    {
        $mapping = $this->getTableMapping($table_key);
        
        if ($table_key === 'alumnis') {
            $row = DB::table('alumni_profiles')
                ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                ->select('alumni_profiles.*', 'users.name as name')
                ->where('alumni_profiles.id', $id)
                ->first();
        } else {
            $row = DB::table($mapping['table'])->where('id', $id)->first();
        }

        if (!$row) abort(404);

        $this->shareSidebarCounts();
        return view('admin.dashboard.table_detail', compact('row', 'mapping', 'table_key'));
    }

    public function create($table_key)
    {
        $mapping = $this->getTableMapping($table_key);
        $this->shareSidebarCounts();

        return view('admin.dashboard.table_form', compact('mapping', 'table_key'));
    }

    public function store(Request $request, $table_key)
    {
        $mapping = $this->getTableMapping($table_key);
        $tableName = $mapping['table'];

        // Aturan validasi file gambar dinamis berdasarkan jenis konten
        $rules = [];
        if ($request->hasFile('avatar')) { $rules['avatar'] = 'image|mimes:jpeg,png,jpg|min:300|max:500'; }
        if ($request->hasFile('thumbnail')) { $rules['thumbnail'] = 'image|mimes:jpeg,png,jpg|max:50'; }
        if ($request->hasFile('photo_path')) { $rules['photo_path'] = 'image|mimes:jpeg,png,jpg|max:500'; }
        
        if (!empty($rules)) { $request->validate($rules); }

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

        if (Schema::hasColumn($tableName, 'slug') && $request->filled('title')) {
            $insertData['slug'] = Str::slug($request->title) . '-' . rand(100, 999);
        }

        // Otomatis mengisi data relasi petugas pengunggah dari session login
        $allFields = Schema::getColumnListing($tableName);
        if (in_array('user_id', $allFields) && $table_key !== 'alumnis') { $insertData['user_id'] = Auth::id(); }
        if (in_array('posted_by', $allFields)) { $insertData['posted_by'] = Auth::id(); }
        if (in_array('created_by', $allFields)) { $insertData['created_by'] = Auth::id(); }
        if (in_array('author_id', $allFields)) { $insertData['author_id'] = Auth::id(); }
        if (in_array('uploaded_by', $allFields)) { $insertData['uploaded_by'] = Auth::id(); }

        DB::table($tableName)->insert($insertData);

        return redirect()->route('admin.table.index', $table_key)->with('success', 'Data berhasil disimpan.');
    }

    public function edit($table_key, $id)
    {
        $mapping = $this->getTableMapping($table_key);
        
        if ($table_key === 'alumnis') {
            $row = DB::table('alumni_profiles')
                ->join('users', 'alumni_profiles.user_id', '=', 'users.id')
                ->select('alumni_profiles.*', 'users.name as name')
                ->where('alumni_profiles.id', $id)
                ->first();
        } else {
            $row = DB::table($mapping['table'])->where('id', $id)->first();
        }

        if (!$row) abort(404);
        
        $this->shareSidebarCounts();
        return view('admin.dashboard.table_form', compact('row', 'mapping', 'table_key'));
    }

    public function update(Request $request, $table_key, $id)
    {
        $mapping = $this->getTableMapping($table_key);

        $rules = [];
        if ($request->hasFile('avatar')) { $rules['avatar'] = 'image|mimes:jpeg,png,jpg|min:300|max:500'; }
        if ($request->hasFile('thumbnail')) { $rules['thumbnail'] = 'image|mimes:jpeg,png,jpg|max:50'; }
        if ($request->hasFile('photo_path')) { $rules['photo_path'] = 'image|mimes:jpeg,png,jpg|max:500'; }
        
        if (!empty($rules)) { $request->validate($rules); }

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
        return redirect()->route('admin.table.index', $table_key)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($table_key, $id)
    {
        $mapping = $this->getTableMapping($table_key);
        DB::table($mapping['table'])->where('id', $id)->delete();

        return redirect()->route('admin.table.index', $table_key)->with('success', 'Data berhasil dihapus.');
    }
}
