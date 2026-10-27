<?php

namespace App\Http\Controllers;

use App\Support\DummyStore;

class MataKuliahController extends DummyCrudController
{
    protected function cfg(): array
    {
        return [
            'key' => 'dummy_mata_kuliah',
            'default' => DummyStore::mataKuliah(),
            'folder' => 'mata_kuliah',
            'variable' => 'mataKuliah',
            'singular' => 'mataKuliah',
            'id' => 'kode_mk',
            'route' => 'mata-kuliah',
            'rules' => [
                'kode_mk' => 'required|string|max:20',
                'nama_mk' => 'required|string|max:255',
                'sks' => 'required|integer|min:1|max:6',
            ],
        ];
    }
}