<div class="d-flex flex-column h-100">
    <div class="text-center py-4 border-bottom">
        <h5 class="fw-bold mb-1" style="color:#6F42C1;">
            <i class="fa-solid fa-graduation-cap me-2"></i>
            Sistem Presensi
        </h5>
        <small class="text-muted">Universitas Cahaya Surya</small>
    </div>

    <div class="p-3">
        <div class="d-flex align-items-center gap-2 mb-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center"
                 style="width:42px;height:42px;background:#6F42C1;color:white;">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <div class="fw-semibold">
                    {{ session('user.nama', 'Pengguna') }}
                </div>
                <small class="text-muted">
                    {{ session('user.role', 'Mahasiswa') }}
                </small>
            </div>
        </div>

        <div class="text-uppercase text-muted small fw-bold mb-2">
            Menu Utama
        </div>

        <nav class="nav flex-column gap-1">
            @if(session('user.role') === 'Admin')
                <a href="{{ route('mahasiswa.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-users me-2"></i> Mahasiswa
                </a>

                <a href="{{ route('dosen.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-chalkboard-user me-2"></i> Dosen
                </a>

                <a href="{{ route('mata-kuliah.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-book me-2"></i> Mata Kuliah
                </a>

                <a href="{{ route('jadwal.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-calendar-days me-2"></i> Jadwal Kuliah
                </a>
            @elseif(session('user.role') === 'Dosen')
                <a href="{{ route('jadwal.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-calendar-days me-2"></i> Jadwal Kuliah
                </a>

                <a href="{{ route('sesi-presensi.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-clipboard-check me-2"></i> Sesi Presensi
                </a>
            @else
                <a href="{{ route('jadwal.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-calendar-days me-2"></i> Jadwal Kuliah
                </a>

                <a href="{{ route('presensi.index') }}"
                   class="nav-link text-dark rounded">
                    <i class="fa-solid fa-clipboard-check me-2"></i> Presensi
                </a>
            @endif

            <a href="{{ route('riwayat-presensi.index') }}"
               class="nav-link text-dark rounded">
                <i class="fa-solid fa-clock-rotate-left me-2"></i>
                Riwayat Presensi
            </a>

            <a href="{{ route('profile.index') }}"
               class="nav-link text-dark rounded">
                <i class="fa-solid fa-user-gear me-2"></i> Profil
            </a>
        </nav>
    </div>

    <div class="mt-auto p-3 border-top">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="fa-solid fa-right-from-bracket me-2"></i>
                Keluar
            </button>
        </form>
    </div>
</div>

<style>
    .nav-link:hover {
        background-color: #F0EAFB;
        color: #59339D !important;
    }
</style>