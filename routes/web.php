<?php

use Illuminate\Support\Facades\Route;

Route::get('/opening', function () {
    return view('opening.index');
});

Route::get('/landing', function () {
    return view('landing.index');
});

Route::get('/login', function () {
    return view('auth.login'); // Sesuaikan dengan folder resources/views/auth/login.blade.php
})->name('login');

Route::get('/home', function () {
    return view('home.index');
});

Route::get('/alumni', function () {
    return view('alumni.index');
});

Route::get('/alumni/detail', function () {
    return view('alumni.detail');
});

Route::get('/lowongan', function () {
    return view('lowongan.index');
});

Route::get('/event', function () {
    return view('event.index');
});

Route::get('/album', function () {
    return view('album.index');
});

Route::get('/admin', function () {
    return view('admin.dashboard.index');
});
