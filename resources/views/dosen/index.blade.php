@extends('layouts.app')

@section('page-title', 'Data Dosen')

@section('content')
<div class="card p-4 border-0 shadow-sm">
    <h4>Data Dosen Pengampu</h4>
    <p class="text-muted small">Daftar dosen pengampu di Universitas Cahaya Surya</p>
    <table class="table table-hover mt-3">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>NIDN</th>
                <th>Nama Dosen</th>
                <th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>19880101</td>
                <td>Isa Mulia Insan, S.Kom., M.Kom.</td>
                <td>Teknik Informatika</td>
            </tr>
            <tr>
                <td>2</td>
                <td>19890202</td>
                <td>Budi Santoso, M.T.</td>
                <td>Teknik Informatika</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection