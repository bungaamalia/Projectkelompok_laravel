<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';

    protected $primaryKey = 'nim';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'id_user',
        'program_studi',
        'angkatan',
    ];

    /**
     * Relasi mahasiswa dengan akun pengguna.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Gunakan NIM sebagai identitas pada URL.
     */
    public function getRouteKeyName(): string
    {
        return 'nim';
    }
}
