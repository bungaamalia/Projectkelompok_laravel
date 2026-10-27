@extends('layouts.app')
@section('title', 'Tambah Dosen')
@section('heading', 'Tambah Dosen')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('dosen.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">NIDN</label>
            <input name="nidn" class="form-control" value="{{ old('nidn') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection