@extends('layouts.app')

@section('page-title', 'Sesi Presensi')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Sesi Presensi</h4>
            <p class="text-muted mb-0">
                Buat dan kelola sesi kehadiran perkuliahan.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Form Tambah Sesi --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">
                <i class="fa-solid fa-circle-plus me-2 text-primary"></i>
                Buat Sesi Presensi
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('sesi.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="mata_kuliah" class="form-label">
                            Mata Kuliah
                        </label>

                        <select
                            name="mata_kuliah"
                            id="mata_kuliah"
                            class="form-select"
                            required
                        >
                            <option value="">Pilih mata kuliah</option>

                            @foreach ([
                                'Algoritma dan Pemrograman',
                                'Basis Data',
                                'Pemrograman Web',
                                'Struktur Data',
                                'Jaringan Komputer',
                                'Rekayasa Perangkat Lunak'
                            ] as $mk)
                                <option
                                    value="{{ $mk }}"
                                    @selected(old('mata_kuliah') === $mk)
                                >
                                    {{ $mk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal" class="form-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            class="form-control"
                            value="{{ old('tanggal', date('Y-m-d')) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="jam_mulai" class="form-label">
                            Jam Mulai
                        </label>

                        <input
                            type="time"
                            name="jam_mulai"
                            id="jam_mulai"
                            class="form-control"
                            value="{{ old('jam_mulai', '08:00') }}"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="jam_selesai" class="form-label">
                            Jam Selesai
                        </label>

                        <input
                            type="time"
                            name="jam_selesai"
                            id="jam_selesai"
                            class="form-control"
                            value="{{ old('jam_selesai', '10:00') }}"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label for="metode" class="form-label">
                            Metode Presensi
                        </label>

                        <select
                            name="metode"
                            id="metode"
                            class="form-select"
                            required
                        >
                            <option value="">Pilih metode</option>

                            @foreach (['QR Code', 'PIN', 'Lokasi'] as $metode)
                                <option
                                    value="{{ $metode }}"
                                    @selected(old('metode') === $metode)
                                >
                                    {{ $metode }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-purple w-100">
                            <i class="fa-solid fa-plus me-2"></i>
                            Buat Sesi
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Sesi --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Daftar Sesi Perkuliahan</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Kode Sesi</th>
                            <th>Mata Kuliah</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Metode</th>
                            <th>PIN</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sesi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold">
                                        {{ $item['kode'] }}
                                    </span>
                                </td>
                                <td>{{ $item['mata_kuliah'] }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ $item['jam_mulai'] }} -
                                    {{ $item['jam_selesai'] }}
                                </td>
                                <td>{{ $item['metode'] }}</td>
                                <td>
                                    @if ($item['metode'] === 'PIN')
                                        <code>{{ $item['pin'] }}</code>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item['status'] === 'Aktif')
                                        <span class="badge text-bg-success">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge text-bg-secondary">
                                            Selesai
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <form
                                        action="{{ route('sesi.destroy', $item['id']) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus sesi ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus sesi"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9"
                                    class="text-center text-muted py-4">
                                    Belum ada sesi presensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
