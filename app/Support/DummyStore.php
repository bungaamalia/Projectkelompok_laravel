<?php

namespace App\Support;

class DummyStore
{
    public static function get(string $key, array $default = []): array
    {
        if (!session()->has($key)) {
            session([$key => $default]);
        }

        return session($key, $default);
    }

    public static function save(string $key, array $rows): void
    {
        session([$key => array_values($rows)]);
    }

    public static function mahasiswa(): array
    {
        return [
            [
                'nim' => '24100001',
                'nama_lengkap' => 'Bunga Amalia Kharismawati',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2024',
            ],
            [
                'nim' => '24100002',
                'nama_lengkap' => 'Aditya Pratama',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2024',
            ],
            [
                'nim' => '24100003',
                'nama_lengkap' => 'Nadia Putri Lestari',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2024',
            ],
            [
                'nim' => '25100001',
                'nama_lengkap' => 'Rizky Ramadhan',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2025',
            ],
        ];
    }

    public static function dosen(): array
    {
        return [
            [
                'nidn' => '0412089001',
                'nama_lengkap' => 'Andi Saputra, M.Kom.',
                'program_studi' => 'Teknik Informatika',
            ],
            [
                'nidn' => '0415099002',
                'nama_lengkap' => 'Dewi Anggraini, M.Kom.',
                'program_studi' => 'Teknik Informatika',
            ],
        ];
    }

    public static function mataKuliah(): array
    {
        return [
            ['kode_mk' => 'IF101', 'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 3],
            ['kode_mk' => 'IF102', 'nama_mk' => 'Basis Data', 'sks' => 3],
            ['kode_mk' => 'IF103', 'nama_mk' => 'Pemrograman Web', 'sks' => 3],
            ['kode_mk' => 'IF104', 'nama_mk' => 'Struktur Data', 'sks' => 3],
            ['kode_mk' => 'IF105', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3],
        ];
    }

    public static function jadwal(): array
    {
        return [
            [
                'id_jadwal' => 1,
                'kode_mk' => 'IF101',
                'nama_mk' => 'Algoritma dan Pemrograman',
                'nidn' => '0412089001',
                'nama_dosen' => 'Andi Saputra, M.Kom.',
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:30',
                'ruangan' => 'Lab 1',
            ],
            [
                'id_jadwal' => 2,
                'kode_mk' => 'IF102',
                'nama_mk' => 'Basis Data',
                'nidn' => '0415099002',
                'nama_dosen' => 'Dewi Anggraini, M.Kom.',
                'hari' => 'Selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:30',
                'ruangan' => 'Ruang 2',
            ],
            [
                'id_jadwal' => 3,
                'kode_mk' => 'IF103',
                'nama_mk' => 'Pemrograman Web',
                'nidn' => '0412089001',
                'nama_dosen' => 'Andi Saputra, M.Kom.',
                'hari' => 'Rabu',
                'jam_mulai' => '13:00',
                'jam_selesai' => '15:30',
                'ruangan' => 'Lab 2',
            ],
        ];
    }

    public static function objects(array $rows): array
    {
        return array_map(function ($row) {
            $item = (object) $row;

            if (isset($row['nama_lengkap'])) {
                $item->user = (object) [
                    'name' => $row['nama_lengkap'],
                    'nama_lengkap' => $row['nama_lengkap'],
                ];
            }

            if (isset($row['kode_mk'])) {
                $item->mataKuliah = (object) [
                    'kode_mk' => $row['kode_mk'],
                    'nama_mk' => $row['nama_mk'] ?? '',
                ];
            }

            if (isset($row['nidn'])) {
                $item->dosen = (object) [
                    'nidn' => $row['nidn'],
                    'user' => (object) [
                        'name' => $row['nama_dosen'] ?? '',
                    ],
                ];
            }

            return $item;
        }, $rows);
    }
}