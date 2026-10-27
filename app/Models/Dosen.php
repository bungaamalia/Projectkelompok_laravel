<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\JadwalPerkuliahan;

class Dosen extends Model
{
    protected $table = 'dosens';

    protected $primaryKey = 'nidn';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nidn',
        'id_user',
        'program_studi',
    ];

    /**
     * Relasi dosen dengan akun pengguna.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi dosen dengan jadwal perkuliahan.
     */
    public function jadwal(): HasMany
    {
        return $this->hasMany(
            JadwalPerkuliahan::class,
            'nidn',
            'nidn'
        );
    }

    /**
     * Gunakan NIDN sebagai identitas pada URL.
     */
    public function getRouteKeyName(): string
    {
        return 'nidn';
    }
}
