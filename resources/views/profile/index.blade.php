@extends('layouts.app')

@section('page-title', 'Profil Pengguna')

@section('content')
<div class="mb-4">
    <h1 class="h3 fw-bold mb-1">Pengelolaan Profil Pengguna (FR-002)</h1>
    <p class="text-muted small">Kelola informasi data diri dan keamanan akun kamu</p>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mb-4">{{ $errors->first() }}</div>
@endif

<div class="row">
    <!-- INFO RINGKASAN PROFIL -->
    <div class="col-md-5 mb-4">
        <div class="card border-0 shadow-sm rounded-3 p-4 text-center">
            <div class="avatar-circle mb-3 mx-auto d-flex align-items-center justify-content-center text-white rounded-circle" style="width: 80px; height: 80px; background-color: var(--primary-purple); font-size: 2rem;">
                <i class="fa-solid fa-user"></i>
            </div>
            <h5 class="fw-bold m-0">{{ $user['nama'] }}</h5>
            <div class="mt-1">
                <span class="badge text-white" style="background-color: var(--primary-purple);">{{ $user['role'] ?? 'Mahasiswa' }}</span>
            </div>

            <table class="table table-borderless small mb-0 text-start mt-4">
                <tr>
                    <td class="text-muted">NIM / NIDN</td>
                    <td class="fw-bold text-end">{{ $user['username'] }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Program Studi</td>
                    <td class="fw-bold text-end">{{ $user['prodi'] }}</td>
                </tr>
                <tr>
                    <td class="text-muted">No. Handphone</td>
                    <td class="fw-bold text-end">{{ $user['no_hp'] }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- FORM EDIT PROFIL & UBAH PASSWORD -->
    <div class="col-md-7 mb-4">
        <!-- Edit Profil -->
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-user-pen me-2" style="color: var(--primary-purple);"></i>Edit Informasi Kontak</h5>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">NIM / NIDN</label>
                    <input type="text" class="form-control bg-light" value="{{ $user['username'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ $user['nama'] }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Program Studi</label>
                    <input type="text" class="form-control bg-light" value="{{ $user['prodi'] }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">No. HP / WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $user['no_hp'] }}" required>
                </div>
                <button type="submit" class="btn btn-purple float-end">Simpan Perubahan</button>
            </form>
        </div>

        <!-- Ubah Password -->
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-lock me-2" style="color: var(--primary-purple);"></i>Ubah Password Akun</h5>
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Password Saat Ini</label>
                    <input type="password" name="password_lama" class="form-control" required placeholder="••••••••">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Password Baru</label>
                    <input type="password" name="password_baru" class="form-control" required placeholder="Minimal 6 karakter">
                </div>
                <button type="submit" class="btn btn-outline-purple float-end">Perbarui Password</button>
            </form>
        </div>
    </div>
</div>

<!-- KHUSUS ROLE ADMIN: FORM TAMBAH AKUN PENGGUNA -->
@if(session('user.role') === 'Admin')
<div class="card border-0 shadow-sm rounded-3 p-4">
    <h5 class="fw-bold mb-3"><i class="fa-solid fa-user-plus me-2" style="color: var(--primary-purple);"></i>Tambah Akun Pengguna Baru (Khusus Admin)</h5>
    <form action="{{ route('profile.storeUser') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label small fw-bold">NIM / NIDN</label>
                <input type="text" name="username" class="form-control" placeholder="Contoh: 24100009" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label small fw-bold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Pengguna" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label small fw-bold">Role Akses</label>
                <select name="role" class="form-select" required>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label small fw-bold">Program Studi</label>
                <input type="text" name="prodi" class="form-control" value="Teknik Informatika" required>
            </div>
        </div>
        <button type="submit" class="btn btn-purple"><i class="fa-solid fa-plus me-1"></i> Buat Akun Baru</button>
    </form>
</div>
@endif
@endsection