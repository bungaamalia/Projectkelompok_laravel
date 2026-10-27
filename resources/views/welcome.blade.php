@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-0">
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <p class="text-muted mb-0">
            Selamat datang, {{ session('user.nama', 'Pengguna') }}!
        </p>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-2">Sistem Informasi Presensi Mahasiswa</h5>
            <p class="text-muted mb-0">
                Sistem untuk mengelola jadwal perkuliahan, melakukan presensi,
                dan memantau riwayat kehadiran mahasiswa.
            </p>
        </div>
    </div>

    <div class="row g-3">
        @if(session('user.role') === 'Admin')
            <div class="col-md-6 col-xl-3">
                <a href="{{ route('mahasiswa.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-users fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Data Mahasiswa</h5>
                            <p class="text-muted mb-0">
                                Kelola data mahasiswa.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('dosen.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-chalkboard-user fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Data Dosen</h5>
                            <p class="text-muted mb-0">
                                Kelola data dosen.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('mata-kuliah.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-book fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Mata Kuliah</h5>
                            <p class="text-muted mb-0">
                                Kelola data mata kuliah.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('jadwal.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-calendar-days fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Jadwal Kuliah</h5>
                            <p class="text-muted mb-0">
                                Lihat dan kelola jadwal.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @elseif(session('user.role') === 'Dosen')
            <div class="col-md-6">
                <a href="{{ route('sesi-presensi.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-clipboard-check fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Sesi Presensi</h5>
                            <p class="text-muted mb-0">
                                Kelola sesi dan pantau kehadiran mahasiswa.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('riwayat-presensi.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-clock-rotate-left fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Riwayat Presensi</h5>
                            <p class="text-muted mb-0">
                                Periksa dan perbarui status kehadiran.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @else
            <div class="col-md-6">
                <a href="{{ route('jadwal.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-calendar-days fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Jadwal Kuliah</h5>
                            <p class="text-muted mb-0">
                                Lihat jadwal perkuliahan.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('presensi.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-clipboard-check fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Presensi</h5>
                            <p class="text-muted mb-0">
                                Lakukan presensi perkuliahan.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('riwayat-presensi.index') }}"
                   class="text-decoration-none text-dark">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fa-solid fa-clock-rotate-left fa-2x mb-3"
                               style="color:#6F42C1"></i>
                            <h5 class="fw-bold">Riwayat Presensi</h5>
                            <p class="text-muted mb-0">
                                Lihat riwayat kehadiran.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection