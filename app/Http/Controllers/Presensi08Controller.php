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
                'nama' => 'Bunga Amalia Kharismawati',
                'matkul' => 'Algoritma dan Pemrograman',
                'tanggal' => '2026-10-19',
                'status' => 'Hadir',
                'waktu' => '08:03',
                'alasan' => '',
            ],
            [
                'id' => 2,
                'nim' => '24100001',
                'nama' => 'Bunga Amalia Kharismawati',
                'matkul' => 'Basis Data',
                'tanggal' => '2026-10-20',
                'status' => 'Hadir',
                'waktu' => '13:02',
                'alasan' => '',
            ],
            [
                'id' => 3,
                'nim' => '24100001',
                'nama' => 'Bunga Amalia Kharismawati',
                'matkul' => 'Pemrograman Web',
                'tanggal' => '2026-10-21',
                'status' => 'Izin',
                'waktu' => '—',
                'alasan' => '',
            ],
            [
                'id' => 4,
                'nim' => '24100002',
                'nama' => 'Aditya Pratama',
                'matkul' => 'Algoritma dan Pemrograman',
                'tanggal' => '2026-10-19',
                'status' => 'Hadir',
                'waktu' => '08:05',
                'alasan' => '',
            ],
            [
                'id' => 5,
                'nim' => '24100002',
                'nama' => 'Aditya Pratama',
                'matkul' => 'Basis Data',
                'tanggal' => '2026-10-20',
                'status' => 'Sakit',
                'waktu' => '—',
                'alasan' => '',
            ],
            [
                'id' => 6,
                'nim' => '24100003',
                'nama' => 'Nadia Putri Lestari',
                'matkul' => 'Algoritma dan Pemrograman',
                'tanggal' => '2026-10-19',
                'status' => 'Alpha',
                'waktu' => '—',
                'alasan' => '',
            ],
        ];
    }

    private function rows(): array
    {
        if (!session()->has('dummy_riwayat')) {
            session(['dummy_riwayat' => $this->initial()]);
        }

        return session('dummy_riwayat');
    }

    public function index(Request $request)
    {
        $role = session('user.role', 'Mahasiswa');
        $user = session('user', []);

        $keyword = trim((string) $request->query('keyword', ''));
        $status = (string) $request->query('status', '');
        $matkul = (string) $request->query('matkul', '');

        $rows = $this->rows();

        if ($role === 'Mahasiswa') {
            $rows = array_values(array_filter(
                $rows,
                fn ($row) => $row['nim'] === ($user['username'] ?? '')
            ));
        }

        $riwayatMahasiswa = array_values(array_filter(
            $rows,
            function ($row) use ($keyword, $status, $matkul) {
                $matchKeyword = $keyword === '' ||
                    stripos($row['nama'] . ' ' . $row['nim'] . ' ' . $row['matkul'], $keyword) !== false;

                $matchStatus = $status === '' || $row['status'] === $status;
                $matchMatkul = $matkul === '' || $row['matkul'] === $matkul;

                return $matchKeyword && $matchStatus && $matchMatkul;
            }
        ));

        $counts = [];

        foreach (['Hadir', 'Izin', 'Sakit', 'Alpha'] as $itemStatus) {
            $counts[$itemStatus] = count(array_filter(
                $riwayatMahasiswa,
                fn ($row) => $row['status'] === $itemStatus
            ));
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
        abort_unless(
            in_array(session('user.role'), ['Dosen', 'Admin']),
            403
        );

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