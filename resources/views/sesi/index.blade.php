@extends('layouts.app')
@section('title', 'Sesi Presensi')
@section('heading', 'Sesi Presensi')
@section('content')
<div class="row g-3">
    <div class="col-lg-5">
        <div class="card p-4">
            <h5 class="fw-bold mb-3">Buat Sesi Baru</h5>
            <form method="POST" action="{{ route('sesi.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Mata Kuliah</label>
                    <select name="nama_mk" class="form-select" required>
                        <option value="">Pilih mata kuliah</option>
                        <option>Algoritma dan Pemrograman</option>
                        <option>Basis Data</option>
                        <option>Pemrograman Web</option>
                        <option>Struktur Data</option>
                        <option>Jaringan Komputer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pertemuan ke-</label>
                    <input type="number" name="pertemuan_ke" class="form-control" min="1" max="20" required>
                </div>
                <button class="btn btn-primary">Buat Sesi</button>
            </form>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card p-4">
            <h5 class="fw-bold">Sesi Aktif</h5>
            @if($sesi_aktif)
                <p class="mb-1">{{ $sesi_aktif['nama_mk'] }}</p>
                <p class="text-muted">Pertemuan {{ $sesi_aktif['pertemuan_ke'] }}</p>
                <div class="alert alert-success">
                    Token presensi: <strong>{{ $sesi_aktif['token_pin'] }}</strong>
                </div>
                <form method="POST" action="{{ route('sesi.close', $sesi_aktif['id_sesi']) }}">
                    @csrf
                    <button class="btn btn-danger">Tutup Sesi</button>
                </form>
            @else
                <p>Belum ada sesi aktif.</p>
            @endif
        </div>
    </div>
</div>

<div class="card p-3 mt-4">
    <h5 class="fw-bold mb-3">Daftar Sesi</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr><th>Mata Kuliah</th><th>Pertemuan</th><th>Tanggal</th><th>Token</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($sesi as $item)
                <tr>
                    <td>{{ $item['nama_mk'] }}</td>
                    <td>{{ $item['pertemuan_ke'] }}</td>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['token_pin'] }}</td>
                    <td>{{ $item['status'] }}</td>
                    <td>
                        <form method="POST" action="{{ route('sesi.destroy', $item['id_sesi']) }}" onsubmit="return confirm('Hapus sesi ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada sesi.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection