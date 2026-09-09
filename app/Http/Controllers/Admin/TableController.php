<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TableController extends Controller
{
    /**
     * Berbagi data hitungan lencana sidebar secara dinamis ke view.
     */
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
            if (Schema::hasTable($dbTable)) {
                $counts[$key] = DB::table($dbTable)->count();
            } else {
                $counts[$key] = 0;
            }
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
    private function getTableColumns($tableName)
    {
        $columns = Schema::getColumnListing($tableName);
        
        // Hapus 'id', token, email_verified, beserta seluruh kolom foreign key ID (seperti user_id, posted_by, dsb)
        return array_filter($columns, function($col) {
            return !in_array($col, ['id', 'created_at', 'updated_at', 'remember_token', 'email_verified_at']) 
                && !Str::endsWith($col, '_id') 
                && !Str::startsWith($col, 'posted_');
        });
    }


    public function index($table_key)
    {
        $tableName = $this->mapTable($table_key);
        if (!Schema::hasTable($tableName)) {
            return redirect()->route('admin.dashboard')->with('error', "Tabel tidak tersedia.");
        }

        $columns = $this->getTableColumns($tableName);
        $rows = DB::table($tableName)->paginate(10);
        
        $this->shareSidebarCounts();

        return view('admin.dashboard.table_index', compact('rows', 'columns', 'table_key', 'tableName'));
    }

    public function create($table_key)
    {
        $tableName = $this->mapTable($table_key);
        $columns = $this->getTableColumns($tableName);
        
        $this->shareSidebarCounts();

        return view('admin.dashboard.table_form', compact('columns', 'table_key', 'tableName'));
    }

    public function store(Request $request, $table_key)
    {
        $tableName = $this->mapTable($table_key);
        $columns = $this->getTableColumns($tableName);

        $insertData = [];
        foreach ($columns as $col) {
            if ($request->has($col)) {
                $insertData[$col] = $request->input($col);
            }
        }

        if (in_array('slug', $columns) && $request->filled('title')) {
            $insertData['slug'] = Str::slug($request->title) . '-' . rand(100, 999);
        }

        // Cari ID user login saat ini jika tabel membutuhkan data autentikasi relasi di latar belakang
        $allFields = Schema::getColumnListing($tableName);
        if (in_array('user_id', $allFields)) { $insertData['user_id'] = \Auth::id(); }
        if (in_array('posted_by', $allFields)) { $insertData['posted_by'] = \Auth::id(); }
        if (in_array('created_by', $allFields)) { $insertData['created_by'] = \Auth::id(); }
        if (in_array('author_id', $allFields)) { $insertData['author_id'] = \Auth::id(); }

        DB::table($tableName)->insert($insertData);

        return redirect()->route('admin.table.index', $table_key)->with('success', 'Data berhasil disimpan.');
    }

    public function edit($table_key, $id)
    {
        $tableName = $this->mapTable($table_key);
        $columns = $this->getTableColumns($tableName);
        $row = DB::table($tableName)->where('id', $id)->first();

        if (!$row) abort(404);
        
        $this->shareSidebarCounts();

        return view('admin.dashboard.table_form', compact('row', 'columns', 'table_key', 'tableName'));
    }

    public function update(Request $request, $table_key, $id)
    {
        $tableName = $this->mapTable($table_key);
        $columns = $this->getTableColumns($tableName);

        $updateData = [];
        foreach ($columns as $col) {
            if ($request->has($col)) {
                $updateData[$col] = $request->input($col);
            }
        }

        DB::table($tableName)->where('id', $id)->update($updateData);

        return redirect()->route('admin.table.index', $table_key)->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($table_key, $id)
    {
        $tableName = $this->mapTable($table_key);
        DB::table($tableName)->where('id', $id)->delete();

        return redirect()->route('admin.table.index', $table_key)->with('success', 'Data berhasil dihapus.');
    }
}
