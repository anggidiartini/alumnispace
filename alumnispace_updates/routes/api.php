<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicContentController;
use App\Http\Controllers\Admin\ContentManagementController;

// 1. Route Publik (Read-Only, Cached)
Route::prefix('v1/public')->group(function () {
    Route::get('/content/{page_slug}', [PublicContentController::class, 'getPageContent']);
    Route::get('/content/section/{section_key}', [PublicContentController::class, 'getSection']);
    Route::get('/settings', [PublicContentController::class, 'getPublicSettings']);
});

// 2. Route Protected Admin (REST API)
Route::prefix('v1/admin')->middleware(['auth:sanctum', 'role:admin,super_admin'])->group(function () {
    Route::get('/content', [ContentManagementController::class, 'index']);
    Route::post('/content', [ContentManagementController::class, 'store']);
    Route::put('/content/{id}', [ContentManagementController::class, 'update']);
    Route::delete('/content/{id}', [ContentManagementController::class, 'destroy']);
    Route::put('/settings', [ContentManagementController::class, 'updateSettings']);
});
