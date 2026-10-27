@extends('layouts.app')
<<<<<<< HEAD

@section('page-title', 'Data Mahasiswa')

@section('content')
<style>
    .page-header-title { font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin-bottom: 2px; }
    .page-header-subtitle { color: #707070; font-size: 0.9rem; margin-bottom: 24px; }
    .card-custom { background: #ffffff; border-radius: 12px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.03); padding: 24px; }
    .search-input-group { border-radius: 6px; overflow: hidden; border: 1px solid #e0e0e0; }
    .search-input-group input { border: none; padding: 10px 16px; font-size: 0.9rem; }
    .search-input-group input:focus { box-shadow: none; }
    .btn-search { background-color: var(--primary-purple); color: white; border: none; padding: 0 20px; font-size: 0.9rem; display: flex; align-items: center; gap: 6px; }
    .btn-search:hover { background-color: var(--hover-purple); color: white; }
    .table-custom { margin-bottom: 0; border-collapse: separate; border-spacing: 0; }
    .table-custom thead th { background-color: var(--primary-purple); color: #ffffff; font-weight: 600; font-size: 0.9rem; padding: 12px 16px; border: none; }
    .table-custom thead th:first-child { border-top-left-radius: 6px; }
    .table-custom thead th:last-child { border-top-right-radius: 6px; }
    .table-custom tbody tr td { padding: 14px 16px; font-size: 0.9rem; color: #333333; vertical-align: middle; border-bottom: 1px solid #f0f0f0; }
    .table-custom tbody tr:nth-child(even) { background-color: #f9f9fc; }
    .btn-action-edit { background-color: #ffc107; color: #ffffff; border: none; width: 28px; height: 28px; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem; }
    .btn-action-delete { background-color: #dc3545; color: #ffffff; border: none; width: 28px; height: 28px; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem; }
</style>

<div class="d-flex justify-content-between align-items-start mb-2">
    <div>
        <h1 class="page-header-title">Data Mahasiswa</h1>
        <p class="page-header-subtitle">Pengelolaan data mahasiswa Teknik Informatika</p>
    </div>
    <button class="btn btn-purple">
        <i class="fa-solid fa-plus me-1"></i> Tambah Mahasiswa
    </button>
</div>

<div class="card-custom">
    <div class="row mb-4">
        <div class="col-12">
            <div class="input-group search-input-group">
                <input type="text" class="form-control" placeholder="Cari NIM atau nama...">
                <button class="btn btn-search" type="button">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari
                </button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th style="width: 140px;">NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th style="width: 120px;">Angkatan</th>
                    <th style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>24100001</td>
                    <td><b>Bunga Amalia K.</b></td>
                    <td>Teknik Informatika</td>
                    <td>2024</td>
                    <td>
                        <button class="btn-action-edit"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn-action-delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>24100003</td>
                    <td><b>Enrio Putra Y.</b></td>
                    <td>Teknik Informatika</td>
                    <td>2024</td>
                    <td>
                        <button class="btn-action-edit"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn-action-delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>24100004</td>
                    <td><b>Frandica Galih K.</b></td>
                    <td>Teknik Informatika</td>
                    <td>2024</td>
                    <td>
                        <button class="btn-action-edit"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn-action-delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>24100005</td>
                    <td><b>Frida Putri Eka A. I.</b></td>
                    <td>Teknik Informatika</td>
                    <td>2024</td>
                    <td>
                        <button class="btn-action-edit"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn-action-delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>24100006</td>
                    <td><b>Ilham Januar Putra</b></td>
                    <td>Teknik Informatika</td>
                    <td>2024</td>
                    <td>
                        <button class="btn-action-edit"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn-action-delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
=======
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
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
            </tbody>
        </table>
    </div>
</div>
@endsection