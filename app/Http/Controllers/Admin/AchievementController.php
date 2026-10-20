<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlumniAchievement;
use App\Models\AlumniProfile;

class AchievementController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alumni_profile_id' => 'required|exists:alumni_profiles,id',
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $profile = AlumniProfile::findOrFail(
            $validated['alumni_profile_id']
        );

        AlumniAchievement::create([
            'user_id' => $profile->user_id,
            'name' => $validated['name'],
            'status' => $validated['status'],

            // Kolom lama tetap dipertahankan.
            // Sesuaikan nilainya jika kolom database wajib diisi.
            'date' => now()->toDateString(),
            'type' => '',
            'place' => '',
        ]);

        return back()->with(
            'status',
            'Prestasi berhasil ditambahkan.'
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $achievement = AlumniAchievement::findOrFail($id);

        $achievement->update([
            'name' => $validated['name'],
            'status' => $validated['status'],
        ]);

        return back()->with(
            'status',
            'Prestasi berhasil diperbarui.'
        );
    }

    public function destroy($id)
    {
        $achievement = AlumniAchievement::findOrFail($id);
        $achievement->delete();

        return back()->with(
            'status',
            'Prestasi berhasil dihapus.'
        );
    }
}
