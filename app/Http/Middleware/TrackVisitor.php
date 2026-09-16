<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Models\VisitLog;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track guest / unauthenticated visits on web GET page requests
        if (
            !$request->isMethod('GET') ||
            $request->is('api/*', 'admin/*', 'up', '_debugbar/*', 'sanctum/*') ||
            $request->ajax() ||
            $request->wantsJson() ||
            auth()->check()
        ) {
            return $next($request);
        }

        // Get visitor_id from cookie, header, or generate new UUID v4
        $visitorId = $request->cookie('visitor_id')
            ?? $request->header('X-Visitor-Id')
            ?? (string) Str::uuid();

        // Anti-flooding & unique visitor per hour safeguard using cache
        $currentHourKey = "visit_tracked:{$visitorId}:" . now()->format('Y-m-d-H');

        if (!Cache::has($currentHourKey)) {
            try {
                VisitLog::create([
                    'visitor_id' => $visitorId,
                    'url' => Str::limit($request->fullUrl(), 500),
                    'visited_at' => now(),
                    'ip_address' => $request->ip(),
                    'user_agent' => Str::limit($request->userAgent() ?? '', 500),
                ]);

                // Cache until the end of current hour (+ 2 minutes buffer)
                Cache::put($currentHourKey, true, now()->endOfHour()->addMinutes(2));
            } catch (\Throwable $e) {
                // Fail gracefully so tracking issues never disrupt normal user experience
                \Log::warning('TrackVisitor recording failed: ' . $e->getMessage());
            }
        }

        $response = $next($request);

        // Attach cookie for 1 year (httpOnly=false allows sync with localStorage)
        if (method_exists($response, 'withCookie')) {
            $response->withCookie(cookie('visitor_id', $visitorId, 60 * 24 * 365, '/', null, false, false));
        }

        return $response;
    }
}
