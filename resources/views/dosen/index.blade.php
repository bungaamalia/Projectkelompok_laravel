@extends('layouts.app')
<<<<<<< HEAD

@section('page-title', 'Data Dosen')

@section('content')
<div class="card p-4 border-0 shadow-sm">
    <h4>Data Dosen Pengampu</h4>
    <p class="text-muted small">Daftar dosen pengampu di Universitas Cahaya Surya</p>
    <table class="table table-hover mt-3">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama Dosen</th>
                <th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>19880101</td>
                <td>Isa Mulia Insan, S.Kom., M.Kom.</td>
                <td>Teknik Informatika</td>
            </tr>
            <tr>
                <td>2</td>
                <td>19890202</td>
                <td>Budi Santoso, M.T.</td>
                <td>Teknik Informatika</td>
            </tr>
        </tbody>
    </table>
=======
@section('title', 'Data Dosen')
@section('heading', 'Data Dosen')
@section('content')
<div class="card p-3">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
        <form method="GET" class="d-flex gap-2">
            <input name="keyword" class="form-control" placeholder="Cari dosen..." value="{{ $keyword }}">
            <button class="btn btn-primary">Cari</button>
        </form>
        <a href="{{ route('dosen.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead><tr><th>NIDN</th><th>Nama Dosen</th><th>Program Studi</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse($dosen as $item)
                <tr>
                    <td>{{ $item->nidn }}</td>
                    <td>{{ $item->user->name ?? $item->nama_lengkap }}</td>
                    <td>{{ $item->program_studi }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('dosen.edit', $item->nidn) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('dosen.destroy', $item->nidn) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Data dosen tidak ditemukan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
</div>
@endsection