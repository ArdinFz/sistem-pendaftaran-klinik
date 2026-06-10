<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $fillable = ['dokter', 'poliklinik', 'hari', 'jam_mulai', 'jam_selesai', 'kuota'];
}
