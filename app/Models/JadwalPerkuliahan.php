<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPerkuliahan extends Model
{
    protected $table = 'jadwal_perkuliahans';

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'kode_mk',
        'nidn',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
    ];

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(
            MataKuliah::class,
            'kode_mk',
            'kode_mk'
        );
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(
            Dosen::class,
            'nidn',
            'nidn'
        );
    }
}
