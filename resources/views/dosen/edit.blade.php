@extends('layouts.app')
@section('title', 'Edit Dosen')
@section('heading', 'Edit Dosen')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('dosen.update', $dosen->nidn) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">NIDN</label>
            <input class="form-control" value="{{ $dosen->nidn }}" disabled>
            <input type="hidden" name="nidn" value="{{ $dosen->nidn }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $dosen->nama_lengkap) }}" required>
        </div>
        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection