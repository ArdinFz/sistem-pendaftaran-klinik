<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model
{
    use HasFactory;

    protected $table = 'antreans';
    protected $primaryKey = 'id_antrean';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_antrean',
        'id_pendaftaran',
        'nomor_antrean',
        'status_antrean',
        'waktu_antrean',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    // Accessors for view compatibility (safe relation loading)
    public function getIdAttribute()
    {
        return $this->id_antrean;
    }

    public function getPasienAttribute()
    {
        $pendaftaran = $this->relationLoaded('pendaftaran') ? $this->getRelationValue('pendaftaran') : $this->pendaftaran()->getResults();
        if ($pendaftaran) {
            $pasien = $pendaftaran->relationLoaded('pasien') ? $pendaftaran->getRelationValue('pasien') : $pendaftaran->pasien()->getResults();
            if ($pasien) {
                return $pasien->nama;
            }
        }
        return 'Tidak Diketahui';
    }

    public function getPoliAttribute()
    {
        $pendaftaran = $this->relationLoaded('pendaftaran') ? $this->getRelationValue('pendaftaran') : $this->pendaftaran()->getResults();
        if ($pendaftaran) {
            $jadwal = $pendaftaran->relationLoaded('jadwalDokter') ? $pendaftaran->getRelationValue('jadwalDokter') : $pendaftaran->jadwalDokter()->getResults();
            if ($jadwal) {
                $dokter = $jadwal->relationLoaded('dokter') ? $jadwal->getRelationValue('dokter') : $jadwal->dokter()->getResults();
                if ($dokter && $dokter->poliklinik) {
                    return $dokter->poliklinik->nama_poli;
                }
            }
        }
        return 'Tidak Diketahui';
    }

    public function getDokterAttribute()
    {
        $pendaftaran = $this->relationLoaded('pendaftaran') ? $this->getRelationValue('pendaftaran') : $this->pendaftaran()->getResults();
        if ($pendaftaran) {
            $jadwal = $pendaftaran->relationLoaded('jadwalDokter') ? $pendaftaran->getRelationValue('jadwalDokter') : $pendaftaran->jadwalDokter()->getResults();
            if ($jadwal) {
                $dokter = $jadwal->relationLoaded('dokter') ? $jadwal->getRelationValue('dokter') : $jadwal->dokter()->getResults();
                if ($dokter) {
                    return $dokter->nama_dokter;
                }
            }
        }
        return 'Tidak Diketahui';
    }

    public function getJamAttribute()
    {
        return $this->waktu_antrean ? date('H:i', strtotime($this->waktu_antrean)) : '';
    }

    public function getStatusAttribute()
    {
        return $this->status_antrean;
    }
}
