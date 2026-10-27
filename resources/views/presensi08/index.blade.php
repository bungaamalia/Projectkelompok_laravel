@extends('layouts.app')
@section('title', 'Riwayat Presensi')
@section('heading', 'Riwayat Presensi')
@section('content')

<div class="row g-3 mb-4">
    @foreach(['Hadir','Izin','Sakit','Alpha'] as $s)
        <div class="col-6 col-lg-3">
            <div class="card p-3">
                <div class="text-muted">{{ $s }}</div>
                <h3 class="fw-bold mb-0">{{ $counts[$s] ?? 0 }}</h3>
            </div>
        </div>
    @endforeach
</div>

<div class="card p-3">
    <form method="GET" action="{{ route('presensi08.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input name="keyword" class="form-control" placeholder="Cari nama atau NIM" value="{{ $keyword }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                @foreach(['Hadir','Izin','Sakit','Alpha'] as $s)
                    <option value="{{ $s }}" @selected($status === $s)>{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="matkul" class="form-select">
                <option value="">Semua Mata Kuliah</option>
                @foreach($matkulList as $m)
                    <option value="{{ $m }}" @selected($matkul === $m)>{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <p class="text-muted">Kehadiran pada hasil filter: {{ $persentase }}%</p>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr><th>Tanggal</th><th>NIM</th><th>Nama</th><th>Mata Kuliah</th><th>Waktu</th><th>Status</th><th>Perbarui Status</th></tr>
            </thead>
            <tbody>
            @forelse($riwayatMahasiswa as $item)
                <tr>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['nim'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['matkul'] }}</td>
                    <td>{{ $item['waktu'] }}</td>
                    <td>{{ $item['status'] }}</td>
                    <td>
                        @if(in_array($role, ['Admin','Dosen']))
                            <form method="POST" action="{{ route('presensi08.updateStatus', $item['id']) }}">
                                @csrf
                                <select name="status" class="form-select form-select-sm mb-2">
                                    @foreach(['Hadir','Izin','Sakit','Alpha'] as $s)
                                        <option value="{{ $s }}" @selected($item['status'] === $s)>{{ $s }}</option>
                                    @endforeach
                                </select>
                                <input name="alasan" class="form-control form-control-sm mb-2" placeholder="Alasan (opsional)" value="{{ $item['alasan'] }}">
                                <button class="btn btn-sm btn-primary">Simpan</button>
                            </form>
                        @else
                            <span class="text-muted">Hanya dapat dilihat</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Tidak ada riwayat yang cocok.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection