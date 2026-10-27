@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')
@section('heading', 'Edit Mata Kuliah')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('mata-kuliah.update', $mataKuliah->kode_mk) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Kode Mata Kuliah</label>
            <input class="form-control" value="{{ $mataKuliah->kode_mk }}" disabled>
            <input type="hidden" name="kode_mk" value="{{ $mataKuliah->kode_mk }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input name="nama_mk" class="form-control" value="{{ old('nama_mk', $mataKuliah->nama_mk) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">SKS</label>
            <input name="sks" type="number" min="1" max="6" class="form-control" value="{{ old('sks', $mataKuliah->sks) }}" required>
        </div>
        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('mata-kuliah.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection