<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Presensi08Controller extends Controller
{
    private function initial(): array
    {
        return [
            [
                'id' => 1,
                'nim' => '24100001',
                'nama' => 'Bunga',
                'matkul' => 'Algoritma',
                'tanggal' => '2026-10-19',
                'waktu' => '08:00',
                'status' => 'Hadir',
                'alasan' => '',
            ],
            [
                'id' => 2,
                'nim' => '24100002',
                'nama' => 'Aditya',
                'matkul' => 'Basis Data',
                'tanggal' => '2026-10-19',
                'waktu' => '08:10',
                'status' => 'Izin',
                'alasan' => 'Ada keperluan',
            ],
            [
                'id' => 3,
                'nim' => '24100003',
                'nama' => 'Nadia',
                'matkul' => 'Pemrograman Web',
                'tanggal' => '2026-10-20',
                'waktu' => '09:00',
                'status' => 'Sakit',
                'alasan' => 'Sedang sakit',
            ],
            [
                'id' => 4,
                'nim' => '24100001',
                'nama' => 'Bunga',
                'matkul' => 'Basis Data',
                'tanggal' => '2026-10-20',
                'waktu' => '08:00',
                'status' => 'Alpha',
                'alasan' => '',
            ],
            [
                'id' => 5,
                'nim' => '24100002',
                'nama' => 'Aditya',
                'matkul' => 'Pemrograman Web',
                'tanggal' => '2026-10-21',
                'waktu' => '09:00',
                'status' => 'Hadir',
                'alasan' => '',
            ],
            [
                'id' => 6,
                'nim' => '24100003',
                'nama' => 'Nadia',
                'matkul' => 'Algoritma',
                'tanggal' => '2026-10-21',
                'waktu' => '—',
                'status' => 'Alpha',
                'alasan' => '',
            ],
        ];
    }

    private function rows(): array
    {
        if (!session()->has('dummy_riwayat')) {
            session(['dummy_riwayat' => $this->initial()]);
        }

        return session('dummy_riwayat', []);
    }

    public function index(Request $request)
    {
        $role = session('user.role', 'Mahasiswa');
        $user = session('user', []);

        $keyword = trim((string) $request->query('keyword', ''));
        $status = (string) $request->query('status', '');
        $matkul = (string) $request->query('matkul', '');

        $rows = $this->rows();

        // Mahasiswa hanya melihat riwayat miliknya sendiri.
        if ($role === 'Mahasiswa') {
            $username = (string) ($user['username'] ?? '');

            $rows = array_values(array_filter(
                $rows,
                fn ($row) => (string) $row['nim'] === $username
            ));
        }

        // Filter pencarian, status, dan mata kuliah.
        $riwayatMahasiswa = array_values(array_filter(
            $rows,
            function ($row) use ($keyword, $status, $matkul) {
                $cocokKeyword = $keyword === ''
                    || stripos($row['nama'], $keyword) !== false
                    || stripos($row['nim'], $keyword) !== false
                    || stripos($row['matkul'], $keyword) !== false;

                $cocokStatus = $status === ''
                    || $row['status'] === $status;

                $cocokMatkul = $matkul === ''
                    || $row['matkul'] === $matkul;

                return $cocokKeyword && $cocokStatus && $cocokMatkul;
            }
        ));

        $counts = [
            'Hadir' => 0,
            'Izin' => 0,
            'Sakit' => 0,
            'Alpha' => 0,
        ];

        foreach ($riwayatMahasiswa as $row) {
            if (isset($counts[$row['status']])) {
                $counts[$row['status']]++;
            }
        }

        $total = count($riwayatMahasiswa);

        $persentase = $total > 0
            ? (int) round(($counts['Hadir'] / $total) * 100)
            : 0;

        $mahasiswaList = collect($this->rows())
            ->unique('nim')
            ->map(fn ($row) => (object) [
                'nim' => $row['nim'],
                'nama' => $row['nama'],
            ])
            ->values();

        $matkulList = collect($this->rows())
            ->pluck('matkul')
            ->unique()
            ->values();

        return view('presensi08.index', [
            'role' => $role,
            'riwayatMahasiswa' => $riwayatMahasiswa,
            'mahasiswaList' => $mahasiswaList,
            'matkulList' => $matkulList,
            'nimMahasiswa' => $user['username'] ?? '',
            'matkul' => $matkul,
            'status' => $status,
            'keyword' => $keyword,
            'counts' => $counts,
            'total' => $total,
            'persentase' => $persentase,
            'statusFilter' => $status,
            'search' => $keyword,
            'isAdmin' => $role === 'Admin',
            'isDosen' => $role === 'Dosen',
            'isMahasiswa' => $role === 'Mahasiswa',
            'selectedStudent' => '',
            'statuses' => ['Hadir', 'Izin', 'Sakit', 'Alpha'],
            'legend' => [],
            'namaMk' => '',
            'mhs' => null,
            'roleOption' => $role,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        // Hanya Dosen yang boleh memperbarui status.
        abort_unless(session('user.role') === 'Dosen', 403);

        $data = $request->validate([
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
            'alasan' => 'nullable|string|max:250',
        ]);

        $rows = $this->rows();
        $found = false;

        foreach ($rows as &$row) {
            if ((string) $row['id'] === (string) $id) {
                $row['status'] = $data['status'];
                $row['alasan'] = $data['alasan'] ?? '';
                $row['waktu'] = $data['status'] === 'Hadir'
                    ? date('H:i')
                    : '—';

                $found = true;
                break;
            }
        }

        unset($row);

        abort_if(!$found, 404);

        session(['dummy_riwayat' => $rows]);

        return redirect()
            ->route('presensi08.index')
            ->with('success', 'Status presensi berhasil diperbarui.');
    }
}
