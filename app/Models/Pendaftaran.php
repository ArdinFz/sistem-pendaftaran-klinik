<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'no', 'id_pendaftaran', 'tanggal', 'nomor_antrean', 'hari', 'jam',
        'nik', 'email', 'no_hp', 'pasien', 'dokter', 'poli',
        'jenis_kelamin', 'tanggal_lahir', 'alamat', 'keluhan', 'status'
    ];
}
