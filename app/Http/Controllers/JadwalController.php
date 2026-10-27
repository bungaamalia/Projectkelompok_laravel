<?php

namespace App\Http\Controllers;

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
    }
}