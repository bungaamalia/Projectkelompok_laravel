<?php

namespace App\Http\Controllers;

use App\Support\DummyStore;

class MahasiswaController extends DummyCrudController
{
    protected function cfg(): array
    {
        return [
            'key' => 'dummy_mahasiswa',
            'default' => DummyStore::mahasiswa(),
            'folder' => 'mahasiswa',
            'variable' => 'mahasiswa',
            'singular' => 'mahasiswa',
            'id' => 'nim',
            'route' => 'mahasiswa',
            'rules' => [
                'nim' => 'required|string|max:20',
                'nama_lengkap' => 'required|string|max:255',
                'angkatan' => 'required|digits:4',
            ],
            'defaults' => [
                'program_studi' => 'Teknik Informatika',
            ],
        ];
    }
}