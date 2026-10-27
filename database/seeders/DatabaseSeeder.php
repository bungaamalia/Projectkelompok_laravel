<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Users (Untuk FR-001 & FR-002)
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username')->unique(); // Berisi NIM atau NIDN
            $table->string('password');
            $table->string('nama_lengkap');
            $table->enum('role', ['Admin', 'Dosen', 'Mahasiswa']);
            $table->string('foto')->nullable();
            $table->string('no_hp')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Jadwal Perkuliahan (Untuk FR-005)
        Schema::create('jadwal_perkuliahan', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->string('kode_mk');
            $table->string('nama_mk');
            $table->string('nidn');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan');
            $table->string('kelas');
            $table->timestamps();
        });

        // 3. Tabel Sesi Presensi (Untuk FR-006)
        Schema::create('sesi_presensi', function (Blueprint $table) {
            $table->id('id_sesi');
            $table->foreignId('id_jadwal');
            $table->integer('pertemuan_ke');
            $table->date('tanggal');
            $table->string('token_qr_pin');
            $table->time('waktu_buka');
            $table->time('waktu_tutup');
            $table->enum('status_sesi', ['Aktif', 'Selesai'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesi_presensi');
        Schema::dropIfExists('jadwal_perkuliahan');
        Schema::dropIfExists('users');
    }
};