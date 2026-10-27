<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        // Inisialisasi Data Dummy Jadwal di Session jika belum ada
        if (!session()->has('db_jadwal')) {
            session(['db_jadwal' => [
                1 => [
                    'id_jadwal' => 1,
                    'kode_mk' => 'TIF2026',
                    'nama_mk' => 'Pemrograman Web 2',
                    'sks' => 3,
                    'dosen' => 'Isa Mulia Insan, S.Kom., M.Kom.',
                    'hari' => 'Senin',
                    'jam' => '08:00 - 10:30',
                    'ruangan' => 'Lab Komputer 3',
                    'kelas' => 'TI-3A'
                ],
                2 => [
                    'id_jadwal' => 2,
                    'kode_mk' => 'TIF2027',
                    'nama_mk' => 'Basdat Lanjutan',
                    'sks' => 3,
                    'dosen' => 'Dr. Ahmad Fauzi, M.T.',
                    'hari' => 'Selasa',
                    'jam' => '10:30 - 13:00',
                    'ruangan' => 'Ruang 204',
                    'kelas' => 'TI-3A'
                ],
                3 => [
                    'id_jadwal' => 3,
                    'kode_mk' => 'TIF2028',
                    'nama_mk' => 'Kecerdasan Buatan',
                    'sks' => 2,
                    'dosen' => 'Nurmala, S.T., M.Cs.',
                    'hari' => 'Rabu',
                    'jam' => '13:00 - 15:00',
                    'ruangan' => 'Ruang 102',
                    'kelas' => 'TI-3A'
                ]
            ]]);
        }

        $allJadwal = session('db_jadwal', []);
        $filterHari = $request->get('hari', 'semua');

        if ($filterHari !== 'semua') {
            $jadwal = array_filter($allJadwal, function($j) use ($filterHari) {
                return strtolower($j['hari']) === strtolower($filterHari);
            });
        } else {
            $jadwal = $allJadwal;
        }

        return view('jadwal.index', compact('jadwal', 'filterHari'));
    }
}