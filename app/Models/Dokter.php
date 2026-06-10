<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';
    protected $primaryKey = 'id_dokter';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_dokter',
        'id_poli',
        'nama_dokter',
        'no_hp',
    ];

    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class, 'id_poli', 'id_poli');
    }

    public function jadwalDokters()
    {
        return $this->hasMany(JadwalDokter::class, 'id_dokter', 'id_dokter');
    }

    // Accessors for view compatibility
    public function getNameAttribute()
    {
        return $this->nama_dokter;
    }

    public function getIdAttribute()
    {
        return $this->id_dokter;
    }

    public function getSpesialisAttribute()
    {
        return $this->poliklinik ? $this->poliklinik->nama_poli : 'Umum';
    }
}
