<?php

namespace App\Http\Controllers;

use App\Support\DummyStore;

class DosenController extends DummyCrudController
{
    protected function cfg(): array
    {
        return [
            'key' => 'dummy_dosen',
            'default' => DummyStore::dosen(),
            'folder' => 'dosen',
            'variable' => 'dosen',
            'singular' => 'dosen',
            'id' => 'nidn',
            'route' => 'dosen',
            'rules' => [
                'nidn' => 'required|string|max:20',
                'nama_lengkap' => 'required|string|max:255',
            ],
            'defaults' => [
                'program_studi' => 'Teknik Informatika',
            ],
        ];
    }
}