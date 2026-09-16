<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisitLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VisitorStatsController extends Controller
{
    /**
     * Get 24-hour unique visitor stats for today with server-side caching.
     * Schema:
     * {
     *   "labels": ["00:00", ..., "23:00"],
     *   "data": [0, 2, ...],
     *   "max": 10
     * }
     */
    public function hourlyToday(): JsonResponse
    {
        // Cache result for 15 seconds to eliminate server load from high-frequency polling
        $stats = Cache::remember('visitor_stats_hourly_today', 15, function () {
            $todayStart = now()->startOfDay();
            $todayEnd = now()->endOfDay();

            // Index-backed range query without wrapping visited_at in WHERE functions
            $hourlyVisits = DB::table('visit_logs')
                ->whereBetween('visited_at', [$todayStart, $todayEnd])
                ->selectRaw('HOUR(visited_at) as hour, COUNT(DISTINCT visitor_id) as total')
                ->groupBy('hour')
                ->pluck('total', 'hour')
                ->all();

            $labels = [];
            $data = [];

            // Initialize all 24 hours (00:00 to 23:00) with 0
            for ($hour = 0; $hour < 24; $hour++) {
                $labels[] = sprintf('%02d:00', $hour);
                $data[] = (int) ($hourlyVisits[$hour] ?? 0);
            }

            $maxVal = count($data) > 0 ? max($data) : 0;
            // Ensure minimum max is 10 to avoid percentage division errors or unstable scaling
            $max = max(10, $maxVal);

            return [
                'labels' => $labels,
                'data'   => $data,
                'max'    => $max,
            ];
        });

        return response()->json($stats);
    }

    /**
     * Optional explicit endpoint to record a visit via client beacon or AJAX.
     */
    public function track(Request $request): JsonResponse
    {
        $visitorId = $request->input('visitor_id')
            ?? $request->cookie('visitor_id')
            ?? $request->header('X-Visitor-Id');

        if (!$visitorId) {
            $visitorId = (string) Str::uuid();
        }

        $currentHourKey = "visit_tracked:{$visitorId}:" . now()->format('Y-m-d-H');

        if (!Cache::has($currentHourKey)) {
            try {
                VisitLog::create([
                    'visitor_id' => $visitorId,
                    'url'        => Str::limit($request->input('url', $request->fullUrl()), 500),
                    'visited_at' => now(),
                    'ip_address' => $request->ip(),
                    'user_agent' => Str::limit($request->userAgent() ?? '', 500),
                ]);

                Cache::put($currentHourKey, true, now()->endOfHour()->addMinutes(2));
            } catch (\Throwable $e) {
                \Log::warning('Track API failed: ' . $e->getMessage());
            }
        }

        return response()->json([
            'status'     => 'success',
            'visitor_id' => $visitorId,
        ])->cookie(cookie('visitor_id', $visitorId, 60 * 24 * 365, '/', null, false, false));
    }
}
