<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\JadwalPerkuliahan;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliahs';

    protected $primaryKey = 'kode_mk';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
    ];

    /**
     * Relasi mata kuliah dengan jadwal perkuliahan.
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(
            JadwalPerkuliahan::class,
            'kode_mk',
            'kode_mk'
        );
    }
}
