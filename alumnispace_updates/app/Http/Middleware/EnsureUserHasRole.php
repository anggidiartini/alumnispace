<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
                'email' => 'Silakan masuk dengan akun Administrator.',
            ]);
        }

        if (!in_array($user->role, $roles) || ($user->status ?? 'active') !== 'active') {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Forbidden. Anda tidak memiliki hak akses administrator.',
                ], Response::HTTP_FORBIDDEN);
            }

            abort(403, 'Akses Ditolak: Halaman ini hanya untuk Administrator.');
        }

        return $next($request);
    }
}
