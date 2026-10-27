@extends('layouts.app')
@section('title', 'Mata Kuliah')
@section('heading', 'Data Mata Kuliah')
@section('content')
<div class="card p-3">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
        <form method="GET" class="d-flex gap-2">
            <input name="keyword" class="form-control" placeholder="Cari mata kuliah..." value="{{ $keyword }}">
            <button class="btn btn-primary">Cari</button>
        </form>
        <a href="{{ route('mata-kuliah.create') }}" class="btn btn-primary">+ Tambah Mata Kuliah</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead><tr><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse($mataKuliah as $item)
                <tr>
                    <td>{{ $item->kode_mk }}</td>
                    <td>{{ $item->nama_mk }}</td>
                    <td>{{ $item->sks }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('mata-kuliah.edit', $item->kode_mk) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('mata-kuliah.destroy', $item->kode_mk) }}" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Data mata kuliah tidak ditemukan.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection