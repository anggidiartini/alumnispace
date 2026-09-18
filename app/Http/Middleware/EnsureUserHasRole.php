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

            if (in_array('admin', $roles) || in_array('super_admin', $roles)) {
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Silakan masuk dengan akun Administrator.',
                ]);
            }

            return redirect()->route('login')->withErrors([
                'email' => 'Silakan masuk terlebih dahulu.',
            ]);
        }

        if (!$user->is_active) {
            Auth::logout();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
                ], Response::HTTP_FORBIDDEN);
            }

            return redirect()->route('admin.login')->withErrors([
                'email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
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

            if (in_array('admin', $roles) || in_array('super_admin', $roles)) {
                abort(403, 'Akses Ditolak: Halaman ini hanya untuk Administrator.');
            }

            abort(403, 'Akses Ditolak: Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
