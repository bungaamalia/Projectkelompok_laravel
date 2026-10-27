
@extends('layouts.app')

@section('title', 'Pencatatan Presensi')
@section('topbar-title', 'Pencatatan Presensi')

@section('content')
@php
    $tab = request()->query('tab', 'qr');

    if (!in_array($tab, ['qr', 'pin', 'lokasi'])) {
        $tab = 'qr';
    }
@endphp

<div class="container-fluid py-3">
    <h3 class="fw-bold">Pencatatan Presensi</h3>
    <p class="text-muted">FR-07 · Presensi menggunakan QR Code, PIN, dan lokasi.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @if(in_array($role, ['Admin', 'Dosen']))
        <div class="card mb-4">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <div class="text-muted small">TOKEN PRESENSI AKTIF</div>
                    <h3 class="fw-bold text-primary mb-1">{{ $token }}</h3>
                    <small class="text-muted">Bagikan kode kepada mahasiswa untuk simulasi presensi.</small>
                </div>

                <form method="POST" action="{{ route('presensi.perbaruiToken') }}">
                    @csrf
                    <button class="btn btn-purple" type="submit">
                        <i class="fa-solid fa-rotate"></i> Buat Token Baru
                    </button>
                </form>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Metode Presensi</h5>

            <ul class="nav nav-pills nav-fill gap-2 mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ $tab === 'qr' ? 'active' : '' }}"
                       href="{{ route('presensi.index', ['tab' => 'qr']) }}">
                        <i class="fa-solid fa-qrcode"></i> Scan QR
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab === 'pin' ? 'active' : '' }}"
                       href="{{ route('presensi.index', ['tab' => 'pin']) }}">
                        <i class="fa-solid fa-key"></i> PIN
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab === 'lokasi' ? 'active' : '' }}"
                       href="{{ route('presensi.index', ['tab' => 'lokasi']) }}">
                        <i class="fa-solid fa-location-dot"></i> Lokasi
                    </a>
                </li>
            </ul>

            @if($role === 'Mahasiswa')

                @if($tab === 'qr')
                    <div class="text-center py-3">
                        <div class="text-primary mb-3">
                            <i class="fa-solid fa-qrcode fa-3x"></i>
                        </div>

                        <h5>Presensi dengan QR Code</h5>
                        <p class="text-muted">
                            Masukkan token sesi yang diberikan dosen untuk simulasi presensi QR.
                        </p>

                        <div class="d-flex justify-content-center my-3">
                            <div id="qr-preview" class="p-3 bg-white border rounded"></div>
                        </div>

                        <div class="text-muted small mb-3">
                            QR demo berisi token sesi saat ini. Pemindaian kamera belum diaktifkan.
                        </div>
                    </div>
                @elseif($tab === 'pin')
                    <div class="text-center py-4">
                        <i class="fa-solid fa-key fa-3x text-primary mb-3"></i>
                        <h5>Presensi dengan PIN</h5>
                        <p class="text-muted">
                            Masukkan PIN atau token yang diberikan dosen.
                        </p>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fa-solid fa-location-dot fa-3x text-primary mb-3"></i>
                        <h5>Presensi berdasarkan Lokasi</h5>
                        <p class="text-muted">
                            Izinkan akses lokasi pada browser untuk melihat koordinat perangkatmu.
                        </p>

                        <button type="button" class="btn btn-outline-primary"
                                onclick="ambilLokasi()">
                            <i class="fa-solid fa-location-crosshairs"></i>
                            Periksa Lokasi Saya
                        </button>

                        <div id="hasil-lokasi" class="mt-3 text-muted small">
                            Lokasi belum diperiksa.
                        </div>

                        <div class="alert alert-warning text-start mt-3 mb-0">
                            <strong>Catatan demo:</strong> fitur ini membaca koordinat browser.
                            Belum ada verifikasi jarak terhadap lokasi kampus di server.
                        </div>
                    </div>
                @endif

                <hr>

                <form method="POST" action="{{ route('presensi.catat') }}">
                    @csrf

                    <input type="hidden" name="metode"
                           value="{{ $tab === 'qr' ? 'QR Code' : ($tab === 'pin' ? 'PIN' : 'Lokasi') }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            {{ $tab === 'pin' ? 'Masukkan PIN' : 'Token Presensi' }}
                        </label>

                        <input type="text" name="token" class="form-control"
                               placeholder="Masukkan token dari dosen"
                               value="{{ old('token') }}" required>
                    </div>

                    <button type="submit" class="btn btn-purple w-100">
                        <i class="fa-solid fa-check"></i> Catat Presensi
                    </button>
                </form>

            @else
                <div class="text-center py-4">
                    @if($tab === 'qr')
                        <i class="fa-solid fa-qrcode fa-4x text-primary mb-3"></i>
                        <h5>QR Code Presensi</h5>
                        <p class="text-muted">QR dibuat dari token sesi presensi.</p>
                        <div class="d-flex justify-content-center">
                            <div id="qr-preview" class="p-3 bg-white border rounded"></div>
                        </div>
                    @elseif($tab === 'pin')
                        <i class="fa-solid fa-key fa-3x text-primary mb-3"></i>
                        <h5>PIN Presensi</h5>
                        <div class="display-6 fw-bold text-primary">{{ $token }}</div>
                        <p class="text-muted mt-2">Bagikan token ini kepada mahasiswa.</p>
                    @else
                        <i class="fa-solid fa-location-dot fa-3x text-primary mb-3"></i>
                        <h5>Metode Lokasi</h5>
                        <p class="text-muted">
                            Mahasiswa perlu mengizinkan akses lokasi melalui browser.
                        </p>
                        <div class="alert alert-warning text-start">
                            Verifikasi radius lokasi kampus belum diterapkan di server.
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold mb-3">
                {{ $role === 'Mahasiswa' ? 'Riwayat Presensi Saya' : 'Data Presensi Mahasiswa' }}
            </h5>

            <form method="GET" action="{{ route('presensi.index') }}"
                  class="row g-2 mb-3">
                <input type="hidden" name="tab" value="{{ $tab }}">

                <div class="col-md-6">
                    <input name="keyword" class="form-control"
                           value="{{ $keyword }}"
                           placeholder="Cari nama, NIM, atau mata kuliah">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua status</option>
                        @foreach(['Hadir', 'Izin', 'Sakit', 'Alpha'] as $s)
                            <option value="{{ $s }}" @selected($status === $s)>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-purple w-100" type="submit">
                        Cari
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Mata Kuliah</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Metode</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($presensi as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p['nim'] }}</td>
                                <td>{{ $p['nama'] }}</td>
                                <td>{{ $p['matkul'] }}</td>
                                <td>{{ $p['tanggal'] }}</td>
                                <td>{{ $p['waktu'] }}</td>
                                <td>{{ $p['metode'] }}</td>
                                <td>
                                    <span class="badge {{ $p['status'] === 'Hadir' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                        {{ $p['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada data presensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    const tokenPresensi = @json($token);

    document.addEventListener('DOMContentLoaded', function () {
        const qrElement = document.getElementById('qr-preview');

        if (qrElement && typeof QRCode !== 'undefined') {
            new QRCode(qrElement, {
                text: tokenPresensi,
                width: 180,
                height: 180
            });
        }
    });

    function ambilLokasi() {
        const hasil = document.getElementById('hasil-lokasi');

        if (!navigator.geolocation) {
            hasil.textContent = 'Browser tidak mendukung fitur lokasi.';
            return;
        }

        hasil.textContent = 'Meminta izin akses lokasi...';

        navigator.geolocation.getCurrentPosition(
            function (posisi) {
                hasil.innerHTML =
                    'Latitude: ' + posisi.coords.latitude +
                    '<br>Longitude: ' + posisi.coords.longitude +
                    '<br><span class="text-success">Koordinat berhasil dibaca.</span>';
            },
            function () {
                hasil.textContent =
                    'Lokasi gagal dibaca. Izinkan akses lokasi pada browser.';
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    }
</script>
@endsection
