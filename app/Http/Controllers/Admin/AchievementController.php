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
        $request->validate([
            'alumni_profile_id' => 'required|exists:alumni_profiles,id',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $profile = AlumniProfile::findOrFail($request->alumni_profile_id);

        AlumniAchievement::create([
            'user_id' => $profile->user_id,
            'name' => $request->name,
            'date' => $request->date,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return back()->with('status', 'Penghargaan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $achievement = AlumniAchievement::findOrFail($id);
        $achievement->delete();

        return back()->with('status', 'Penghargaan berhasil dihapus.');
    }
}
