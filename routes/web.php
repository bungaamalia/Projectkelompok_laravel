
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\SesiPresensiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\Presensi07Controller;
use App\Http\Controllers\Presensi08Controller;

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
