<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\Articles\ArticleController;
use App\Http\Controllers\Admin\Events\EventController;
use App\Http\Controllers\Admin\Albums\AlbumController;
use App\Http\Controllers\Admin\AlumniBoards\AlumniBoardController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Admin\Alumnis\AlumniController;
use App\Http\Controllers\Admin\JobVacancies\JobVacancyController;
use App\Http\Controllers\Admin\Galleries\GalleryController;
use App\Http\Controllers\Admin\Admins\AdminController;
use App\Http\Controllers\Admin\Periods\PeriodController;

Route::prefix('admin')->middleware(['auth', 'role:admin,super_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [ContentManagementController::class, 'dashboard'])->name('dashboard');

    Route::get('/committee-periods', [PeriodController::class, 'index'])->name('committee-periods.index');
    Route::get('/committee-periods/create', [PeriodController::class, 'create'])->name('committee-periods.create');
    Route::post('/committee-periods', [PeriodController::class, 'store'])->name('committee-periods.store');
    Route::get('/committee-periods/{id}', [PeriodController::class, 'show'])->name('committee-periods.show');
    Route::get('/committee-periods/{id}/edit', [PeriodController::class, 'edit'])->name('committee-periods.edit');
    Route::put('/committee-periods/{id}', [PeriodController::class, 'update'])->name('committee-periods.update');
    Route::delete('/committee-periods/{id}', [PeriodController::class, 'destroy'])->name('committee-periods.destroy');

    Route::get('/manage-admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/manage-admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/manage-admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/manage-admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/manage-admins/{id}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/manage-admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
    Route::patch('/manage-admins/{id}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admins.toggle-status');

    Route::get('/alumnis', [AlumniController::class, 'index'])->name('alumnis.index');
    Route::get('/alumnis/create', [AlumniController::class, 'create'])->name('alumnis.create');
    Route::post('/alumnis', [AlumniController::class, 'store'])->name('alumnis.store');
    Route::get('/alumnis/export', [AlumniController::class, 'export'])->name('alumnis.export');
    Route::post('/alumnis/import', [AlumniController::class, 'import'])->name('alumnis.import');
    Route::get('/alumnis/{id}', [AlumniController::class, 'show'])->name('alumnis.show');
    Route::get('/alumnis/{id}/edit', [AlumniController::class, 'edit'])->name('alumnis.edit');
    Route::put('/alumnis/{id}', [AlumniController::class, 'update'])->name('alumnis.update');
    Route::delete('/alumnis/{id}', [AlumniController::class, 'destroy'])->name('alumnis.destroy');

    Route::get('/job-vacancies', [JobVacancyController::class, 'index'])->name('job-vacancies.index');
    Route::get('/job-vacancies/create', [JobVacancyController::class, 'create'])->name('job-vacancies.create');
    Route::post('/job-vacancies', [JobVacancyController::class, 'store'])->name('job-vacancies.store');
    Route::get('/job-vacancies/export', [JobVacancyController::class, 'export'])->name('job-vacancies.export');
    Route::get('/job-vacancies/{id}/export-applications', [JobVacancyController::class, 'exportApplications'])->name('job-vacancies.export-applications');
    Route::get('/job-vacancies/{id}', [JobVacancyController::class, 'show'])->name('job-vacancies.show');
    Route::get('/job-vacancies/{id}/edit', [JobVacancyController::class, 'edit'])->name('job-vacancies.edit');
    Route::put('/job-vacancies/{id}', [JobVacancyController::class, 'update'])->name('job-vacancies.update');
    Route::delete('/job-vacancies/{id}', [JobVacancyController::class, 'destroy'])->name('job-vacancies.destroy');

    Route::get('/alumni-boards', [AlumniBoardController::class, 'index'])->name('alumni-boards.index');
    Route::get('/alumni-boards/create', [AlumniBoardController::class, 'create'])->name('alumni-boards.create');
    Route::post('/alumni-boards', [AlumniBoardController::class, 'store'])->name('alumni-boards.store');
    Route::get('/alumni-boards/{id}', [AlumniBoardController::class, 'show'])->name('alumni-boards.show');
    Route::get('/alumni-boards/{id}/edit', [AlumniBoardController::class, 'edit'])->name('alumni-boards.edit');
    Route::put('/alumni-boards/{id}', [AlumniBoardController::class, 'update'])->name('alumni-boards.update');
    Route::delete('/alumni-boards/{id}', [AlumniBoardController::class, 'destroy'])->name('alumni-boards.destroy');

    // Events module uses its dedicated controller and views.
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/export', [EventController::class, 'export'])->name('events.export');
    Route::get('/events/{id}/export-registrations', [EventController::class, 'exportRegistrations'])->name('events.export-registrations');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    // Articles module uses its dedicated controller and views.
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Albums module uses its dedicated controller and views.
    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/albums/{id}', [AlbumController::class, 'show'])->name('albums.show');
    Route::get('/albums/{id}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{id}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/albums/{id}', [AlbumController::class, 'destroy'])->name('albums.destroy');

    Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/galleries/{id}', [GalleryController::class, 'show'])->name('galleries.show');
    Route::get('/galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');



    Route::get('/content', [ContentManagementController::class, 'index'])->name('content.index');
    Route::post('/content', [ContentManagementController::class, 'store'])->name('content.store');
    Route::put('/content/{id}', [ContentManagementController::class, 'update'])->name('content.update');
    Route::delete('/content/{id}', [ContentManagementController::class, 'destroy'])->name('content.destroy');
    Route::put('/settings', [ContentManagementController::class, 'updateSettings'])->name('settings.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
