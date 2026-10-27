@extends('layouts.app')

@section('title', 'Jadwal Kuliah')
@section('page-title', 'Informasi Jadwal Perkuliahan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Jadwal Perkuliahan</h1>
        <p class="text-muted small">Daftar jadwal mengajar dan perkuliahan aktif</p>
    </div>
    
    <!-- Tombol Tambah Jadwal untuk Admin/Dosen -->
    @if(session('user.role') === 'Admin' || session('user.role') === 'Dosen')
    <div>
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
    </div>
    @endif
</div>

<div class="card p-3 shadow-sm border-0 rounded-3">
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Hari</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Waktu</th>
                    <th>Ruangan</th>
                    @if(session('user.role') === 'Admin' || session('user.role') === 'Dosen')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            @forelse($jadwal as $item)
                <tr>
                    <td><span class="badge bg-purple text-white">{{ $item->hari ?? '-' }}</span></td>
                    <td class="fw-bold">{{ $item->nama_mk ?? $item->mataKuliah->nama_mk ?? '-' }}</td>
                    <td>{{ $item->nama_dosen ?? $item->dosen->user->name ?? '-' }}</td>
                    <td>{{ $item->jam_mulai ?? '-' }} – {{ $item->jam_selesai ?? '-' }}</td>
                    <td>{{ $item->ruangan ?? '-' }}</td>
                    
                    @if(session('user.role') === 'Admin' || session('user.role') === 'Dosen')
                    <td class="text-nowrap">
                        <!-- Shortcut Buka Sesi Presensi untuk Dosen -->
                        <a href="{{ route('sesi.index', ['mk' => $item->nama_mk ?? $item->mataKuliah->nama_mk ?? '']) }}" class="btn btn-sm btn-info text-white me-1">
                            Kelola Sesi
                        </a>
                        
                        <a href="{{ route('jadwal.edit', $item->id_jadwal) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                        
                        <form method="POST" action="{{ route('jadwal.destroy', $item->id_jadwal) }}" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf 
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada jadwal kuliah.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection