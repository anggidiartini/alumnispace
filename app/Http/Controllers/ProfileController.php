<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan form Setting Profile untuk user yang sedang login.
     */
    public function edit()
    {
        $user = Auth::user();

        $profile = $user->profile ?? $user->profile()->make();

        return view('profile.settings', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Simpan perubahan data alumni milik user yang sedang login.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            // Riwayat pendidikan
            'student_number' => ['nullable', 'string', 'max:50'],
            'graduation_year' => ['nullable', 'integer', 'min:1990', 'max:' . (date('Y') + 1)],
            'major' => ['nullable', 'string', 'max:100'],
            'current_university' => ['nullable', 'string', 'max:255'],
            'study_status' => ['nullable', 'string', 'max:255'],

            // Pekerjaan
            'profession' => ['nullable', 'string', 'max:150'],
            'company' => ['nullable', 'string', 'max:150'],

            // Tempat tinggal
            'city' => ['nullable', 'string', 'max:100'],

            // Info kontak
            'phone_number' => ['nullable', 'string', 'max:30'],

            // Prestasi & organisasi
            'achievements' => ['nullable', 'string'],
            'organization_role' => ['nullable', 'string', 'max:255'],

            'bio' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'max:2048'],

            // Sosial media
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'tiktok_url' => ['nullable', 'url', 'max:255'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
        ]);

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        if ($request->hasFile('avatar')) {
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->update(['avatar' => $path]);
        }

        return redirect()
            ->route('profile.settings')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}