
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesi_presensis', function (Blueprint $table) {
            $table->id('id_sesi');

            $table->unsignedBigInteger('id_jadwal')->nullable();
            $table->string('kode_mk', 20);
            $table->string('nidn', 20)->nullable();

            $table->unsignedInteger('pertemuan_ke')->default(1);
            $table->date('tanggal');
            $table->time('waktu_buka');
            $table->time('waktu_tutup');

            $table->enum('metode', ['qr', 'pin', 'lokasi'])
                ->default('pin');

            $table->string('token_pin', 20)->nullable();

            $table->enum('status', ['Aktif', 'Selesai'])
                ->default('Aktif');

            $table->timestamps();

            $table->foreign('id_jadwal')
                ->references('id_jadwal')
                ->on('jadwal_perkuliahans')
                ->nullOnDelete();

            $table->foreign('kode_mk')
                ->references('kode_mk')
                ->on('mata_kuliahs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('nidn')
                ->references('nidn')
                ->on('dosens')
                ->nullOnDelete();
        });

        Schema::create('presensis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_sesi')
                ->constrained('sesi_presensis', 'id_sesi')
                ->cascadeOnDelete();

            $table->string('nim', 20);

            $table->enum('status', [
                'Hadir',
                'Izin',
                'Sakit',
                'Alpha'
            ])->default('Alpha');

            $table->time('waktu_hadir')->nullable();
            $table->text('alasan')->nullable();

            $table->timestamps();

            $table->foreign('nim')
                ->references('nim')
                ->on('mahasiswas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(
                ['id_sesi', 'nim'],
                'presensis_sesi_nim_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensis');
        Schema::dropIfExists('sesi_presensis');
    }
};
