<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class PublicContentController extends Controller
{
    /**
     * Get all active content sections for a specific page.
     */
    public function getPageContent(string $page_slug): JsonResponse
    {
        $sections = Cache::remember("page_content_{$page_slug}", 1800, function () use ($page_slug) {
            return PageContent::where('page_slug', $page_slug)
                ->where('is_active', true)
                ->get()
                ->keyBy('section_key');
        });

        $settings = Cache::remember('public_site_settings', 1800, function () {
            return SiteSetting::where('is_public', true)
                ->pluck('value', 'key');
        });

        return response()->json([
            'status' => 'success',
            'page' => $page_slug,
            'sections' => $sections,
            'settings' => $settings,
        ]);
    }

    /**
     * Get a specific section content by section_key.
     */
    public function getSection(string $section_key): JsonResponse
    {
        $section = Cache::remember("section_{$section_key}", 1800, function () use ($section_key) {
            return PageContent::where('section_key', $section_key)
                ->where('is_active', true)
                ->first();
        });

        if (!$section) {
            return response()->json([
                'status' => 'error',
                'message' => "Seksi konten '{$section_key}' tidak ditemukan atau tidak aktif.",
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $section,
        ]);
    }

    /**
     * Get all public settings.
     */
    public function getPublicSettings(): JsonResponse
    {
        $settings = Cache::remember('public_site_settings', 1800, function () {
            return SiteSetting::where('is_public', true)
                ->pluck('value', 'key');
        });

        return response()->json([
            'status' => 'success',
            'settings' => $settings,
        ]);
    }
}
