<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SesiPresensiController;

// FR-001: Public Routes 
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proteksi Middleware (Hanya bisa diakses jika sudah login)
Route::middleware(['check.auth'])->group(function () {

    // Route untuk Tampilan Sidebar tambahan
    Route::get('/mahasiswa', function () {
        return view('mahasiswa.index');
    })->name('mahasiswa.index');

    Route::get('/dosen', function () {
        return view('dosen.index');
    })->name('dosen.index');

    Route::get('/matakuliah', function () {
        return view('matakuliah.index');
    })->name('matakuliah.index');

    // FR-002: Profil Pengguna & Manajemen User (Admin)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::post('/profile/store-user', [ProfileController::class, 'storeUser'])->name('profile.storeUser');

    // FR-005: Informasi Jadwal Perkuliahan
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

    // FR-006: Pengelolaan Sesi Presensi (Multi-Matkul)
    Route::get('/sesi-presensi', [SesiPresensiController::class, 'index'])->name('sesi.index');
    Route::post('/sesi-presensi/store', [SesiPresensiController::class, 'store'])->name('sesi.store');
    Route::post('/sesi-presensi/close/{id}', [SesiPresensiController::class, 'close'])->name('sesi.close'); // Menggunakan parameter {id} sesi
    Route::post('/sesi-presensi/submit', [SesiPresensiController::class, 'submitPresensi'])->name('sesi.submit');
});