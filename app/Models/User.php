<?php

namespace App\Models;

<<<<<<< HEAD
// use Illuminate\Contracts\Auth\MustVerifyEmail;
=======
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
=======
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'role',
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
        'email',
        'password',
    ];

<<<<<<< HEAD
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
=======
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
    protected $hidden = [
        'password',
        'remember_token',
    ];

<<<<<<< HEAD
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
=======
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
<<<<<<< HEAD
=======

    /**
     * Relasi akun dengan data mahasiswa.
     */
    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'id_user', 'id');
    }

    /**
     * Relasi akun dengan data dosen.
     */
    public function dosen(): HasOne
    {
        return $this->hasOne(Dosen::class, 'id_user', 'id');
    }
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
}
