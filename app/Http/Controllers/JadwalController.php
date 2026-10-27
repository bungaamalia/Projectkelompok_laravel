<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
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
=======
use App\Support\DummyStore;
use Illuminate\Http\Request;

class JadwalController extends DummyCrudController
{
    protected function cfg(): array
    {
        return [
            'key' => 'dummy_jadwal',
            'default' => DummyStore::jadwal(),
            'folder' => 'jadwal',
            'variable' => 'jadwal',
            'singular' => 'jadwal',
            'id' => 'id_jadwal',
            'route' => 'jadwal',
            'rules' => [
                'kode_mk' => 'required|string|max:20',
                'nidn' => 'required|string|max:20',
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
                'jam_mulai' => 'required|date_format:H:i',
                'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
                'ruangan' => 'required|string|max:100',
            ],
        ];
    }

    protected function extras(): array
    {
        return [
            'mataKuliah' => DummyStore::objects(
                DummyStore::get('dummy_mata_kuliah', DummyStore::mataKuliah())
            ),
            'dosen' => DummyStore::objects(
                DummyStore::get('dummy_dosen', DummyStore::dosen())
            ),
        ];
    }

    protected function toObject(array $row): object
    {
        $item = (object) $row;

        $item->mataKuliah = (object) [
            'kode_mk' => $row['kode_mk'] ?? '',
            'nama_mk' => $row['nama_mk'] ?? '',
        ];

        $item->dosen = (object) [
            'nidn' => $row['nidn'] ?? '',
            'user' => (object) [
                'name' => $row['nama_dosen'] ?? '',
            ],
        ];

        return $item;
    }

    protected function enrich(array $data): array
    {
        $mataKuliah = DummyStore::get(
            'dummy_mata_kuliah',
            DummyStore::mataKuliah()
        );

        $dosen = DummyStore::get(
            'dummy_dosen',
            DummyStore::dosen()
        );

        foreach ($mataKuliah as $item) {
            if ($item['kode_mk'] === $data['kode_mk']) {
                $data['nama_mk'] = $item['nama_mk'];
                break;
            }
        }

        foreach ($dosen as $item) {
            if ($item['nidn'] === $data['nidn']) {
                $data['nama_dosen'] = $item['nama_lengkap'];
                break;
            }
        }

        return $data;
    }

    public function store(Request $request)
    {
        $config = $this->cfg();
        $data = $request->validate($config['rules']);
        $rows = $this->rows();

        $data['id_jadwal'] = count($rows)
            ? max(array_column($rows, 'id_jadwal')) + 1
            : 1;

        $rows[] = $this->enrich($data);
        $this->save($rows);

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
    }
}