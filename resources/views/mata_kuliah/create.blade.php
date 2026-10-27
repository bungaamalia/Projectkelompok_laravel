@extends('layouts.app')
@section('title', 'Tambah Mata Kuliah')
@section('heading', 'Tambah Mata Kuliah')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('mata-kuliah.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Kode Mata Kuliah</label>
            <input name="kode_mk" class="form-control" value="{{ old('kode_mk') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input name="nama_mk" class="form-control" value="{{ old('nama_mk') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">SKS</label>
            <input name="sks" type="number" min="1" max="6" class="form-control" value="{{ old('sks', 3) }}" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection