@extends('layouts.app')
@section('title', 'Edit Mahasiswa')
@section('heading', 'Edit Mahasiswa')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input class="form-control" value="{{ $mahasiswa->nim }}" disabled>
            <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $mahasiswa->nama_lengkap) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input name="angkatan" type="number" class="form-control" value="{{ old('angkatan', $mahasiswa->angkatan) }}" required>
        </div>
        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection