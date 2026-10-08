<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
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
        $query = DB::table('users')
            ->whereIn('role', ['admin', 'super_admin']);

        if (request()->has('status') && in_array(request('status'), ['0', '1'], true)) {
            $query->where('is_active', request('status'));
        }

        $admins = $query->paginate(10)->withQueryString();

        $this->shareSidebarCounts();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->shareSidebarCounts();
        return view('admin.admins.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Akun Admin Baru Berhasil Didaftarkan!');
    }

    public function edit($id)
    {
        $admin = DB::table('users')->where('id', $id)->whereIn('role', ['admin', 'super_admin'])->first();
        if (!$admin) abort(404);

        $this->shareSidebarCounts();
        return view('admin.admins.form', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = DB::table('users')->where('id', $id)->whereIn('role', ['admin', 'super_admin'])->first();
        if (!$admin) abort(404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($updateData);

        return redirect()->route('admin.admins.index')->with('success', 'Data Akun Admin Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $admin = DB::table('users')->where('id', $id)->whereIn('role', ['admin', 'super_admin'])->first();
        if (!$admin) abort(404);

        if (Auth::id() == $id) {
            return redirect()->route('admin.admins.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Akun Admin Berhasil Dihapus!');
    }

    public function toggleStatus(Request $request, $id)
    {
        $admin = DB::table('users')->where('id', $id)->whereIn('role', ['admin', 'super_admin'])->first();
        if (!$admin) return response()->json(['success' => false, 'message' => 'Admin tidak ditemukan'], 404);

        if (Auth::id() == $id) {
            return response()->json(['success' => false, 'message' => 'Anda tidak bisa menonaktifkan akun Anda sendiri.'], 403);
        }

        $request->validate([
            'is_active' => 'required|in:0,1'
        ]);

        DB::table('users')->where('id', $id)->update([
            'is_active' => $request->is_active,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Status admin berhasil diperbarui.']);
    }
}
