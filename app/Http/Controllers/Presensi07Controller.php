<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Presensi07Controller extends Controller
{
    private function initial(): array
    {
        return [
            [
                'id' => 1,
                'nim' => '24100001',
                'nama' => 'Bunga Amalia Kharismawati',
                'matkul' => 'Algoritma dan Pemrograman',
                'tanggal' => date('Y-m-d'),
                'status' => 'Hadir',
                'waktu' => '08:03',
                'metode' => 'QR Code',
            ],
            [
                'id' => 2,
                'nim' => '24100002',
                'nama' => 'Aditya Pratama',
                'matkul' => 'Algoritma dan Pemrograman',
                'tanggal' => date('Y-m-d'),
                'status' => 'Hadir',
                'waktu' => '08:05',
                'metode' => 'PIN',
            ],
            [
                'id' => 3,
                'nim' => '24100003',
                'nama' => 'Nadia Putri Lestari',
                'matkul' => 'Algoritma dan Pemrograman',
                'tanggal' => date('Y-m-d'),
                'status' => 'Izin',
                'waktu' => '—',
                'metode' => 'Manual',
            ],
        ];
    }

    private function rows(): array
    {
        if (!session()->has('dummy_presensi')) {
            session(['dummy_presensi' => $this->initial()]);
        }

        return session('dummy_presensi');
    }

    public function index(Request $request)
    {
        $role = session('user.role', 'Mahasiswa');
        $user = session('user', []);
        $keyword = trim((string) $request->query('keyword', ''));
        $status = (string) $request->query('status', '');

        $rows = $this->rows();

        if ($role === 'Mahasiswa') {
            $rows = array_values(array_filter(
                $rows,
                fn ($row) => $row['nim'] === ($user['username'] ?? '')
            ));
        }

        $presensi = array_values(array_filter($rows, function ($row) use ($keyword, $status) {
            $matchKeyword = $keyword === '' ||
                stripos($row['nama'] . ' ' . $row['nim'] . ' ' . $row['matkul'], $keyword) !== false;

            $matchStatus = $status === '' || $row['status'] === $status;

            return $matchKeyword && $matchStatus;
        }));

        $token = session('dummy_token_presensi', 'AB12-CD34');

        return view('presensi07.index', compact(
            'role',
            'presensi',
            'token',
            'keyword',
            'status'
        ));
    }

    public function show($id)
    {
        $presensi = collect($this->rows())->firstWhere('id', (int) $id);

        abort_if(!$presensi, 404);

        return view('presensi07.detail', compact('presensi'));
    }

    public function perbaruiToken()
    {
        abort_unless(
            in_array(session('user.role'), ['Dosen', 'Admin']),
            403
        );

        session([
            'dummy_token_presensi' => strtoupper(
                Str::random(4) . '-' . Str::random(4)
            ),
        ]);

        return back()->with('success', 'Token presensi berhasil diperbarui.');
    }

    public function catatPresensi(Request $request)
    {
        abort_unless(session('user.role') === 'Mahasiswa', 403);

        $data = $request->validate([
            'metode' => 'required|in:QR Code,PIN,Lokasi',
            'token' => 'required|string',
        ]);

        $tokenAktif = session('dummy_token_presensi', 'AB12-CD34');

        if ($data['token'] !== $tokenAktif) {
            return back()->withErrors([
                'token' => 'Token tidak valid.',
            ]);
        }

        $user = session('user');
        $rows = $this->rows();

        foreach ($rows as $row) {
            if (
                $row['nim'] === $user['username'] &&
                $row['tanggal'] === date('Y-m-d') &&
                $row['status'] === 'Hadir'
            ) {
                return back()->withErrors([
                    'token' => 'Presensi hari ini sudah tercatat.',
                ]);
            }
        }

        $rows[] = [
            'id' => count($rows) ? max(array_column($rows, 'id')) + 1 : 1,
            'nim' => $user['username'],
            'nama' => $user['nama'],
            'matkul' => 'Algoritma dan Pemrograman',
            'tanggal' => date('Y-m-d'),
            'status' => 'Hadir',
            'waktu' => date('H:i'),
            'metode' => $data['metode'],
        ];

        session(['dummy_presensi' => $rows]);

        return back()->with('success', 'Presensi berhasil dicatat (simulasi).');
    }
}