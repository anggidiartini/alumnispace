<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthenticated. Silakan masuk terlebih dahulu.',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return redirect()->route('login')->withErrors([
                'email' => 'Silakan masuk terlebih dahulu.',
            ]);
        }

        if (!$user->is_active) {
            $isAdminArea = $request->is('admin') || $request->is('admin/*') || in_array($user->role, ['admin', 'super_admin']);
            Auth::logout();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun Anda dinonaktifkan. Silakan hubungi administrator untuk informasi lebih lanjut.',
                ], Response::HTTP_FORBIDDEN);
            }

            $loginRoute = $isAdminArea ? 'admin.login' : 'login';

            return redirect()->route($loginRoute)->withErrors([
                'email' => 'Akun Anda dinonaktifkan. Silakan hubungi administrator untuk informasi lebih lanjut.',
            ]);
        }

        // Admin dan Super Admin boleh mengakses halaman umum/user jika akun aktif.
        if (in_array($user->role, ['super_admin', 'admin'])) {
            return $next($request);
        }

        if (!in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Forbidden. Anda tidak memiliki hak akses yang sesuai.',
                ], Response::HTTP_FORBIDDEN);
            }

            if ($request->is('admin') || $request->is('admin/*') || (!in_array('alumni', $roles) && !in_array('user', $roles))) {
                abort(403, 'Akses Ditolak: Halaman ini hanya untuk Administrator.');
            }

            if (in_array('alumni', $roles) && !in_array('user', $roles)) {
                if ($user->role === 'user') {
                    $lockedFeature = $request->is('album*') ? 'Album Kenangan' : 'Direktori Alumni';
                    $lockedParam = $request->is('album*') ? 'album' : 'alumni';
                    return redirect()->route('home', ['locked' => $lockedParam])->with('locked_feature', $lockedFeature);
                }
                abort(403, 'Akses Ditolak: Halaman ini khusus untuk anggota Alumni.');
            }

            abort(403, 'Akses Ditolak: Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
