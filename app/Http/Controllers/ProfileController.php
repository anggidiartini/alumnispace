<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            // Email (kolom users, bukan profiles) — boleh diganti user ke email pribadinya
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'current_password' => ['nullable', 'string'],

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

            // Prestasi & Riwayat Organisasi (dua-duanya list dinamis)
            'achievements' => ['nullable', 'array'],
            'achievements.*' => ['nullable', 'string', 'max:255'],
            'organization_role' => ['nullable', 'array'],
            'organization_role.*' => ['nullable', 'string', 'max:255'],

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

        // Prestasi & Riwayat Organisasi dikirim sebagai array dari form list dinamis.
        // Dirapikan (buang baris kosong) lalu digabung jadi satu string per-baris,
        // supaya kolom `achievements` / `organization_role` di DB tidak perlu diubah tipenya.
        $validated['achievements'] = collect($request->input('achievements', []))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->implode("\n");

        $validated['organization_role'] = collect($request->input('organization_role', []))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->implode("\n");

        // Email & password itu kolom di tabel `users`, bukan `profiles` —
        // pisahkan dulu sebelum $validated dipakai buat update/create profile.
        $newEmail = $validated['email'];
        $currentPassword = $validated['current_password'] ?? null;
        unset($validated['email'], $validated['current_password']);

        // Kalau email diganti ke yang beda dari email lama, wajib verifikasi
        // password saat ini dulu, biar orang lain yang lagi login di device yang
        // sama nggak bisa asal ganti email pemilik akun.
        if ($newEmail !== $user->email) {
            if (! $currentPassword || ! Hash::check($currentPassword, $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Password saat ini salah atau belum diisi.'])
                    ->withInput();
            }

            $user->email = $newEmail;
            // Hapus baris ini kalau situs kamu tidak memakai fitur verifikasi email.
            $user->email_verified_at = null;
            $user->save();
        }

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
            ->route('home')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}