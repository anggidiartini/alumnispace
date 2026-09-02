<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminCrudController;
use App\Http\Controllers\DashboardController;

Route::get('/opening', function () {
    return view('opening.index');
})->name('opening');

Route::get('/landing', function () {
    return view('landing.index');
})->name('landing');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home.index');
})->name('home');

Route::get('/alumni', function () {
    return view('alumni.index');
})->name('alumni');

Route::get('/alumni/detail', function () {
    return view('alumni.detail');
})->name('alumni.detail');

Route::get('/lowongan', function () {
    return view('lowongan.index');
})->name('lowongan');

Route::get('/lowongan/detail/{slug}', function ($slug) {
    return view('lowongan.detail', ['slug' => $slug]);
})->name('lowongan.detail');

Route::get('/event', function () {
    return view('event.index');
})->name('event');

Route::get('/album', function () {
    return view('album.index');
})->name('album');

Route::get('/admin', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard');

// // ===== AUTH ROUTES (guest only) =====
// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
// });

// Route::post('/logout', [AuthController::class, 'logout'])
//     ->middleware('auth')
//     ->name('logout');

// // ===== ADMIN ROUTES (protected) =====
// Route::middleware('auth')->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/table/{table}', [DashboardController::class, 'showTable'])->name('table.show');

//     // Generic CRUD (Create, Update, Delete) untuk semua 12 tabel
//     Route::post('/table/{table}', [AdminCrudController::class, 'store'])->name('table.store');
//     Route::put('/table/{table}/{id}', [AdminCrudController::class, 'update'])->name('table.update');
//     Route::delete('/table/{table}/{id}', [AdminCrudController::class, 'destroy'])->name('table.destroy');
// });

