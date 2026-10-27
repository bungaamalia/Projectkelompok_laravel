<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    protected $table = 'presensis';

    protected $primaryKey = 'id_presensi';

    protected $fillable = [
        'id_sesi',
        'nim',
        'tanggal_presensi',
        'waktu_presensi',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_presensi' => 'date',
    ];

    public function sesi(): BelongsTo
    {
        return $this->belongsTo(
            SesiPresensi::class,
            'id_sesi',
            'id_sesi'
        );
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(
            Mahasiswa::class,
            'nim',
            'nim'
        );
    }
}
