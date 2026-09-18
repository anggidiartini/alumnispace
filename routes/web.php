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
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\User\CompanyController;
use App\Http\Controllers\User\ProfileController;
// Landing & Intro - redirected to /home
Route::redirect('/', '/home')->name('landing');
Route::redirect('/landing', '/home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
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



// Admin Protected Group
Route::prefix('admin')->middleware(['auth', 'role:admin,super_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [ContentManagementController::class, 'dashboard'])->name('dashboard');

    Route::get('/manage-admins', [TableController::class, 'indexAdmins'])->name('admins.index');
    Route::get('/manage-admins/create', [TableController::class, 'createAdmin'])->name('admins.create');
    Route::post('/manage-admins', [TableController::class, 'storeAdmin'])->name('admins.store');
    Route::get('/manage-admins/{id}/edit', [TableController::class, 'editAdmin'])->name('admins.edit');
    Route::put('/manage-admins/{id}', [TableController::class, 'updateAdmin'])->name('admins.update');
    Route::delete('/manage-admins/{id}', [TableController::class, 'destroyAdmin'])->name('admins.destroy');
    Route::patch('/manage-admins/{id}/toggle-status', [TableController::class, 'toggleAdminStatus'])->name('admins.toggle-status');

    Route::get('/committee-periods', [TableController::class, 'indexPeriods'])->name('committee-periods.index');
    Route::get('/committee-periods/create', [TableController::class, 'createPeriod'])->name('committee-periods.create');
    Route::post('/committee-periods', [TableController::class, 'storePeriod'])->name('committee-periods.store');
    Route::get('/committee-periods/{id}', [TableController::class, 'showPeriod'])->name('committee-periods.show');
    Route::get('/committee-periods/{id}/edit', [TableController::class, 'editPeriod'])->name('committee-periods.edit');
    Route::put('/committee-periods/{id}', [TableController::class, 'updatePeriod'])->name('committee-periods.update');
    Route::delete('/committee-periods/{id}', [TableController::class, 'destroyPeriod'])->name('committee-periods.destroy');

    Route::get('/table/{table_name}', [TableController::class, 'index'])->name('table.index');
    Route::get('/table/{table_name}/create', [TableController::class, 'create'])->name('table.create');
    Route::post('/table/{table_name}', [TableController::class, 'store'])->name('table.store');

    Route::get('/table/{table_name}/{id}', [TableController::class, 'show'])->name('table.show');

    Route::get('/table/{table_name}/{id}/edit', [TableController::class, 'edit'])->name('table.edit');
    Route::put('/table/{table_name}/{id}', [TableController::class, 'update'])->name('table.update');
    Route::delete('/table/{table_name}/{id}', [TableController::class, 'destroy'])->name('table.destroy');

    Route::get('/content', [ContentManagementController::class, 'index'])->name('content.index');
    Route::post('/content', [ContentManagementController::class, 'store'])->name('content.store');
    Route::put('/content/{id}', [ContentManagementController::class, 'update'])->name('content.update');
    Route::delete('/content/{id}', [ContentManagementController::class, 'destroy'])->name('content.destroy');
    Route::put('/settings', [ContentManagementController::class, 'updateSettings'])->name('settings.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
