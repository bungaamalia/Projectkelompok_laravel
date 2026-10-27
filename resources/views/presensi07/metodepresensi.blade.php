<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Metode Presensi</h5>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('presensi.index', ['metode' => 'qr']) }}"
               class="btn {{ ($tabMetode ?? 'pin') === 'qr' ? 'btn-primary' : 'btn-outline-primary' }}">
                <i class="bi bi-qr-code me-1"></i> QR Code
            </a>

            <a href="{{ route('presensi.index', ['metode' => 'pin']) }}"
               class="btn {{ ($tabMetode ?? 'pin') === 'pin' ? 'btn-primary' : 'btn-outline-primary' }}">
                <i class="bi bi-key me-1"></i> PIN
            </a>

            <a href="{{ route('presensi.index', ['metode' => 'lokasi']) }}"
               class="btn {{ ($tabMetode ?? 'pin') === 'lokasi' ? 'btn-primary' : 'btn-outline-primary' }}">
                <i class="bi bi-geo-alt me-1"></i> Lokasi
            </a>
        </div>

        <hr>

        @if (($tabMetode ?? 'pin') === 'qr')
            <div class="text-center py-4">
                <i class="bi bi-qr-code text-secondary" style="font-size: 72px;"></i>
                <h6 class="fw-bold mt-3">Presensi dengan QR Code</h6>
                <p class="text-muted mb-0">
                    Fitur QR Code ditampilkan sebagai simulasi pada versi data dummy.
                </p>
            </div>
        @elseif (($tabMetode ?? 'pin') === 'lokasi')
            <div class="text-center py-4">
                <i class="bi bi-geo-alt text-secondary" style="font-size: 60px;"></i>
                <h6 class="fw-bold mt-3">Presensi Berbasis Lokasi</h6>
                <p class="text-muted mb-0">
                    Validasi lokasi ditampilkan sebagai simulasi pada versi data dummy.
                </p>
            </div>
        @else
            <h6 class="fw-semibold mb-3">Masukkan PIN Presensi</h6>

            <form action="{{ route('presensi.catat') }}" method="POST">
                @csrf

                <input type="hidden" name="matkul_id"
                       value="{{ $selectedMkId ?? '' }}">

                <div class="mb-3">
                    <label for="token_pin" class="form-label">PIN Presensi</label>
                    <input type="text"
                           name="token_pin"
                           id="token_pin"
                           class="form-control"
                           placeholder="Masukkan PIN dari dosen"
                           maxlength="6"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Kirim Presensi
                </button>
            </form>
        @endif
    </div>
</div>