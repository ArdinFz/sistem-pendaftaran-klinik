<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Pegawai;
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
        // 1. Akun Default (Admin, Pegawai)
        Admin::updateOrCreate(
            ['id_admin' => 'ADM001'],
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'Nama' => 'Ketoprak',
                'no_hp' => '08123456789',
            ]
        );

        Admin::updateOrCreate(
            ['id_admin' => 'ADM002'],
            [
                'email' => 'abdi@gmail.com',
                'password' => Hash::make('klinik123'),
                'Nama' => 'Abdi',
                'no_hp' => '08123456701',
            ]
        );

        Pegawai::updateOrCreate(
            ['id_pegawai' => 'PGW001'],
            [
                'email' => 'nadia@gmail.com',
                'password' => Hash::make('klinik123'),
                'nama_pegawai' => 'Nadia',
                'no_hp' => '08123456702',
            ]
        );

        Pegawai::updateOrCreate(
            ['id_pegawai' => 'PGW002'],
            [
                'email' => 'pegawai@gmail.com',
                'password' => Hash::make('pegawai123'),
                'nama_pegawai' => 'Pegawai Default',
                'no_hp' => '08123456799',
            ]
        );

        // 2. Data Master Poliklinik
        Poliklinik::updateOrCreate(
            ['id_poli' => 'PL01'],
            ['nama_poli' => 'Poli Umum', 'deskripsi_poli' => 'Pelayanan Kesehatan Umum']
        );
        Poliklinik::updateOrCreate(
            ['id_poli' => 'PL02'],
            ['nama_poli' => 'Poli Gigi', 'deskripsi_poli' => 'Pemeriksaan dan Perawatan Gigi']
        );
        Poliklinik::updateOrCreate(
            ['id_poli' => 'PL03'],
            ['nama_poli' => 'Poli Anak', 'deskripsi_poli' => 'Layanan Kesehatan Anak']
        );
        Poliklinik::updateOrCreate(
            ['id_poli' => 'PL04'],
            ['nama_poli' => 'Poli Bedah', 'deskripsi_poli' => 'Pemeriksaan dan Operasi Ringan']
        );

        // 3. Data Master Dokter
        Dokter::updateOrCreate(
            ['id_dokter' => 'DK001'],
            ['id_poli' => 'PL01', 'nama_dokter' => 'dr. Saepul', 'no_hp' => '08123456789']
        );
        Dokter::updateOrCreate(
            ['id_dokter' => 'DK002'],
            ['id_poli' => 'PL02', 'nama_dokter' => 'dr. Indi', 'no_hp' => '0812297120']
        );
        Dokter::updateOrCreate(
            ['id_dokter' => 'DK003'],
            ['id_poli' => 'PL03', 'nama_dokter' => 'dr. Huru Hara', 'no_hp' => '08123456781']
        );
        Dokter::updateOrCreate(
            ['id_dokter' => 'DK004'],
            ['id_poli' => 'PL04', 'nama_dokter' => 'dr. Pardede', 'no_hp' => '08123456783']
        );
        Dokter::updateOrCreate(
            ['id_dokter' => 'DK005'],
            ['id_poli' => 'PL02', 'nama_dokter' => 'dr. Joli', 'no_hp' => '08123456784']
        );

        // 4. Data Master Jadwal Dokter
        JadwalDokter::updateOrCreate(
            ['id_jadwal' => 1],
            ['id_dokter' => 'DK001', 'tanggal' => '2026-06-08 00:00:00', 'jam_mulai' => '08:00:00', 'jam_selesai' => '10:00:00', 'kuota' => 20]
        );
        JadwalDokter::updateOrCreate(
            ['id_jadwal' => 2],
            ['id_dokter' => 'DK002', 'tanggal' => '2026-06-10 00:00:00', 'jam_mulai' => '08:30:00', 'jam_selesai' => '12:00:00', 'kuota' => 10]
        );
        JadwalDokter::updateOrCreate(
            ['id_jadwal' => 3],
            ['id_dokter' => 'DK003', 'tanggal' => '2026-06-10 00:00:00', 'jam_mulai' => '08:00:00', 'jam_selesai' => '11:00:00', 'kuota' => 5]
        );
        JadwalDokter::updateOrCreate(
            ['id_jadwal' => 4],
            ['id_dokter' => 'DK004', 'tanggal' => '2026-06-12 00:00:00', 'jam_mulai' => '13:00:00', 'jam_selesai' => '14:00:00', 'kuota' => 15]
        );
        JadwalDokter::updateOrCreate(
            ['id_jadwal' => 5],
            ['id_dokter' => 'DK005', 'tanggal' => '2026-06-10 00:00:00', 'jam_mulai' => '10:00:00', 'jam_selesai' => '11:00:00', 'kuota' => 10]
        );

        // 5. Data Master Pasien
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS001'],
            [
                'nik' => '3273010505050005',
                'email' => 'pasien@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Udang Keju',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1999-02-18',
                'no_hp' => '0852497264',
                'alamat' => 'Bantul',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS002'],
            [
                'nik' => '3273010202020002',
                'email' => 'rino@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Rino Bleber',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1992-06-14',
                'no_hp' => '081237192030',
                'alamat' => 'Yogyakarta',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS003'],
            [
                'nik' => '3273010303030003',
                'email' => 'dadang@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Dadang',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1985-09-25',
                'no_hp' => '081231241030',
                'alamat' => 'Bantul',
                'foto' => null
            ]
        );

        // 6. Data Pendaftaran (Registrasi)
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P001'],
            [
                'id_user' => 'PAS001',
                'id_jadwal' => 4,
                'tanggal_daftar' => '2026-05-08 12:00:00',
                'keluhan' => 'Gak tau dog, kayaknya flu deh ini dog, kemarin demam gitu dog, cuma sekarang sembuh dog, cuma kadang kejang-kejang juga dog, gimana ya dog? sembuhin atuh dog, dog kan dogter!',
                'status' => 'Selesai'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P002'],
            [
                'id_user' => 'PAS002',
                'id_jadwal' => 2,
                'tanggal_daftar' => '2026-05-08 08:00:00',
                'keluhan' => 'Sakit kepala sebelah kanan saja sejak kemarin pagi, kepala terasa seperti berdenyut-denyut kencang saat beraktivitas berat.',
                'status' => 'Menunggu'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P003'],
            [
                'id_user' => 'PAS003',
                'id_jadwal' => 5,
                'tanggal_daftar' => '2026-05-09 09:15:00',
                'keluhan' => 'Gigi geraham belakang kanan bawah berlubang besar dan terasa sangat linu ketika dipakai makan manis atau minum air dingin.',
                'status' => 'Menunggu'
            ]
        );

        // 7. Data Antrean (Queue Beranda Pegawai)
        Antrean::updateOrCreate(
            ['id_antrean' => 'ANT001'],
            [
                'id_pendaftaran' => 'P001',
                'nomor_antrean' => 143,
                'status_antrean' => 'Selesai',
                'waktu_antrean' => '09:00:00'
            ]
        );
        Antrean::updateOrCreate(
            ['id_antrean' => 'ANT002'],
            [
                'id_pendaftaran' => 'P002',
                'nomor_antrean' => 666,
                'status_antrean' => 'Menunggu',
                'waktu_antrean' => '16:00:00'
            ]
        );
        Antrean::updateOrCreate(
            ['id_antrean' => 'ANT003'],
            [
                'id_pendaftaran' => 'P003',
                'nomor_antrean' => 871,
                'status_antrean' => 'Menunggu',
                'waktu_antrean' => '08:30:00'
            ]
        );
    }
}