<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RespondenController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GrafikController;
use App\Http\Controllers\Admin\SurveyController as AdminSurveyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::prefix('admin')->name('admin.')->group(function () {
    // pakai controller admin
    Route::resource('surveys', \App\Http\Controllers\Admin\SurveyController::class);

    // route toggle juga pakai controller admin
    Route::patch('/surveys/{survey}/toggle', [\App\Http\Controllers\Admin\SurveyController::class, 'toggle'])
        ->name('surveys.toggle');
});





// ===================================================
// 🌐 HALAMAN UTAMA (Publik & Multi Admin)
// ===================================================

// Halaman utama publik (tanpa user_id)
Route::get('/', [HomeController::class, 'index'])->name('halaman.utama');

// Halaman utama survei per admin (multi admin)
Route::get('/survey/{user}', [SurveyController::class, 'halamanUtamaMultiAdmin'])
    ->name('halaman.utama.multi');

    // link survei unik berdasarkan ID admin
Route::get('/survey/{admin}', [SurveyController::class, 'showSurveyForm'])->name('survey.form');

Route::get('/admin/surveys/{survey}/remove-logo', [App\Http\Controllers\Admin\SurveyController::class, 'removeLogo'])
    ->name('admin.surveys.removeLogo');

// ===================================================
// 🧾 FORM DATA DIRI (Multi Admin & Publik)
// ===================================================

// 🔹 Multi Admin
Route::get('/survey/{user}/data-diri', [SurveyController::class, 'formDataDiriMulti'])
    ->name('data.diri.multi.form');
Route::post('/survey/{user}/data-diri', [SurveyController::class, 'simpanDataDiriMulti'])
    ->name('data.diri.multi');

// 🔹 Publik
Route::get('/data-diri', [SurveyController::class, 'formDataDiri'])->name('data.diri');
Route::post('/data-diri', [SurveyController::class, 'simpanDataDiri'])->name('data.diri.simpan');

// ===================================================
// 📝 FORM KUESIONER (Multi Admin & Publik)
// ===================================================

// 🔹 Multi Admin
Route::get('/survey/{user}/kuesioner', [SurveyController::class, 'formKuesionerMulti'])
    ->name('kuesioner.multi');
Route::post('/survey/{user}/kuesioner', [SurveyController::class, 'simpanKuesionerMulti'])
    ->name('kuesioner.simpan.multi');

// 🔹 Publik
Route::get('/kuesioner', [SurveyController::class, 'formKuesioner'])->name('kuesioner');
Route::post('/kuesioner', [SurveyController::class, 'simpanKuesioner'])->name('kuesioner.simpan');

// ===================================================
// 🔐 LOGIN
// ===================================================
Route::get('/login', fn() => view('auth.custom-login'))->name('login');

// ===================================================
// 🧩 REGISTER
// ===================================================

Route::get('register', fn() => view('auth.custom-register'))->name('register');
// Halaman register (GET)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// Proses register (POST)
Route::post('/register', [RegisteredUserController::class, 'store']);




// ===================================================
// 🧭 DASHBOARD
// ===================================================
Route::get('/dashboard/admin', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/admin/{slug}/dashboard', [DashboardController::class, 'personalDashboard'])
    ->middleware(['auth'])
    ->name('admin.personal.dashboard');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.personal.dashboard', ['slug' => auth()->user()->slug]);
    }
    return redirect()->route('dashboard.customer');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===================================================
// 📊 ADMIN PUBLIK
// ===================================================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/grafik/total', [GrafikController::class, 'total'])->name('admin.grafik.total');
    Route::post('/grafik/total/export-pdf', [GrafikController::class, 'exportPdf'])->name('admin.grafik.total.pdf');
});

// ===================================================
// 👤 PROFILE
// ===================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================================================
// ⚙️ ADMIN PANEL (GLOBAL)
// ===================================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('surveys', AdminSurveyController::class);
    Route::patch('surveys/{survey}/activate', [AdminSurveyController::class, 'activate'])->name('surveys.activate');

    Route::resource('questions', QuestionController::class);
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::post('categories/{category}/set-active', [CategoryController::class, 'setActive'])->name('categories.setActive');

    Route::get('/responden', [RespondenController::class, 'index'])->name('responden');
    Route::get('/responden/export-pdf', [RespondenController::class, 'exportPdf'])->name('responden.exportPdf');
});

// ===================================================
// 👥 ADMIN PERSONAL (MULTI ADMIN PANEL)
// ===================================================
Route::middleware(['auth'])->prefix('admin/{slug}')->name('admin.personal.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'personalDashboard'])->name('dashboard');

    Route::resource('surveys', AdminSurveyController::class);
    Route::patch('surveys/{survey}/activate', [AdminSurveyController::class, 'activate'])->name('surveys.activate');

    Route::resource('questions', QuestionController::class);
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::post('categories/{category}/set-active', [CategoryController::class, 'setActive'])->name('categories.setActive');

    Route::get('/responden', [RespondenController::class, 'index'])->name('responden');
    Route::get('/responden/export-pdf', [RespondenController::class, 'exportPdf'])->name('responden.exportPdf');

    Route::get('/grafik/total', [GrafikController::class, 'total'])->name('grafik.total');
    Route::post('/grafik/total/export-pdf', [GrafikController::class, 'exportPdf'])->name('grafik.total.pdf');
});

// ===================================================
// 🔒 AUTH
// ===================================================
require __DIR__ . '/auth.php';
