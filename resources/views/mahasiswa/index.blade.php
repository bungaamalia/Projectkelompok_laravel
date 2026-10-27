@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('page-title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Data Mahasiswa</h1>
        <p class="text-muted small mb-0">Pengelolaan data mahasiswa Teknik Informatika</p>
    </div>
    
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
        + Tambah Mahasiswa
    </a>
</div>

<div class="card p-3 shadow-sm border-0 rounded-3">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="d-flex gap-2 w-100 style-search">
            <input name="keyword" class="form-control" placeholder="Cari NIM atau nama mahasiswa..." value="{{ $keyword ?? '' }}">
            <button type="submit" class="btn btn-primary px-4">Cari</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 140px;">NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th style="width: 120px;">Angkatan</th>
                    <th style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($mahasiswa as $item)
                <tr>
                    <td><span class="fw-bold">{{ $item->nim }}</span></td>
                    <td>{{ $item->user->name ?? $item->nama_lengkap ?? $item->nama }}</td>
                    <td>{{ $item->program_studi ?? $item->prodi ?? 'Teknik Informatika' }}</td>
                    <td>{{ $item->angkatan ?? '2024' }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('mahasiswa.edit', $item->nim) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                        <form method="POST" action="{{ route('mahasiswa.destroy', $item->nim) }}" class="d-inline" onsubmit="return confirm('Hapus data mahasiswa ini?')">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Data mahasiswa tidak ditemukan.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection