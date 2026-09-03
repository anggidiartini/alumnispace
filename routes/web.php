<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlumniDirectoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ArticleController;

// Landing & Intro
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/landing', [LandingController::class, 'index']);
Route::get('/opening', function () {
    return view('opening.index');
})->name('opening');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Home / Dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Job Vacancies (Bursa Loker)
Route::get('/lowongan', [JobVacancyController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/{slug}', [JobVacancyController::class, 'show'])->name('lowongan.show');
Route::post('/lowongan/{id}/apply', [JobVacancyController::class, 'apply'])->name('lowongan.apply');

// Events & Gatherings
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.show');
Route::post('/event/{id}/register', [EventController::class, 'register'])->name('event.register');

// Photo Albums & Memories
Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
Route::get('/album/{slug}', [AlbumController::class, 'show'])->name('album.show');

// Alumni Directory
Route::get('/alumni', [AlumniDirectoryController::class, 'index'])->name('alumni.index');
Route::get('/alumni/{id}', [AlumniDirectoryController::class, 'show'])->name('alumni.show');

// Artikel
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');


// Admin Protected Group
Route::prefix('admin')->middleware(['auth', 'role:admin,super_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    Route::get('/content', [\App\Http\Controllers\Admin\ContentManagementController::class, 'index'])->name('content.index');
    Route::post('/content', [\App\Http\Controllers\Admin\ContentManagementController::class, 'store'])->name('content.store');
    Route::put('/content/{id}', [\App\Http\Controllers\Admin\ContentManagementController::class, 'update'])->name('content.update');
    Route::delete('/content/{id}', [\App\Http\Controllers\Admin\ContentManagementController::class, 'destroy'])->name('content.destroy');
    Route::put('/settings', [\App\Http\Controllers\Admin\ContentManagementController::class, 'updateSettings'])->name('settings.update');


});
