<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LandingController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\JobVacancyController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\AlbumController;
use App\Http\Controllers\User\AlumniDirectoryController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\CompanyController;
use App\Http\Controllers\User\ProfileController;
// Landing & Intro
// Landing & Intro - redirected to /home
Route::redirect('/', '/home')->name('landing');
Route::redirect('/landing', '/home');
Route::get('/opening', function () {
    return view('opening.index');
})->name('opening');

use App\Http\Controllers\User\PasswordResetController;

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/admin-login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']); // Tambahan untuk memudahkan paksa logout dari URL

// Password Reset
Route::get('/forgot-password', [PasswordResetController::class, 'request'])->name('password.request');
Route::post('/reset-password', [PasswordResetController::class, 'updatePassword'])->name('password.update');

// User Protected Group
Route::middleware(['auth', 'role:alumni,user,admin,super_admin'])->group(function () {
    // Authenticated Home / Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Job Vacancies Apply
    Route::post('/lowongan/{id}/apply', [JobVacancyController::class, 'apply'])->name('lowongan.apply');

    // Events Register
    Route::match(['get', 'post'], '/event/{id}/register', [EventController::class, 'register'])->name('event.register');

    // Profile Saya (Setting Profile Alumni)
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.settings');
    Route::put('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
});

// Job Vacancies (Bursa Loker)
Route::get('/lowongan', [JobVacancyController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/{slug}', [JobVacancyController::class, 'show'])->name('lowongan.show');
Route::get('/perusahaan/{slug}', [\App\Http\Controllers\User\CompanyController::class, 'index'])->name('perusahaan.index');

// Events & Gatherings
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('event.show');

// Photo Albums & Memories
Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
Route::get('/album/{slug}', [AlbumController::class, 'show'])->name('album.show');

// Alumni Directory
Route::get('/alumni', [AlumniDirectoryController::class, 'index'])->name('alumni.index');
Route::get('/alumni/{slug}', [AlumniDirectoryController::class, 'show'])->name('alumni.show');

//Articles
Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('artikel.show');



// Admin routes are kept in their own module while using this file as the web entry point.
require __DIR__.'/admin.php';
