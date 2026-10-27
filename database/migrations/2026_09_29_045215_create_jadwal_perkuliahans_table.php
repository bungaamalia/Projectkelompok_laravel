<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_perkuliahans', function (Blueprint $table) {
            $table->id('id_jadwal');

            $table->string('kode_mk', 20);

            $table->string('nidn', 20);

            $table->enum('hari', [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
            ]);

            $table->time('jam_mulai');

            $table->time('jam_selesai');

            $table->string('ruangan');

            $table->timestamps();

            $table->foreign('kode_mk')
                ->references('kode_mk')
                ->on('mata_kuliahs')
                ->onDelete('cascade');

            $table->foreign('nidn')
                ->references('nidn')
                ->on('dosens')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_perkuliahans');
    }
};