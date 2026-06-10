<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_pendaftaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pendaftaran',
        'id_user',
        'id_jadwal',
        'tanggal_daftar',
        'keluhan',
        'status',
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_user', 'id_pasien');
    }

    public function jadwalDokter()
    {
        return $this->belongsTo(JadwalDokter::class, 'id_jadwal', 'id_jadwal');
    }

    public function antrean()
    {
        return $this->hasOne(Antrean::class, 'id_pendaftaran', 'id_pendaftaran');
    }

    // Accessors for view compatibility (safe relation loading)
    public function getNoAttribute()
    {
        return $this->id_pendaftaran;
    }

    public function getPasienAttribute()
    {
        $pasien = $this->relationLoaded('pasien') ? $this->getRelationValue('pasien') : $this->pasien()->getResults();
        return $pasien ? $pasien->nama : 'Tidak Diketahui';
    }

    public function getNikAttribute()
    {
        $pasien = $this->relationLoaded('pasien') ? $this->getRelationValue('pasien') : $this->pasien()->getResults();
        return $pasien ? $pasien->nik : '';
    }

    public function getEmailAttribute()
    {
        $pasien = $this->relationLoaded('pasien') ? $this->getRelationValue('pasien') : $this->pasien()->getResults();
        return $pasien ? $pasien->email : '';
    }

    public function getNoHpAttribute()
    {
        $pasien = $this->relationLoaded('pasien') ? $this->getRelationValue('pasien') : $this->pasien()->getResults();
        return $pasien ? $pasien->no_hp : '';
    }

    public function getAlamatAttribute()
    {
        $pasien = $this->relationLoaded('pasien') ? $this->getRelationValue('pasien') : $this->pasien()->getResults();
        return $pasien ? $pasien->alamat : '';
    }

    public function getJenisKelaminAttribute()
    {
        $pasien = $this->relationLoaded('pasien') ? $this->getRelationValue('pasien') : $this->pasien()->getResults();
        return $pasien ? $pasien->jenis_kelamin : 'Laki-laki';
    }

    public function getTanggalLahirAttribute()
    {
        $pasien = $this->relationLoaded('pasien') ? $this->getRelationValue('pasien') : $this->pasien()->getResults();
        return $pasien ? $pasien->tanggal_lahir : null;
    }

    public function getPoliAttribute()
    {
        $jadwal = $this->relationLoaded('jadwalDokter') ? $this->getRelationValue('jadwalDokter') : $this->jadwalDokter()->getResults();
        if ($jadwal) {
            $dokter = $jadwal->relationLoaded('dokter') ? $jadwal->getRelationValue('dokter') : $jadwal->dokter()->getResults();
            if ($dokter && $dokter->poliklinik) {
                return $dokter->poliklinik->nama_poli;
            }
        }
        return 'Tidak Diketahui';
    }

    public function getDokterAttribute()
    {
        $jadwal = $this->relationLoaded('jadwalDokter') ? $this->getRelationValue('jadwalDokter') : $this->jadwalDokter()->getResults();
        if ($jadwal) {
            $dokter = $jadwal->relationLoaded('dokter') ? $jadwal->getRelationValue('dokter') : $jadwal->dokter()->getResults();
            if ($dokter) {
                return $dokter->nama_dokter;
            }
        }
        return 'Tidak Diketahui';
    }

    public function getJamAttribute()
    {
        $jadwal = $this->relationLoaded('jadwalDokter') ? $this->getRelationValue('jadwalDokter') : $this->jadwalDokter()->getResults();
        return $jadwal 
            ? (date('H.i', strtotime($jadwal->jam_mulai)) . ' - ' . date('H.i', strtotime($jadwal->jam_selesai))) 
            : '08.00 - 09.00';
    }

    public function getTanggalAttribute()
    {
        return $this->tanggal_daftar ? $this->tanggal_daftar->format('Y-m-d') : null;
    }

    public function getNomorAntreanAttribute()
    {
        $antrean = $this->relationLoaded('antrean') ? $this->getRelationValue('antrean') : $this->antrean()->getResults();
        return $antrean ? $antrean->nomor_antrean : 1;
    }

    public function getHariAttribute()
    {
        $jadwal = $this->relationLoaded('jadwalDokter') ? $this->getRelationValue('jadwalDokter') : $this->jadwalDokter()->getResults();
        return $jadwal ? $jadwal->hari : 'Senin';
    }
}
