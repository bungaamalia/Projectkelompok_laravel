<?php

<<<<<<< HEAD
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
=======
namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\JadwalPerkuliahan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@kampus.local',
                'role' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Data Mahasiswa
        $mahasiswaData = [
            ['nim' => '24100001', 'nama' => 'Bunga Amalia Kharismawati', 'angkatan' => 2024],
            ['nim' => '24100002', 'nama' => 'Aditya Pratama', 'angkatan' => 2024],
            ['nim' => '24100003', 'nama' => 'Nadia Putri Lestari', 'angkatan' => 2024],
            ['nim' => '25100001', 'nama' => 'Rizky Ramadhan', 'angkatan' => 2025],
            ['nim' => '25100002', 'nama' => 'Siti Aulia Rahma', 'angkatan' => 2025],
        ];

        foreach ($mahasiswaData as $data) {
            $user = User::updateOrCreate(
                ['username' => $data['nim']],
                [
                    'name' => $data['nama'],
                    'email' => $data['nim'] . '@mahasiswa.local',
                    'role' => 'Mahasiswa',
                    'password' => Hash::make('password'),
                ]
            );

            Mahasiswa::updateOrCreate(
                ['nim' => $data['nim']],
                [
                    'id_user' => $user->id,
                    'program_studi' => 'Teknik Informatika',
                    'angkatan' => $data['angkatan'],
                ]
            );
        }

        // 3. Data Dosen
        $dosenData = [
            ['nidn' => '0412089001', 'nama' => 'Andi Saputra, M.Kom.'],
            ['nidn' => '0515098502', 'nama' => 'Rina Wulandari, M.T.'],
            ['nidn' => '0611028803', 'nama' => 'Budi Santoso, M.Kom.'],
        ];

        foreach ($dosenData as $data) {
            $user = User::updateOrCreate(
                ['username' => $data['nidn']],
                [
                    'name' => $data['nama'],
                    'email' => $data['nidn'] . '@dosen.local',
                    'role' => 'Dosen',
                    'password' => Hash::make('password'),
                ]
            );

            Dosen::updateOrCreate(
                ['nidn' => $data['nidn']],
                [
                    'id_user' => $user->id,
                    'program_studi' => 'Teknik Informatika',
                ]
            );
        }

        // 4. Data Mata Kuliah
        $mataKuliahData = [
            ['kode_mk' => 'IF101', 'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 3],
            ['kode_mk' => 'IF102', 'nama_mk' => 'Basis Data', 'sks' => 3],
            ['kode_mk' => 'IF103', 'nama_mk' => 'Pemrograman Web', 'sks' => 3],
            ['kode_mk' => 'IF104', 'nama_mk' => 'Struktur Data', 'sks' => 3],
            ['kode_mk' => 'IF105', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3],
            ['kode_mk' => 'IF106', 'nama_mk' => 'Rekayasa Perangkat Lunak', 'sks' => 2],
        ];

        foreach ($mataKuliahData as $data) {
            MataKuliah::updateOrCreate(
                ['kode_mk' => $data['kode_mk']],
                [
                    'nama_mk' => $data['nama_mk'],
                    'sks' => $data['sks'],
                ]
            );
        }

        // 5. Data Jadwal Perkuliahan
        $jadwalData = [
            [
                'kode_mk' => 'IF101',
                'nidn' => '0412089001',
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:30:00',
                'ruangan' => 'Lab Komputer 1',
            ],
            [
                'kode_mk' => 'IF102',
                'nidn' => '0515098502',
                'hari' => 'Senin',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:30:00',
                'ruangan' => 'Ruang 201',
            ],
            [
                'kode_mk' => 'IF103',
                'nidn' => '0611028803',
                'hari' => 'Selasa',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '11:30:00',
                'ruangan' => 'Lab Komputer 2',
            ],
            [
                'kode_mk' => 'IF104',
                'nidn' => '0412089001',
                'hari' => 'Rabu',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:30:00',
                'ruangan' => 'Ruang 202',
            ],
            [
                'kode_mk' => 'IF105',
                'nidn' => '0515098502',
                'hari' => 'Kamis',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:30:00',
                'ruangan' => 'Lab Jaringan',
            ],
            [
                'kode_mk' => 'IF106',
                'nidn' => '0611028803',
                'hari' => 'Jumat',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:40:00',
                'ruangan' => 'Ruang 203',
            ],
        ];

        foreach ($jadwalData as $data) {
            JadwalPerkuliahan::updateOrCreate(
                [
                    'kode_mk' => $data['kode_mk'],
                    'nidn' => $data['nidn'],
                    'hari' => $data['hari'],
                ],
                $data
            );
        }
    }
}
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
