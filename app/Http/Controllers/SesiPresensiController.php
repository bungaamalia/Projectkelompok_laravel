<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SesiPresensiController extends Controller
{
    private function initial(): array
    {
        return [
            [
                'id_sesi' => 1,
                'nama_mk' => 'Algoritma dan Pemrograman',
                'pertemuan_ke' => 1,
                'tanggal' => date('Y-m-d'),
                'waktu_buka' => '08:00',
                'waktu_tutup' => '10:00',
                'token_pin' => 'AB12-CD34',
                'status' => 'Aktif',
            ],
            [
                'id_sesi' => 2,
                'nama_mk' => 'Basis Data',
                'pertemuan_ke' => 2,
                'tanggal' => date('Y-m-d'),
                'waktu_buka' => '10:00',
                'waktu_tutup' => '12:00',
                'token_pin' => 'EF56-GH78',
                'status' => 'Selesai',
            ],
        ];
    }

    public function index()
    {
        if (!session()->has('dummy_sesi')) {
            session(['dummy_sesi' => $this->initial()]);
        }

        $sesi = session('dummy_sesi');

        $sesi_aktif = collect($sesi)->firstWhere('status', 'Aktif');

        return view('sesi.index', compact('sesi', 'sesi_aktif'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_mk' => 'required|string|max:255',
            'pertemuan_ke' => 'required|integer|min:1|max:20',
        ]);

        $rows = session('dummy_sesi', $this->initial());

        foreach ($rows as &$row) {
            if ($row['status'] === 'Aktif') {
                $row['status'] = 'Selesai';
            }
        }
        unset($row);

        $data['id_sesi'] = count($rows)
            ? max(array_column($rows, 'id_sesi')) + 1
            : 1;

        $data['tanggal'] = date('Y-m-d');
        $data['waktu_buka'] = date('H:i');
        $data['waktu_tutup'] = date('H:i', strtotime('+2 hours'));
        $data['token_pin'] = strtoupper(Str::random(4) . '-' . Str::random(4));
        $data['status'] = 'Aktif';

        $rows[] = $data;

        session([
            'dummy_sesi' => $rows,
            'dummy_token_presensi' => $data['token_pin'],
        ]);

        return redirect()->route('sesi.index')
            ->with('success', 'Sesi presensi berhasil dibuat.');
    }

    public function close($id)
    {
        $rows = session('dummy_sesi', $this->initial());

        foreach ($rows as &$row) {
            if ((string) $row['id_sesi'] === (string) $id) {
                $row['status'] = 'Selesai';
            }
        }
        unset($row);

        session(['dummy_sesi' => $rows]);

        return redirect()->route('sesi.index')
            ->with('success', 'Sesi berhasil ditutup.');
    }

    public function destroy($id)
    {
        $rows = session('dummy_sesi', $this->initial());

        $rows = array_values(array_filter(
            $rows,
            fn ($row) => (string) $row['id_sesi'] !== (string) $id
        ));

        session(['dummy_sesi' => $rows]);

        return redirect()->route('sesi.index')
            ->with('success', 'Sesi berhasil dihapus.');
    }
}