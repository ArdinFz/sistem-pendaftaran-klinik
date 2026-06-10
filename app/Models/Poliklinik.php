<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;

    protected $table = 'polikliniks';
    protected $primaryKey = 'id_poli';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_poli',
        'nama_poli',
        'deskripsi_poli',
    ];

    public function dokters()
    {
        return $this->hasMany(Dokter::class, 'id_poli', 'id_poli');
    }

    // Accessors for view compatibility
    public function getIdAttribute()
    {
        return $this->id_poli;
    }

    public function getDeskripsiAttribute()
    {
        return $this->deskripsi_poli;
    }
}
