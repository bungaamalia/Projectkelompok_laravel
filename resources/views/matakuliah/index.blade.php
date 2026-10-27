@extends('layouts.app')

@section('page-title', 'Data Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <h1 class="h3 fw-bold mb-1">Data Mata Kuliah</h1>
        <p class="text-muted small">Pengelolaan master data mata kuliah</p>
    </div>
    <button class="btn btn-purple">
        <i class="fa-solid fa-plus me-1"></i> Tambah Mata Kuliah
    </button>
</div>

<div class="card p-4 border-0 shadow-sm rounded-3">
    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>TIF2026</td>
                    <td><b>Pemrograman Web 2</b></td>
                    <td>3</td>
                    <td>
                        <button class="btn-action-edit"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn-action-delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>TIF2027</td>
                    <td><b>Basdat Lanjutan</b></td>
                    <td>3</td>
                    <td>
                        <button class="btn-action-edit"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn-action-delete"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection