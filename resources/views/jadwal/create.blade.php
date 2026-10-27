@extends('layouts.app')
@section('title', 'Tambah Jadwal')
@section('heading', 'Tambah Jadwal Kuliah')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('jadwal.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Mata Kuliah</label>
            <select name="kode_mk" class="form-select" required>
                <option value="">Pilih mata kuliah</option>
                @foreach($mataKuliah as $item)
                    <option value="{{ $item->kode_mk }}">{{ $item->kode_mk }} - {{ $item->nama_mk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Dosen</label>
            <select name="nidn" class="form-select" required>
                <option value="">Pilih dosen</option>
                @foreach($dosen as $item)
                    <option value="{{ $item->nidn }}">{{ $item->nidn }} - {{ $item->nama_lengkap }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Hari</label>
            <select name="hari" class="form-select" required>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                    <option value="{{ $hari }}">{{ $hari }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ruangan</label>
            <input name="ruangan" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection