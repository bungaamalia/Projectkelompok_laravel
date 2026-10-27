<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiPresensi extends Model
{
    protected $table = 'sesi_presensis';

    protected $primaryKey = 'id_sesi';

    protected $fillable = [
        'kode_mk',
        'pertemuan_ke',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'token',
        'pin',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'pertemuan_ke' => 'integer',
    ];
}
