@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')
@section('heading', 'Tambah Mahasiswa')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input name="nim" class="form-control" value="{{ old('nim') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input class="form-control" value="Teknik Informatika" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input name="angkatan" type="number" min="2000" max="2099" class="form-control" value="{{ old('angkatan', date('Y')) }}" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection