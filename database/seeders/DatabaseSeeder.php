<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Poliklinik;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Antrean;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Default (Admin, Pegawai, Pasien)
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

        // 2. Data Master Poliklinik
        Poliklinik::updateOrCreate(
            ['nama_poli' => 'Poli Umum'],
            ['deskripsi' => 'Pelayanan Kesehatan Umum']
        );
        Poliklinik::updateOrCreate(
            ['nama_poli' => 'Poli Gigi'],
            ['deskripsi' => 'Pemeriksaan dan Perawatan Gigi']
        );
        Poliklinik::updateOrCreate(
            ['nama_poli' => 'Poli Anak'],
            ['deskripsi' => 'Layanan Kesehatan Anak']
        );

        // 3. Data Master Dokter
        Dokter::updateOrCreate(
            ['name' => 'dr. Saepul'],
            ['spesialis' => 'Poli Umum', 'no_hp' => '08123456789']
        );
        Dokter::updateOrCreate(
            ['name' => 'dr. Indi'],
            ['spesialis' => 'Poli Gigi', 'no_hp' => '0812297120']
        );
        Dokter::updateOrCreate(
            ['name' => 'dr. Huru Hara'],
            ['spesialis' => 'Poli Anak', 'no_hp' => '08123456781']
        );

        // 4. Data Master Jadwal Dokter
        JadwalDokter::updateOrCreate(
            ['dokter' => 'dr. Saepul', 'hari' => 'Senin'],
            ['poliklinik' => 'Poli Umum', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'kuota' => 20]
        );
        JadwalDokter::updateOrCreate(
            ['dokter' => 'dr. Indi', 'hari' => 'Rabu'],
            ['poliklinik' => 'Poli Gigi', 'jam_mulai' => '08:30', 'jam_selesai' => '12:00', 'kuota' => 10]
        );
        JadwalDokter::updateOrCreate(
            ['dokter' => 'dr. Huru Hara', 'hari' => 'Rabu'],
            ['poliklinik' => 'Poli Anak', 'jam_mulai' => '08:00', 'jam_selesai' => '11:00', 'kuota' => 5]
        );

        // 5. Data Master Pasien
        Pasien::updateOrCreate(
            ['nik' => '1234567890'],
            [
                'no' => '001',
                'name' => 'Wira Sonic',
                'email' => 'wira@gmail.com',
                'tanggal_lahir' => '2005-05-25',
                'no_hp' => '0852497264',
                'alamat' => 'Jalan Asoman',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['nik' => '0987123432'],
            [
                'no' => '002',
                'name' => 'Galang Rading',
                'email' => 'galang@gmail.com',
                'tanggal_lahir' => '1999-06-21',
                'no_hp' => '089621327113',
                'alamat' => 'Gg. Kasih Mandiri',
                'foto' => null
            ]
        );

        // 6. Data Pendaftaran (Registrasi)
        Pendaftaran::updateOrCreate(
            ['no' => '001'],
            [
                'id_pendaftaran' => 'P001',
                'tanggal' => '2026-05-08',
                'nomor_antrean' => '505',
                'hari' => 'Senin',
                'jam' => '12:00',
                'nik' => '109283019238',
                'email' => 'keju@gmail.com',
                'no_hp' => '081237192434',
                'pasien' => 'Udang Keju',
                'dokter' => 'dr. Pardede',
                'poli' => 'Poli Bedah',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1995-05-13',
                'alamat' => 'Bantul',
                'keluhan' => 'Gak tau dog, kayaknya flu deh ini dog, kemarin demam gitu dog, cuma sekarang sembuh dog, cuma kadang kejang-kejang juga dog, gimana ya dog? sembuhin atuh dog, dog kan dogter!',
                'status' => 'Selesai'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['no' => '002'],
            [
                'id_pendaftaran' => 'P002',
                'tanggal' => '2026-05-08',
                'nomor_antrean' => '506',
                'hari' => 'Senin',
                'jam' => '08:00',
                'nik' => '123871023123',
                'email' => 'rino@gmail.com',
                'no_hp' => '081237192030',
                'pasien' => 'Rino Bleber',
                'dokter' => 'dr. Indi',
                'poli' => 'Poli Umum',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1992-06-14',
                'alamat' => 'Yogyakarta',
                'keluhan' => 'Sakit kepala sebelah kanan saja sejak kemarin pagi, kepala terasa seperti berdenyut-denyut kencang saat beraktivitas berat.',
                'status' => 'Menunggu'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['no' => '003'],
            [
                'id_pendaftaran' => 'P003',
                'tanggal' => '2026-05-09',
                'nomor_antrean' => '003',
                'hari' => 'Selasa',
                'jam' => '09:15',
                'nik' => '102397102370',
                'email' => 'dang@gmail.com',
                'no_hp' => '081231241030',
                'pasien' => 'Dadang',
                'dokter' => 'dr. Joli',
                'poli' => 'Poli Gigi',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1985-09-25',
                'alamat' => 'Bantul',
                'keluhan' => 'Gigi geraham belakang kanan bawah berlubang besar dan terasa sangat linu ketika dipakai makan manis atau minum air dingin.',
                'status' => 'Menunggu'
            ]
        );

        // 7. Data Antrean (Queue Beranda Pegawai)
        Antrean::updateOrCreate(
            ['nomor_antrean' => 'U505', 'tanggal' => '2026-06-09'],
            ['pasien' => 'Wanti Wanti', 'poli' => 'Poli Umum', 'dokter' => 'dr. Saepul', 'jam' => '08:00', 'status' => 'Dipanggil']
        );
        Antrean::updateOrCreate(
            ['nomor_antrean' => 'G666', 'tanggal' => '2026-06-09'],
            ['pasien' => 'Rino Bleber', 'poli' => 'Poli Gigi', 'dokter' => 'dr. Indi', 'jam' => '16:00', 'status' => 'Menunggu']
        );
        Antrean::updateOrCreate(
            ['nomor_antrean' => 'B871', 'tanggal' => '2026-06-09'],
            ['pasien' => 'Dadang', 'poli' => 'Poli Bedah', 'dokter' => 'dr. Joli', 'jam' => '08:30', 'status' => 'Menunggu']
        );
        Antrean::updateOrCreate(
            ['nomor_antrean' => 'A645', 'tanggal' => '2026-06-09'],
            ['pasien' => 'Ujang', 'poli' => 'Poli Anak', 'dokter' => 'dr. Huru Hara', 'jam' => '12:00', 'status' => 'Menunggu']
        );
        Antrean::updateOrCreate(
            ['nomor_antrean' => 'B143', 'tanggal' => '2026-06-09'],
            ['pasien' => 'Udang Keju', 'poli' => 'Poli Bedah', 'dokter' => 'dr. Pardede', 'jam' => '09:00', 'status' => 'Selesai']
        );
    }
}