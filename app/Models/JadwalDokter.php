<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokters';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_dokter',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function getTanggalAttribute($value)
    {
        if (!$value) {
            return null;
        }
        $timezone = 'Asia/Jakarta';
        $originalDate = \Carbon\Carbon::parse($value);
        $dayOfWeek = $originalDate->dayOfWeekIso; // 1 = Monday, 7 = Sunday
        
        $now = \Carbon\Carbon::now($timezone);
        $startOfWeek = $now->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
        
        return $startOfWeek->addDays($dayOfWeek - 1)->startOfDay();
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    // Accessors for view compatibility (safe relation loading)
    public function getIdAttribute()
    {
        return $this->id_jadwal;
    }

    public function getDokterAttribute()
    {
        $dokter = $this->relationLoaded('dokter') ? $this->getRelationValue('dokter') : $this->dokter()->getResults();
        return $dokter ? $dokter->nama_dokter : 'Tidak ada';
    }

    public function getPoliklinikAttribute()
    {
        $dokter = $this->relationLoaded('dokter') ? $this->getRelationValue('dokter') : $this->dokter()->getResults();
        return ($dokter && $dokter->poliklinik) ? $dokter->poliklinik->nama_poli : 'Tidak ada';
    }

    public function getHariAttribute()
    {
        if (!$this->tanggal) return 'Senin';
        $dayOfWeek = $this->tanggal->format('N');
        $dayMap = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];
        return $dayMap[$dayOfWeek] ?? 'Senin';
    }
}
