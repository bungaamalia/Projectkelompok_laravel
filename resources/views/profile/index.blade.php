@extends('layouts.app')
@section('title', 'Profil Saya')
@section('heading', 'Profil Saya')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input name="nama" class="form-control" value="{{ old('nama', $user['nama'] ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input class="form-control" value="{{ $user['username'] ?? '' }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <input class="form-control" value="{{ $user['role'] ?? '' }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Program Studi</label>
            <input class="form-control" value="{{ $user['prodi'] ?? '' }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input name="no_hp" class="form-control" value="{{ old('no_hp', $user['no_hp'] ?? '') }}">
        </div>

        <button class="btn btn-primary">Simpan Profil</button>
    </form>

    <hr class="my-4">

    <h5>Ubah Password Demo</h5>
    <p class="text-muted small">Password demo akan kembali ke password awal setelah login berikutnya.</p>

    <form method="POST" action="{{ route('profile.password') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" class="form-control" minlength="8" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control" minlength="8" required>
        </div>

        <button class="btn btn-primary">Ubah Password</button>
    </form>
</div>
@endsection