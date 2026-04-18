<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\Pembimbing\DashboardController as PembimbingDashboardController;
use App\Http\Controllers\Pembimbing\PesertaController;
use App\Http\Controllers\Pembimbing\AbsensiController as PembimbingAbsensiController;
use App\Http\Controllers\Pembimbing\TugasController as PembimbingTugasController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Peserta\AbsensiController as PesertaAbsensiController;
use App\Http\Controllers\Peserta\TugasController as PesertaTugasController;
use App\Http\Controllers\Peserta\ProfilController;

// Redirect root to login
Route::get('/', fn() => redirect()->route('login'));

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ============ ADMIN ROUTES ============
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pembimbing', PembimbingController::class)->except(['show']);
});

// ============ PEMBIMBING ROUTES ============
Route::prefix('pembimbing')->middleware(['auth', 'role:pembimbing'])->name('pembimbing.')->group(function () {
    Route::get('/dashboard', [PembimbingDashboardController::class, 'index'])->name('dashboard');

    // CRUD Peserta
    Route::resource('peserta', PesertaController::class)->except(['show']);

    // Absensi
    Route::get('/absensi', [PembimbingAbsensiController::class, 'index'])->name('absensi.index');
    Route::put('/absensi/{absensi}/status', [PembimbingAbsensiController::class, 'updateStatus'])->name('absensi.updateStatus');
    Route::post('/absensi/manual', [PembimbingAbsensiController::class, 'tambahManual'])->name('absensi.manual');
    Route::get('/rekap', [PembimbingAbsensiController::class, 'rekap'])->name('rekap.index');

    // Tugas
    Route::resource('tugas', PembimbingTugasController::class)->parameters(['tugas' => 'tuga']);
    Route::put('/submission/{submission}/nilai', [PembimbingTugasController::class, 'nilaiSubmission'])->name('submission.nilai');
});

// ============ PESERTA ROUTES ============
Route::prefix('peserta')->middleware(['auth', 'role:peserta'])->name('peserta.')->group(function () {
    Route::get('/dashboard', [PesertaDashboardController::class, 'index'])->name('dashboard');

    // Absensi
    Route::get('/absensi', [PesertaAbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/clock-in', [PesertaAbsensiController::class, 'clockIn'])->name('absensi.clockIn');
    Route::post('/absensi/clock-out', [PesertaAbsensiController::class, 'clockOut'])->name('absensi.clockOut');

    // Tugas
    Route::get('/tugas', [PesertaTugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{tuga}', [PesertaTugasController::class, 'show'])->name('tugas.show');
    Route::post('/tugas/{tuga}/submit', [PesertaTugasController::class, 'submit'])->name('tugas.submit');

    // Profil (ubah password)
    Route::get('/profil/ubah-password', [ProfilController::class, 'ubahPassword'])->name('profil.ubahPassword');
    Route::put('/profil/ubah-password', [ProfilController::class, 'updatePassword'])->name('profil.updatePassword');
});
