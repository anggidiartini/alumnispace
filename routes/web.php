    <?php

<<<<<<< HEAD
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

    Route::get('/lowongan/detail/{slug}', function ($slug) {
        return view('lowongan.detail', ['slug' => $slug]);
    });

    Route::get('/event', function () {
        return view('event.index');
    });

    Route::get('/album', function () {
        return view('album.index');
    });

    Route::get('/artikel', function () {
        return view('artikel.index');
    });

    Route::get('/admin', function () {
        return view('admin.dashboard.index');
    });
=======
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminCrudController;
use App\Http\Controllers\DashboardController;
=======
use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlumniDirectoryController;
use App\Http\Controllers\AuthController;
<<<<<<< HEAD
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
=======
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\CompanyController;
>>>>>>> test-admin

// Landing & Intro
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/landing', [LandingController::class, 'index']);
Route::get('/opening', function () {
    return view('opening.index');
})->name('opening');

<<<<<<< HEAD
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

=======
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
Route::get('/perusahaan/{slug}', [\App\Http\Controllers\CompanyController::class, 'index'])->name('perusahaan.index');

// Events & Gatherings
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::match(['get', 'post'], '/event/{id}/register', [EventController::class, 'register'])->name('event.register');
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
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard', [ContentManagementController::class, 'dashboard'])->name('dashboard');

    Route::get('/table/{table_name}', [TableController::class, 'index'])->name('table.index');
    Route::get('/table/{table_name}/create', [TableController::class, 'create'])->name('table.create');
    Route::post('/table/{table_name}', [TableController::class, 'store'])->name('table.store');
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
>>>>>>> a185f3c9136af7b5ed12841a6e4573d7d7609776
>>>>>>> 255644a6abfc8bcbeec192ab8d3c04ab31a5e94a
