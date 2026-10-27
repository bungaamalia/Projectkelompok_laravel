@extends('layouts.app')
@section('title', 'Detail Presensi')
@section('heading', 'Detail Presensi')
@section('content')
<div class="card p-4">
    <table class="table">
        <tr><th>NIM</th><td>{{ $presensi['nim'] }}</td></tr>
        <tr><th>Nama</th><td>{{ $presensi['nama'] }}</td></tr>
        <tr><th>Mata Kuliah</th><td>{{ $presensi['matkul'] }}</td></tr>
        <tr><th>Tanggal</th><td>{{ $presensi['tanggal'] }}</td></tr>
        <tr><th>Waktu</th><td>{{ $presensi['waktu'] }}</td></tr>
        <tr><th>Metode</th><td>{{ $presensi['metode'] }}</td></tr>
        <tr><th>Status</th><td>{{ $presensi['status'] }}</td></tr>
    </table>
    <a href="{{ route('presensi.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection