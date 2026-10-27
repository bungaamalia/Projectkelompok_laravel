# Project Akademik Gabungan (Laravel)

Project ini menggabungkan FR-01 sampai FR-08 dari file sumber yang tersedia.

## Fitur yang digabungkan
- FR-01: halaman login/logout (kredensial demo sesuai AuthController sumber).
- FR-02: profil pengguna dan perubahan data profil.
- FR-03: CRUD Mahasiswa dan Dosen berbasis database.
- FR-04: CRUD Mata Kuliah dan Jadwal Perkuliahan berbasis database.
- FR-05/06: informasi jadwal dan sesi presensi dosen dari kode sumber.
- FR-07: pencatatan presensi dan token menggunakan session/data demo sesuai sumber.
- FR-08: riwayat presensi menggunakan session/data demo sesuai sumber.

## Persiapan
1. Pastikan PHP, Composer, dan MySQL/MariaDB tersedia.
2. Salin `.env.example` menjadi `.env`, lalu atur DB_DATABASE, DB_USERNAME, dan DB_PASSWORD.
3. Buat database kosong sesuai DB_DATABASE.
4. Jalankan `composer install`.
5. Jalankan `php artisan key:generate`.
6. Jalankan `php artisan migrate --seed` atau `php artisan migrate`.
7. Jalankan `php artisan serve`.

## Catatan penting
FR-03/04 memakai tabel database dan operasi CRUD. Pada file sumber FR-07/08, data presensi masih berupa data dummy yang disimpan pada session, bukan tabel database. Kode itu dipertahankan sesuai implementasi sumber dan belum diklaim sebagai penyimpanan presensi permanen. Login FR-01 juga masih menggunakan akun demo hardcoded dari sumber.
