<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = ['no', 'name', 'nik', 'email', 'tanggal_lahir', 'no_hp', 'alamat', 'foto'];
}
