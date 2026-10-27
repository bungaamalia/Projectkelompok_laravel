@extends('layouts.app')
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
</div>
@endsection