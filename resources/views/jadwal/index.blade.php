@extends('layouts.app')
@section('title', 'Jadwal Kuliah')
@section('heading', 'Jadwal Kuliah')
@section('content')
<div class="card p-3">
    <div class="mb-3">
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Hari</th><th>Mata Kuliah</th><th>Dosen</th>
                    <th>Waktu</th><th>Ruangan</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($jadwal as $item)
                <tr>
                    <td>{{ $item->hari }}</td>
                    <td>{{ $item->nama_mk ?? $item->mataKuliah->nama_mk ?? '-' }}</td>
                    <td>{{ $item->nama_dosen ?? $item->dosen->user->name ?? '-' }}</td>
                    <td>{{ $item->jam_mulai }}–{{ $item->jam_selesai }}</td>
                    <td>{{ $item->ruangan }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('jadwal.edit', $item->id_jadwal) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="{{ route('jadwal.destroy', $item->id_jadwal) }}" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Belum ada jadwal kuliah.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection