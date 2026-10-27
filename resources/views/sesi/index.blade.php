@extends('layouts.app')

@section('page-title', 'Pengelolaan Sesi Presensi Multi-Matkul')

@section('content')
<div class="mb-4">
    <h1 class="h3 fw-bold mb-1">Pengelolaan Sesi Presensi (FR-006)</h1>
    <p class="text-muted small">Pilih mata kuliah yang tersedia di bawah ini untuk melihat QR/PIN atau Submit Presensi</p>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger border-0 shadow-sm mb-4">{{ $errors->first() }}</div>
@endif

<div class="row">
    <!-- FORM BUKA SESI (DOSEN/ADMIN) -->
    @if(session('user.role') === 'Dosen' || session('user.role') === 'Admin')
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-plus-circle text-purple me-2"></i>Buka Sesi Presensi Baru</h5>
            <form action="{{ route('sesi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label font-weight-bold small">Pilih Mata Kuliah</label>
                    <select name="nama_mk" class="form-select" required>
                        <option value="Pemrograman Web 2">Pemrograman Web 2</option>
                        <option value="Basdat Lanjutan">Basdat Lanjutan</option>
                        <option value="Kecerdasan Buatan">Kecerdasan Buatan</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label font-weight-bold small">Pertemuan</label>
                        <input type="number" name="pertemuan_ke" class="form-control" value="4" min="1" max="16" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label font-weight-bold small">Durasi (Mnt)</label>
                        <input type="number" name="durasi" class="form-control" value="15" min="5" max="120" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-purple w-100 py-2">
                    <i class="fa-solid fa-qrcode me-1"></i> Rilis QR & PIN
                </button>
            </form>
        </div>
    </div>
    @endif

    <!-- TAMPILAN SESI AKTIF MULTI-MATKUL -->
    <div class="{{ (session('user.role') === 'Dosen' || session('user.role') === 'Admin') ? 'col-md-8' : 'col-md-12' }} mb-4">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-layer-group me-2 text-purple"></i>Pilih Sesi Mata Kuliah Aktif</h5>

            @if(count($sesiList) > 0)
                <!-- TAB PILIHAN MATA KULIAH -->
                <div class="d-flex gap-2 mb-3 overflow-auto pb-2">
                    @foreach($sesiList as $id => $s)
                        <a href="{{ route('sesi.index', ['id_sesi' => $id]) }}" 
                           class="btn {{ ($sesiAktif && $sesiAktif['id_sesi'] === $id) ? 'btn-purple' : 'btn-outline-purple' }} text-nowrap">
                            <i class="fa-solid fa-book me-1"></i> {{ $s['nama_mk'] }} (P-{{ $s['pertemuan_ke'] }})
                        </a>
                    @endforeach
                </div>

                @if($sesiAktif)
                <div class="p-4 border rounded-3 bg-light text-center position-relative">
                    <span class="badge bg-success position-absolute top-0 end-0 m-3">Aktif</span>
                    <h4 class="fw-bold text-dark mb-1">{{ $sesiAktif['nama_mk'] }}</h4>
                    <p class="text-muted small mb-1">Dosen: <b>{{ $sesiAktif['dosen'] }}</b> | Pertemuan Ke-{{ $sesiAktif['pertemuan_ke'] }}</p>
                    <p class="text-purple small fw-bold mb-3"><i class="fa-regular fa-clock me-1"></i> Berlaku: {{ $sesiAktif['waktu_buka'] }} - {{ $sesiAktif['waktu_tutup'] }} WIB</p>
                    
                    <!-- Display QR Code Dynamic -->
                    <div class="my-3">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $sesiAktif['token_pin'] }}" alt="QR Presensi" class="img-thumbnail shadow-sm p-2">
                    </div>

                    <p class="mb-1 text-muted small fw-bold">TOKEN PIN PRESENSI:</p>
                    <h1 class="fw-bold text-purple tracking-wider mb-2" style="letter-spacing: 4px;">{{ $sesiAktif['token_pin'] }}</h1>
                    <p class="text-secondary small"><i class="fa-solid fa-user-check me-1"></i> Total Mahasiswa Hadir: <b>{{ $sesiAktif['jumlah_hadir'] }}</b> Orang</p>

                    <!-- Form Presensi Mahasiswa -->
                    @if(session('user.role') === 'Mahasiswa')
                    <div class="mt-4 p-3 border border-purple rounded-3 bg-white">
                        <h6 class="fw-bold mb-2">Form Submit Presensi ({{ $sesiAktif['nama_mk'] }})</h6>
                        <form action="{{ route('sesi.submit') }}" method="POST" class="d-flex gap-2 justify-content-center">
                            @csrf
                            <input type="hidden" name="id_sesi" value="{{ $sesiAktif['id_sesi'] }}">
                            <input type="text" name="pin" class="form-control text-center text-uppercase fw-bold" style="width: 200px; letter-spacing: 2px;" placeholder="Ketik PIN Token" maxlength="6" required>
                            <button type="submit" class="btn btn-purple">
                                <i class="fa-solid fa-paper-plane me-1"></i> Submit Hadir
                            </button>
                        </form>
                    </div>
                    @endif

                    <!-- Tutup Sesi Khusus Dosen -->
                    @if(session('user.role') === 'Dosen' || session('user.role') === 'Admin')
                    <form action="{{ route('sesi.close', $sesiAktif['id_sesi']) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Tutup sesi {{ $sesiAktif['nama_mk'] }} ini?')">
                            <i class="fa-solid fa-stop-circle me-1"></i> Tutup Sesi {{ $sesiAktif['nama_mk'] }}
                        </button>
                    </form>
                    @endif
                </div>
                @endif

            @else
                <div class="py-5 text-center text-muted">
                    <i class="fa-solid fa-qrcode fa-3x mb-3 text-secondary opacity-50"></i>
                    <p class="m-0 fw-bold">Belum ada sesi presensi yang sedang aktif.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- LOG KEHADIRAN -->
<div class="card border-0 shadow-sm rounded-3 p-4">
    <h5 class="fw-bold mb-3"><i class="fa-solid fa-clock-rotate-left me-2"></i>Log Kehadiran Mahasiswa (Realtime)</h5>
    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th>Waktu Presensi</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Pertemuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayatPresensi as $r)
                <tr>
                    <td>{{ $r['waktu_presensi'] }} WIB</td>
                    <td>{{ $r['nim'] }}</td>
                    <td><b>{{ $r['nama'] }}</b></td>
                    <td>{{ $r['nama_mk'] }}</td>
                    <td>Ke-{{ $r['pertemuan_ke'] }}</td>
                    <td><span class="badge bg-success">Hadir</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3 text-muted">Belum ada mahasiswa yang submit presensi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection