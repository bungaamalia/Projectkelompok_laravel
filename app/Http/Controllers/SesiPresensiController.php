<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SesiPresensiController extends Controller
{
<<<<<<< HEAD
    public function index(Request $request)
    {
        // 1. Ambil semua sesi aktif dari Session
        $sesiList = session('sesi_aktif_list', []);

        // 2. Filter otomatis: Hapus sesi yang sudah melewati waktu_tutup
        $waktuSekarang = date('H:i');
        foreach ($sesiList as $id => $sesi) {
            if ($waktuSekarang > $sesi['waktu_tutup']) {
                unset($sesiList[$id]);
            }
        }
        session(['sesi_aktif_list' => $sesiList]);

        // 3. Tentukan sesi yang sedang dipilih/diklik oleh user (default: sesi pertama)
        $selectedId = $request->get('id_sesi', array_key_first($sesiList));
        $sesiAktif = $sesiList[$selectedId] ?? null;

        $riwayatPresensi = session('riwayat_presensi', []);

        return view('sesi.index', compact('sesiList', 'sesiAktif', 'riwayatPresensi'));
    }

    // DOSEN: Buka Sesi Baru (Bisa Banyak Matkul Sekaligus)
    public function store(Request $request)
    {
        $request->validate([
            'nama_mk' => 'required',
            'pertemuan_ke' => 'required|numeric',
            'durasi' => 'required|numeric'
        ]);

        $idSesi = 'SESI-' . rand(100, 999);
        $tokenPin = strtoupper(Str::random(6));

        $sesiBaru = [
            'id_sesi' => $idSesi,
            'nama_mk' => $request->nama_mk,
            'pertemuan_ke' => $request->pertemuan_ke,
            'dosen' => session('user.nama'),
            'token_pin' => $tokenPin,
            'waktu_buka' => date('H:i'),
            'waktu_tutup' => date('H:i', strtotime("+{$request->durasi} minutes")),
            'status' => 'Aktif',
            'jumlah_hadir' => 0
        ];

        // Simpan ke daftar array sesi aktif
        $sesiList = session('sesi_aktif_list', []);
        $sesiList[$idSesi] = $sesiBaru;

        session(['sesi_aktif_list' => $sesiList]);

        return redirect()->route('sesi.index', ['id_sesi' => $idSesi])->with('success', 'Sesi presensi ' . $request->nama_mk . ' berhasil dibuka!');
    }

    // DOSEN: Tutup Sesi Spesifik
    public function close($id)
    {
        $sesiList = session('sesi_aktif_list', []);
        if (isset($sesiList[$id])) {
            unset($sesiList[$id]);
            session(['sesi_aktif_list' => $sesiList]);
        }

        return redirect()->route('sesi.index')->with('success', 'Sesi presensi telah ditutup!');
    }

    // MAHASISWA: Input PIN berdasarkan Sesi Matkul yang Dipilih
    public function submitPresensi(Request $request)
    {
        $request->validate([
            'id_sesi' => 'required',
            'pin' => 'required'
        ]);

        $sesiList = session('sesi_aktif_list', []);
        $idSesi = $request->id_sesi;

        if (!isset($sesiList[$idSesi])) {
            return back()->withErrors(['msg' => 'Sesi presensi mata kuliah ini tidak ditemukan atau sudah ditutup!']);
        }

        $targetSesi = $sesiList[$idSesi];

        // Cek Durasi Waktu
        if (date('H:i') > $targetSesi['waktu_tutup']) {
            unset($sesiList[$idSesi]);
            session(['sesi_aktif_list' => $sesiList]);
            return back()->withErrors(['msg' => 'Waktu presensi mata kuliah ini telah habis!']);
        }

        // Cek Keabsahan PIN
        if (strtoupper($request->pin) !== $targetSesi['token_pin']) {
            return back()->withErrors(['msg' => 'PIN Token Presensi salah! Silakan periksa kembali.']);
        }

        // Cek apakah mahasiswa sudah presensi di sesi ini
        $riwayat = session('riwayat_presensi', []);
        $nim = session('user.username');

        foreach ($riwayat as $r) {
            if ($r['nim'] === $nim && $r['id_sesi'] === $idSesi) {
                return back()->withErrors(['msg' => 'Kamu sudah mengisi presensi untuk mata kuliah ini!']);
            }
        }

        // Catat Kehadiran
        $riwayat[] = [
            'id_sesi' => $idSesi,
            'nim' => session('user.username'),
            'nama' => session('user.nama'),
            'nama_mk' => $targetSesi['nama_mk'],
            'pertemuan_ke' => $targetSesi['pertemuan_ke'],
            'waktu_presensi' => date('H:i:s'),
            'status' => 'Hadir'
        ];

        // Tambah jumlah kehadiran
        $sesiList[$idSesi]['jumlah_hadir'] += 1;

        session([
            'sesi_aktif_list' => $sesiList,
            'riwayat_presensi' => $riwayat
        ]);

        return back()->with('success', 'Berhasil! Presensi ' . $targetSesi['nama_mk'] . ' kamu telah tercatat.');
=======
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
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
    }
}