@extends('layouts.app')
@section('title', 'Data Mahasiswa')
@section('heading', 'Data Mahasiswa')
@section('content')
<div class="card p-3">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="d-flex gap-2">
            <input name="keyword" class="form-control" placeholder="Cari mahasiswa..." value="{{ $keyword }}">
            <button class="btn btn-primary">Cari</button>
        </form>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead><tr><th>NIM</th><th>Nama</th><th>Program Studi</th><th>Angkatan</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse($mahasiswa as $item)
                <tr>
                    <td>{{ $item->nim }}</td>
                    <td>{{ $item->user->name ?? $item->nama_lengkap }}</td>
                    <td>{{ $item->program_studi }}</td>
                    <td>{{ $item->angkatan }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('mahasiswa.edit', $item->nim) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('mahasiswa.destroy', $item->nim) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Data mahasiswa tidak ditemukan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection