<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan form untuk mereset password langsung (tanpa email/token).
     */
    public function request()
    {
        return view('auth.forgot-password');
    }

    /**
     * Proses update password baru ke database dan langsung login.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.exists' => 'Email tidak terdaftar.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Langsung login
            auth()->login($user);

            // Redirect ke halaman utama / web
            return redirect()->route('home')->with('success', 'Kata sandi berhasil diubah dan Anda telah masuk.');
        }

        return back()->withErrors(['email' => 'Gagal mereset kata sandi.']);
    }
}
