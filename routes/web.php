
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SesiPresensiController;
use App\Http\Controllers\Presensi07Controller;
use App\Http\Controllers\Presensi08Controller;

Route::get('/', function () {
    return session()->has('user')
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('check.auth')->group(function () {

    Route::get('/dashboard', function () {
        $role = session('user.role');

        if ($role === 'Admin') {
            return redirect()->route('mahasiswa.index');
        }

        if ($role === 'Dosen') {
            return redirect()->route('sesi.index');
        }

        return redirect()->route('jadwal.index');
    })->name('dashboard');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.password');

    // Data akademik
    Route::resource('mahasiswa', MahasiswaController::class)
        ->except(['show']);

    Route::resource('dosen', DosenController::class)
        ->except(['show']);

    Route::resource('mata-kuliah', MataKuliahController::class)
        ->except(['show']);

    Route::resource('jadwal', JadwalController::class)
        ->except(['show']);

    Route::get('/matakuliah', function () {
        return redirect()->route('mata-kuliah.index');
    })->name('matakuliah.index');

    // Sesi presensi
    Route::get('/sesi-presensi', [SesiPresensiController::class, 'index'])
        ->name('sesi.index');

    Route::post('/sesi-presensi/store', [SesiPresensiController::class, 'store'])
        ->name('sesi.store');

    Route::post('/sesi-presensi/close/{id}', [SesiPresensiController::class, 'close'])
        ->name('sesi.close');

    Route::delete('/sesi-presensi/{id}', [SesiPresensiController::class, 'destroy'])
        ->name('sesi.destroy');

    // Pencatatan presensi FR-07
    Route::prefix('presensi')->name('presensi.')->group(function () {
        Route::get('/', [Presensi07Controller::class, 'index'])
            ->name('index');

        Route::post('/perbarui-token', [Presensi07Controller::class, 'perbaruiToken'])
            ->name('perbaruiToken');

        Route::post('/catat', [Presensi07Controller::class, 'catatPresensi'])
            ->name('catat');

        Route::get('/detail/{id}', [Presensi07Controller::class, 'show'])
            ->name('show');
    });

    // Riwayat presensi FR-08
    Route::prefix('riwayat-presensi')->name('presensi08.')->group(function () {
        Route::get('/', [Presensi08Controller::class, 'index'])
            ->name('index');

        Route::post('/{id}/status', [Presensi08Controller::class, 'updateStatus'])
            ->name('updateStatus');
    });
});
