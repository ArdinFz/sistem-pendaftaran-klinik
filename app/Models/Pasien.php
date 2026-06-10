<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pasien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pasien',
        'nik',
        'email',
        'password',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'tanggal_lahir' => 'date',
    ];

    public function getNameAttribute()
    {
        return $this->nama;
    }

    public function getIdAttribute()
    {
        return $this->id_pasien;
    }
}
