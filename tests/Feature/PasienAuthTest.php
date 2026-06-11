<?php

namespace Tests\Feature;

use App\Models\Pasien;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasienAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \Carbon\Carbon::setTestNow('2026-06-11 14:11:49');
        // Seed the database to ensure we have default master data
        $this->seed();
    }

    protected function tearDown(): void
    {
        \Carbon\Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_pasien_can_view_welcome_page(): void
    {
        $response = $this->get(route('pasien.welcome'));
        $response->assertStatus(200);
        $response->assertSee('Klinik Tadika Mesra');
        $response->assertSee('Masuk');
        $response->assertSee('Daftar');
    }

    public function test_pasien_can_view_login_page(): void
    {
        $response = $this->get(route('pasien.login'));
        $response->assertStatus(200);
        $response->assertSee('Email/Nomor Hp');
        $response->assertSee('Password');
        $response->assertSee('nurse_patient.png');
    }

    public function test_pasien_can_view_register_page(): void
    {
        $response = $this->get(route('pasien.register'));
        $response->assertStatus(200);
        $response->assertSee('Registrasi Akun');
        $response->assertSee('NIK');
        $response->assertSee('Email/Nomor Hp');
        $response->assertSee('Nama Lengkap');
        $response->assertSee('Tanggal Lahir');
    }

    public function test_pasien_can_register_new_account_with_email(): void
    {
        $response = $this->post(route('pasien.register.post'), [
            'nik' => '9999999999999999',
            'email_phone' => 'budi@gmail.com',
            'nama' => 'Budi Luhur',
            'tanggal_lahir' => '2000-01-01',
            'password' => 'budi123',
            'password_confirmation' => 'budi123',
        ]);

        $response->assertRedirect(route('pasien.login'));
        $response->assertSessionHas('success');

        // Check if database record created with generated ID PAS004 (since 3 are seeded)
        $this->assertDatabaseHas('pasiens', [
            'id_pasien' => 'PAS004',
            'nik' => '9999999999999999',
            'email' => 'budi@gmail.com',
            'nama' => 'Budi Luhur',
            'tanggal_lahir' => '2000-01-01',
        ]);
    }

    public function test_pasien_can_register_new_account_with_phone(): void
    {
        $response = $this->post(route('pasien.register.post'), [
            'nik' => '8888888888888888',
            'email_phone' => '08987654321',
            'nama' => 'Ani Lestari',
            'tanggal_lahir' => '1995-12-12',
            'password' => 'ani12345',
            'password_confirmation' => 'ani12345',
        ]);

        $response->assertRedirect(route('pasien.login'));
        $response->assertSessionHas('success');

        // Check if phone was saved to no_hp and auto-generated email was created
        $this->assertDatabaseHas('pasiens', [
            'id_pasien' => 'PAS004',
            'nik' => '8888888888888888',
            'no_hp' => '08987654321',
            'email' => '8888888888888888@gmail.com',
            'nama' => 'Ani Lestari',
        ]);
    }

    public function test_pasien_can_login_with_email(): void
    {
        // Pasien PAS001 (pasien@gmail.com) is seeded in DatabaseSeeder
        $response = $this->post(route('pasien.login.post'), [
            'email_phone' => 'pasien@gmail.com',
            'password' => 'pasien123',
        ]);

        $response->assertRedirect(route('pasien.dashboard'));
        $this->assertTrue(auth()->guard('pasien')->check());
        $this->assertEquals('PAS001', auth()->guard('pasien')->id());
    }

    public function test_pasien_can_login_with_phone(): void
    {
        // Pasien PAS001 (wira@gmail.com, phone 0852497264)
        $response = $this->post(route('pasien.login.post'), [
            'email_phone' => '0852497264',
            'password' => 'pasien123',
        ]);

        $response->assertRedirect(route('pasien.dashboard'));
        $this->assertTrue(auth()->guard('pasien')->check());
    }

    public function test_unauthenticated_pasien_cannot_access_dashboard(): void
    {
        $response = $this->get(route('pasien.dashboard'));
        $response->assertRedirect(route('pasien.login'));
    }

    public function test_authenticated_pasien_can_access_dashboard(): void
    {
        $pasien = Pasien::first(); // PAS001
        $response = $this->actingAs($pasien, 'pasien')->get(route('pasien.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Halo, ' . $pasien->nama);
        $response->assertSee($pasien->nik);
    }

    public function test_pasien_can_view_home_page(): void
    {
        $response = $this->get(route('pasien.home'));
        $response->assertStatus(200);
        $response->assertSee('Klinik Tadika Mesra');
        $response->assertSee('Antrean Online');
    }

    public function test_pasien_can_logout(): void
    {
        $pasien = Pasien::first(); // PAS001
        $response = $this->actingAs($pasien, 'pasien')->post(route('pasien.logout'));
        
        $response->assertRedirect(route('pasien.home'));
        $this->assertFalse(auth()->guard('pasien')->check());
    }

    public function test_pasien_can_view_forgot_password_page(): void
    {
        $response = $this->get(route('pasien.password.forgot'));
        $response->assertStatus(200);
        $response->assertSee('Lupa Password?');
        $response->assertSee('AKsokwosaksk gabisa masuk akun luwh');
        $response->assertSee('Email/Nomor Hp');
        $response->assertSee('Kirim Kode');
        $response->assertSee('ya ngapain atuh pencet "Lupa Kata Sandi?"', false);
    }

    public function test_pasien_can_submit_forgot_password_email_phone(): void
    {
        $response = $this->post(route('pasien.password.forgot.send'), [
            'email_phone' => 'pasien@gmail.com',
        ]);
        $response->assertRedirect(route('pasien.password.forgot.verify'));
        $response->assertSessionHas('pasien_reset_email_phone', 'pasien@gmail.com');
    }

    public function test_pasien_cannot_view_otp_page_without_submitting_forgot_password(): void
    {
        $response = $this->get(route('pasien.password.forgot.verify'));
        $response->assertRedirect(route('pasien.password.forgot'));
    }

    public function test_pasien_can_view_otp_page_with_session(): void
    {
        $response = $this->withSession(['pasien_reset_email_phone' => 'pasien@gmail.com'])
            ->get(route('pasien.password.forgot.verify'));
        $response->assertStatus(200);
        $response->assertSee('Verifikasi OTP');
        $response->assertSee('Cek email atau nomor hp kang!');
        $response->assertSee('Ada kode yang bisa ditaruh sini');
        $response->assertSee('Periksa');
        $response->assertSee('ASKowksok gabisa masuk');
    }

    public function test_pasien_can_submit_otp_code(): void
    {
        $response = $this->withSession(['pasien_reset_email_phone' => 'pasien@gmail.com'])
            ->post(route('pasien.password.forgot.verify.check'), [
                'otp' => ['5', '1', '0', '9'],
            ]);
        $response->assertRedirect(route('pasien.password.forgot.reset'));
    }

    public function test_pasien_cannot_view_reset_password_page_without_session(): void
    {
        $response = $this->get(route('pasien.password.forgot.reset'));
        $response->assertRedirect(route('pasien.password.forgot'));
    }

    public function test_pasien_can_view_reset_password_page_with_session(): void
    {
        $response = $this->withSession(['pasien_reset_email_phone' => 'pasien@gmail.com'])
            ->get(route('pasien.password.forgot.reset'));
        $response->assertStatus(200);
        $response->assertSee('Buat Password Baru');
        $response->assertSee('Ribet ya? makanya ingat-ingat password kocak!, dasar ingatan tua bangka !');
        $response->assertSee('Password');
        $response->assertSee('Konfirmasi Password');
        $response->assertSee('Simpan Password');
    }

    public function test_pasien_can_reset_password_successfully(): void
    {
        // pasien@gmail.com is seeded in DatabaseSeeder
        $response = $this->withSession(['pasien_reset_email_phone' => 'pasien@gmail.com'])
            ->post(route('pasien.password.forgot.reset.save'), [
                'password' => 'newpassword123',
                'password_confirmation' => 'newpassword123',
            ]);
        $response->assertRedirect(route('pasien.login'));
        $response->assertSessionHas('success', 'Kata sandi berhasil disetel ulang. Silakan masuk kembali.');
        $response->assertSessionMissing('pasien_reset_email_phone');

        // Check if database updated password
        $responseLogin = $this->post(route('pasien.login.post'), [
            'email_phone' => 'pasien@gmail.com',
            'password' => 'newpassword123',
        ]);
        $responseLogin->assertRedirect(route('pasien.dashboard'));
        $this->assertTrue(auth()->guard('pasien')->check());
    }

    public function test_authenticated_pasien_can_fetch_doctor_schedules_via_ajax(): void
    {
        $pasien = Pasien::first(); // PAS001
        // Seeded poliklinik PL01 is Poli Umum
        $response = $this->actingAs($pasien, 'pasien')->get(route('pasien.get-schedules', [
            'id_poli' => 'PL01',
            'tanggal' => '2026-06-08',
        ]));
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nama_dokter' => 'dr. Saepul',
            'jam_mulai' => '08:00',
        ]);
    }

    public function test_authenticated_pasien_can_submit_valid_pendaftaran_to_database(): void
    {
        $pasien = Pasien::first(); // PAS001
        // id_jadwal 1 is DK001 (dr. Saepul) on 2026-06-08
        $response = $this->actingAs($pasien, 'pasien')->post(route('pasien.pendaftaran.store'), [
            'id_jadwal' => 1,
            'tanggal_daftar' => '2026-06-08',
            'keluhan' => 'Demam dan sakit kepala selama dua hari.',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'poli' => 'Poli Umum',
            'dokter' => 'dr. Saepul',
        ]);

        // Verify database records are created
        $this->assertDatabaseHas('pendaftarans', [
            'id_user' => $pasien->id_pasien,
            'id_jadwal' => 1,
            'keluhan' => 'Demam dan sakit kepala selama dua hari.',
            'status' => 'Menunggu',
        ]);

        $this->assertDatabaseHas('antreans', [
            'status_antrean' => 'Menunggu',
            'waktu_antrean' => '08:00:00',
        ]);
    }

    public function test_pasien_and_guest_can_access_layanan_klinik_page(): void
    {
        // Test as Guest
        $response = $this->get(route('pasien.layanan'));
        $response->assertStatus(200);
        $response->assertSee('Daftar Poli');
        $response->assertSee('Poli Umum');
        $response->assertSee('Poli Gigi');
        $response->assertSee('poli_umum.png');
        $response->assertSee('poli_gigi.png');

        // Test as Authenticated Pasien
        $pasien = Pasien::first(); // PAS001
        $responseAuth = $this->actingAs($pasien, 'pasien')->get(route('pasien.layanan'));
        $responseAuth->assertStatus(200);
        $responseAuth->assertSee('Daftar Poli');
    }

    public function test_pasien_and_guest_can_access_layanan_umum_detail_page(): void
    {
        // Test as Guest
        $response = $this->get(route('pasien.layanan.umum'));
        $response->assertStatus(200);
        $response->assertSee('Poli Umum');
        $response->assertSee('doctor_patient.png');
        $response->assertSee('dr. Ryan Kongkap');
        $response->assertSee('dr. Ibnu Rujak');
        $response->assertSee('Jadwal Layanan');

        // Test as Authenticated Pasien
        $pasien = Pasien::first(); // PAS001
        $responseAuth = $this->actingAs($pasien, 'pasien')->get(route('pasien.layanan.umum'));
        $responseAuth->assertStatus(200);
        $responseAuth->assertSee('Poli Umum');
    }

    public function test_pasien_and_guest_can_access_cara_daftar_page(): void
    {
        // Test as Guest
        $response = $this->get(route('pasien.cara-daftar'));
        $response->assertStatus(200);
        $response->assertSee('Cara Daftar');
        $response->assertSee('Cara Daftar Antrean Online');
        $response->assertSee('Buat akun, tekan tombol “Daftar”');
        $response->assertSee('doctor_patient.png');

        // Test as Authenticated Pasien
        $pasien = Pasien::first(); // PAS001
        $responseAuth = $this->actingAs($pasien, 'pasien')->get(route('pasien.cara-daftar'));
        $responseAuth->assertStatus(200);
        $responseAuth->assertSee('Cara Daftar');
    }

    public function test_pasien_and_guest_can_access_tentang_klinik_page(): void
    {
        // Test as Guest
        $response = $this->get(route('pasien.tentang-klinik'));
        $response->assertStatus(200);
        $response->assertSee('Tentang Klinik');
        $response->assertSee('Klinik Bombardiro Crocodilo');
        $response->assertSee('Menjadi klinik pelayanan kesehatan yang memberikan layanan medis');
        $response->assertSee('Misi');
        $response->assertSee('08:00 - 20:00 WIB');
        $response->assertSee('Jl. Cibaduyut, Kecamatan Pesugihan');
        $response->assertSee('maps.png');
        $response->assertSee('Instagram : klinik_bombardirocrocodilo');

        // Test as Authenticated Pasien
        $pasien = Pasien::first(); // PAS001
        $responseAuth = $this->actingAs($pasien, 'pasien')->get(route('pasien.tentang-klinik'));
        $responseAuth->assertStatus(200);
        $responseAuth->assertSee('Tentang Klinik');
    }

    public function test_pasien_and_guest_can_access_tips_kesehatan_pages(): void
    {
        // Test List Page as Guest
        $response = $this->get(route('pasien.tips-kesehatan'));
        $response->assertStatus(200);
        $response->assertSee('Tips Kesehatan');
        $response->assertSee('Terlalu Sering Begadang?');
        $response->assertSee('tips_begadang.png');

        // Test Detail Page as Guest
        $responseDetail = $this->get(route('pasien.tips-kesehatan.begadang'));
        $responseDetail->assertStatus(200);
        $responseDetail->assertSee('Terlalu Sering Begadang?');
        $responseDetail->assertSee('1. Sulit Konsentrasi');
        $responseDetail->assertSee('2. Rentan Mengalami Kecelakaan');
        $responseDetail->assertSee('3. Munculnya Penyakit Serius');
        $responseDetail->assertSee('Stroke;');
        $responseDetail->assertSee('Diabetes;');
        $responseDetail->assertSee('tips_begadang.png');

        // Test as Authenticated Pasien
        $pasien = Pasien::first(); // PAS001
        $responseAuth = $this->actingAs($pasien, 'pasien')->get(route('pasien.tips-kesehatan'));
        $responseAuth->assertStatus(200);
        $responseAuth->assertSee('Tips Kesehatan');

        $responseAuthDetail = $this->actingAs($pasien, 'pasien')->get(route('pasien.tips-kesehatan.begadang'));
        $responseAuthDetail->assertStatus(200);
        $responseAuthDetail->assertSee('Terlalu Sering Begadang?');
    }

    public function test_pasien_and_guest_can_access_jadwal_dokter_page(): void
    {
        // Test as Guest
        $response = $this->get(route('pasien.jadwal'));
        $response->assertStatus(200);
        $response->assertSee('Jadwal Dokter');
        // Seeded dates are 2026-06-08 (Senin), 2026-06-10 (Rabu), 2026-06-12 (Jumat)
        $response->assertSee('Sen');
        $response->assertSee('08 Jun');
        $response->assertSee('Rab');
        $response->assertSee('10 Jun');
        $response->assertSee('Jum');
        $response->assertSee('12 Jun');
        // Saepul is on 2026-06-08
        $response->assertSee('dr. Saepul');
        $response->assertSee('Poli Umum');
        $response->assertSee('08:00 - 10:00');

        // Test as Authenticated Pasien
        $pasien = Pasien::first(); // PAS001
        $responseAuth = $this->actingAs($pasien, 'pasien')->get(route('pasien.jadwal'));
        $responseAuth->assertStatus(200);
        $responseAuth->assertSee('Jadwal Dokter');
        $responseAuth->assertSee('dr. Saepul');
    }
}

