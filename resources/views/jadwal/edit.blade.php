@extends('layouts.app')
@section('title', 'Edit Jadwal')
@section('heading', 'Edit Jadwal Kuliah')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('jadwal.update', $jadwal->id_jadwal) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Mata Kuliah</label>
            <select name="kode_mk" class="form-select" required>
                @foreach($mataKuliah as $item)
                    <option value="{{ $item->kode_mk }}" @selected($jadwal->kode_mk === $item->kode_mk)>
                        {{ $item->kode_mk }} - {{ $item->nama_mk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Dosen</label>
            <select name="nidn" class="form-select" required>
                @foreach($dosen as $item)
                    <option value="{{ $item->nidn }}" @selected($jadwal->nidn === $item->nidn)>
                        {{ $item->nidn }} - {{ $item->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Hari</label>
            <select name="hari" class="form-select" required>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                    <option value="{{ $hari }}" @selected($jadwal->hari === $hari)>{{ $hari }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ruangan</label>
            <input name="ruangan" class="form-control" value="{{ $jadwal->ruangan }}" required>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection