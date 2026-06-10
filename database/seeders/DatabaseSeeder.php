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
                'nik' => '1234567890123456',
                'email' => 'wira@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Wira Sonic',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2005-05-25',
                'no_hp' => '0852497264',
                'alamat' => 'Jalan Asoman',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS002'],
            [
                'nik' => '0987123432000000',
                'email' => 'galang@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Galang Rading',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1999-06-21',
                'no_hp' => '089621327113',
                'alamat' => 'Gg. Kasih Mandiri',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS003'],
            [
                'nik' => '3273010101010003',
                'email' => 'joki@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Joki',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2001-04-12',
                'no_hp' => '08123456703',
                'alamat' => 'Yogyakarta',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS004'],
            [
                'nik' => '1082301982301823',
                'email' => 'wanti@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Wanti Wanti',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1990-05-13',
                'no_hp' => '0819291209302',
                'alamat' => 'Sleman',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS005'],
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
            ['id_pasien' => 'PAS006'],
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
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS007'],
            [
                'nik' => '3273010404040004',
                'email' => 'ujang@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Ujang',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2015-11-30',
                'no_hp' => '08123456782',
                'alamat' => 'Kulon Progo',
                'foto' => null
            ]
        );
        Pasien::updateOrCreate(
            ['id_pasien' => 'PAS008'],
            [
                'nik' => '3273010505050005',
                'email' => 'udangkeju@gmail.com',
                'password' => Hash::make('pasien123'),
                'nama' => 'Udang Keju',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1999-02-18',
                'no_hp' => '081237192434',
                'alamat' => 'Bantul',
                'foto' => null
            ]
        );

        // 6. Data Pendaftaran (Registrasi)
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P001'],
            [
                'id_user' => 'PAS008',
                'id_jadwal' => 4,
                'tanggal_daftar' => '2026-05-08 12:00:00',
                'keluhan' => 'Gak tau dog, kayaknya flu deh ini dog, kemarin demam gitu dog, cuma sekarang sembuh dog, cuma kadang kejang-kejang juga dog, gimana ya dog? sembuhin atuh dog, dog kan dogter!',
                'status' => 'Selesai'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P002'],
            [
                'id_user' => 'PAS005',
                'id_jadwal' => 2,
                'tanggal_daftar' => '2026-05-08 08:00:00',
                'keluhan' => 'Sakit kepala sebelah kanan saja sejak kemarin pagi, kepala terasa seperti berdenyut-denyut kencang saat beraktivitas berat.',
                'status' => 'Menunggu'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P003'],
            [
                'id_user' => 'PAS006',
                'id_jadwal' => 5,
                'tanggal_daftar' => '2026-05-09 09:15:00',
                'keluhan' => 'Gigi geraham belakang kanan bawah berlubang besar dan terasa sangat linu ketika dipakai makan manis atau minum air dingin.',
                'status' => 'Menunggu'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P004'],
            [
                'id_user' => 'PAS004',
                'id_jadwal' => 1,
                'tanggal_daftar' => '2026-05-08 08:00:00',
                'keluhan' => 'Badan meriang gatal-gatal di seluruh tubuh sejak kemarin malam setelah makan kepiting.',
                'status' => 'Dipanggil'
            ]
        );
        Pendaftaran::updateOrCreate(
            ['id_pendaftaran' => 'P005'],
            [
                'id_user' => 'PAS007',
                'id_jadwal' => 3,
                'tanggal_daftar' => '2026-05-09 12:00:00',
                'keluhan' => 'Badan anak demam naik turun sejak 3 hari lalu, pilek mampet, batuk berdahak, serta tidak mau makan sama sekali.',
                'status' => 'Menunggu'
            ]
        );

        // 7. Data Antrean (Queue Beranda Pegawai)
        Antrean::updateOrCreate(
            ['id_antrean' => 'ANT001'],
            [
                'id_pendaftaran' => 'P004',
                'nomor_antrean' => 505,
                'status_antrean' => 'Dipanggil',
                'waktu_antrean' => '08:00:00'
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
        Antrean::updateOrCreate(
            ['id_antrean' => 'ANT004'],
            [
                'id_pendaftaran' => 'P005',
                'nomor_antrean' => 645,
                'status_antrean' => 'Menunggu',
                'waktu_antrean' => '12:00:00'
            ]
        );
        Antrean::updateOrCreate(
            ['id_antrean' => 'ANT005'],
            [
                'id_pendaftaran' => 'P001',
                'nomor_antrean' => 143,
                'status_antrean' => 'Selesai',
                'waktu_antrean' => '09:00:00'
            ]
        );
    }
}