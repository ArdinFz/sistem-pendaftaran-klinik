<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PegawaiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed the database to ensure we have the default accounts
        $this->seed();
    }

    public function test_pegawai_can_login_and_redirect_to_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'nadia@gmail.com',
            'password' => 'klinik123',
        ]);

        $response->assertRedirect(route('pegawai.dashboard'));
    }

    public function test_unauthenticated_user_cannot_access_pegawai_dashboard(): void
    {
        $response = $this->get(route('pegawai.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_pegawai_can_access_dashboard_and_see_queue(): void
    {
        $pegawai = User::where('role', 'pegawai')->first();

        $response = $this->actingAs($pegawai)
            ->get(route('pegawai.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Wanti Wanti');
        $response->assertSee('Rino Bleber');
        $response->assertSee('Dadang');
        $response->assertSee('Ujang');
        $response->assertSee('Udang Keju');
    }

    public function test_pegawai_can_panggil_patient(): void
    {
        $pegawai = User::where('role', 'pegawai')->first();

        // 3 is Dadang (status Menunggu by default)
        $response = $this->actingAs($pegawai)
            ->post(route('pegawai.dashboard.panggil', 3));

        $response->assertRedirect(route('pegawai.dashboard'));
        $response->assertSessionHas('success');

        // Check if status updated in session
        $antreans = session('antrean_list');
        $dadang = collect($antreans)->firstWhere('id', 3);
        $this->assertEquals('Dipanggil', $dadang['status']);
    }

    public function test_pegawai_can_selesai_patient(): void
    {
        $pegawai = User::where('role', 'pegawai')->first();

        // 3 is Dadang
        $response = $this->actingAs($pegawai)
            ->post(route('pegawai.dashboard.selesai', 3));

        $response->assertRedirect(route('pegawai.dashboard'));
        $response->assertSessionHas('success');

        // Check if status updated in session
        $antreans = session('antrean_list');
        $dadang = collect($antreans)->firstWhere('id', 3);
        $this->assertEquals('Selesai', $dadang['status']);
    }

    public function test_pegawai_can_access_pendaftaran(): void
    {
        $pegawai = User::where('role', 'pegawai')->first();

        $response = $this->actingAs($pegawai)
            ->get(route('pegawai.pendaftaran.index'));

        $response->assertStatus(200);
        $response->assertSee('Data Pendaftaran');
        $response->assertSee('Wanti Wanti');
    }
}
