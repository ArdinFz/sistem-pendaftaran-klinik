<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin Akun Utama (Ketoprak - untuk testing login)
        User::updateOrCreate(
            ['email' => 'admin@klinik.com'],
            [
                'name' => 'Ketoprak',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'nik' => '1234567890123456',
                'no_hp' => '08123456789',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1995-05-15',
                'status' => 'aktif',
            ]
        );

        // 2. User 1: Abdi (Admin) sesuai mockup
        User::updateOrCreate(
            ['email' => 'abdi@gmail.com'],
            [
                'name' => 'Abdi',
                'password' => Hash::make('klinik123'),
                'role' => 'admin',
                'nik' => '3273010101010001',
                'no_hp' => '08123456701',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1990-08-20',
                'status' => 'aktif',
            ]
        );

        // 3. User 2: Nadia (Pegawai) sesuai mockup
        User::updateOrCreate(
            ['email' => 'nadia@gmail.com'],
            [
                'name' => 'Nadia',
                'password' => Hash::make('klinik123'),
                'role' => 'pegawai',
                'nik' => '3273010101010002',
                'no_hp' => '08123456702',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1998-12-05',
                'status' => 'aktif',
            ]
        );

        // 4. User 3: Joki (Pasien) sesuai mockup
        User::updateOrCreate(
            ['email' => 'joki@gmail.com'],
            [
                'name' => 'Joki',
                'password' => Hash::make('klinik123'),
                'role' => 'pasien',
                'nik' => '3273010101010003',
                'no_hp' => '08123456703',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2001-04-12',
                'status' => 'aktif',
            ]
        );
    }
}