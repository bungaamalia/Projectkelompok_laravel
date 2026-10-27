@extends('layouts.app')

@section('page-title', 'Informasi Jadwal Perkuliahan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Jadwal Perkuliahan (FR-005)</h1>
        <p class="text-muted small">Daftar jadwal mengajar dan perkuliahan aktif</p>
    </div>
    
    <!-- Filter Hari -->
    <div class="btn-group">
        <a href="{{ route('jadwal.index', ['hari' => 'semua']) }}" class="btn btn-outline-purple {{ $filterHari == 'semua' ? 'active' : '' }}">Semua Hari</a>
        <a href="{{ route('jadwal.index', ['hari' => 'Senin']) }}" class="btn btn-outline-purple {{ $filterHari == 'Senin' ? 'active' : '' }}">Senin (Hari Ini)</a>
        <a href="{{ route('jadwal.index', ['hari' => 'Selasa']) }}" class="btn btn-outline-purple {{ $filterHari == 'Selasa' ? 'active' : '' }}">Selasa</a>
        <a href="{{ route('jadwal.index', ['hari' => 'Rabu']) }}" class="btn btn-outline-purple {{ $filterHari == 'Rabu' ? 'active' : '' }}">Rabu</a>
    </div>
</div>

<div class="row">
    @forelse($jadwal as $j)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 h-100">
            <div class="card-header bg-purple text-white d-flex justify-content-between align-items-center p-3" style="background-color: var(--primary-purple);">
                <span class="badge bg-light text-dark fw-bold">{{ $j['kode_mk'] }}</span>
                <small><i class="fa-regular fa-clock me-1"></i> {{ $j['jam'] }}</small>
            </div>
            <div class="card-body p-4">
                <h5 class="fw-bold mb-2">{{ $j['nama_mk'] }}</h5>
                <p class="text-muted small mb-3"><i class="fa-solid fa-user-tie me-2"></i>{{ $j['dosen'] }}</p>
                <hr class="my-2">
                <div class="d-flex justify-content-between text-secondary small mt-3">
                    <span><i class="fa-solid fa-location-dot me-1"></i> {{ $j['ruangan'] }}</span>
                    <span><i class="fa-solid fa-users me-1"></i> Kelas {{ $j['kelas'] }}</span>
                </div>
            </div>
            
            <!-- Jika User adalah Dosen, tampilkan Shortcut Buka Sesi -->
            @if(session('user.role') === 'Dosen')
            <div class="card-footer bg-white border-0 p-3 pt-0">
                <a href="{{ route('sesi.index', ['mk' => $j['nama_mk']]) }}" class="btn btn-purple w-100 btn-sm py-2">
                    <i class="fa-solid fa-qrcode me-1"></i> Kelola Sesi Presensi
                </a>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <p class="text-muted">Tidak ada jadwal perkuliahan untuk hari yang dipilih.</p>
    </div>
    @endforelse
</div>
@endsection