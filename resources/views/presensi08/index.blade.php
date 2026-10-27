
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">

    <h3 class="mb-1">Riwayat Presensi</h3>

    <p class="text-muted mb-4">
        @if ($isAdmin)
            Rekap seluruh presensi mahasiswa.
        @elseif ($isDosen)
            Riwayat presensi mahasiswa dan pengelolaan status.
        @else
            Riwayat presensi pribadi.
        @endif
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-3 mb-4">
        @foreach (['Hadir', 'Izin', 'Sakit', 'Alpha'] as $itemStatus)
            <div class="col-6 col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="text-muted">
                            {{ $itemStatus }}
                        </div>
                        <h3 class="mb-0">
                            {{ $counts[$itemStatus] ?? 0 }}
                        </h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form action="{{ route('presensi08.index') }}"
                  method="GET"
                  class="row g-3">

                <div class="col-md-5">
                    <label for="keyword" class="form-label">
                        Cari presensi
                    </label>
                    <input
                        type="text"
                        id="keyword"
                        name="keyword"
                        class="form-control"
                        placeholder="Nama, NIM, atau mata kuliah"
                        value="{{ $keyword }}"
                    >
                </div>

                <div class="col-md-3">
                    <label for="status" class="form-label">
                        Status
                    </label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach ($statuses as $itemStatus)
                            <option
                                value="{{ $itemStatus }}"
                                {{ $status === $itemStatus ? 'selected' : '' }}
                            >
                                {{ $itemStatus }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="matkul" class="form-label">
                        Mata Kuliah
                    </label>
                    <select id="matkul" name="matkul" class="form-select">
                        <option value="">Semua Mata Kuliah</option>
                        @foreach ($matkulList as $itemMatkul)
                            <option
                                value="{{ $itemMatkul }}"
                                {{ $matkul === $itemMatkul ? 'selected' : '' }}
                            >
                                {{ $itemMatkul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        Cari
                    </button>
                </div>

                <div class="col-12">
                    <a href="{{ route('presensi08.index') }}"
                       class="btn btn-outline-secondary btn-sm">
                        Reset Filter
                    </a>
                </div>

            </form>

        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <strong>Daftar Riwayat Presensi</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No.</th>

                            @if (!$isMahasiswa)
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                            @endif

                            <th>Mata Kuliah</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Alasan</th>

                            @if ($isDosen)
                                <th>Perbarui Status</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($riwayatMahasiswa as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                @if (!$isMahasiswa)
                                    <td>{{ $row['nim'] }}</td>
                                    <td>{{ $row['nama'] }}</td>
                                @endif

                                <td>{{ $row['matkul'] }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['waktu'] }}</td>

                                <td>
                                    @php
                                        $badgeClass = match ($row['status']) {
                                            'Hadir' => 'success',
                                            'Izin' => 'info',
                                            'Sakit' => 'warning',
                                            'Alpha' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp

                                    <span class="badge bg-{{ $badgeClass }}">
                                        {{ $row['status'] }}
                                    </span>
                                </td>

                                <td>{{ $row['alasan'] ?: '—' }}</td>

                                @if ($isDosen)
                                    <td>
                                        <form
                                            action="{{ route('presensi08.updateStatus', $row['id']) }}"
                                            method="POST"
                                        >
                                            @csrf

                                            <select
                                                name="status"
                                                class="form-select form-select-sm mb-2"
                                                required
                                            >
                                                @foreach ($statuses as $itemStatus)
                                                    <option
                                                        value="{{ $itemStatus }}"
                                                        {{ $row['status'] === $itemStatus ? 'selected' : '' }}
                                                    >
                                                        {{ $itemStatus }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <input
                                                type="text"
                                                name="alasan"
                                                class="form-control form-control-sm mb-2"
                                                placeholder="Alasan (opsional)"
                                                value="{{ $row['alasan'] }}"
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-sm w-100"
                                            >
                                                Perbarui Status
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="{{ $isDosen ? 9 : ($isMahasiswa ? 6 : 8) }}"
                                    class="text-center py-4"
                                >
                                    Belum ada data presensi yang sesuai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="text-muted small mt-2">
                Total data: {{ $total }} |
                Persentase hadir: {{ $persentase }}%
            </div>
        </div>
    </div>

</div>
@endsection
