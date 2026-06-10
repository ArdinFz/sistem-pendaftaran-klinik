<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\Antrean;
use App\Models\Pendaftaran;
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
        $pegawai = Pegawai::first();

        $response = $this->actingAs($pegawai, 'pegawai')
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
        $pegawai = Pegawai::first();
        $dadang = Antrean::whereHas('pendaftaran.pasien', function($q) {
            $q->where('nama', 'Dadang');
        })->firstOrFail();

        // Call panggil with Dadang's dynamic ID
        $response = $this->actingAs($pegawai, 'pegawai')
            ->post(route('pegawai.dashboard.panggil', $dadang->id_antrean));

        $response->assertRedirect(route('pegawai.dashboard'));
        $response->assertSessionHas('success');

        // Check if status updated in database
        $this->assertDatabaseHas('antreans', [
            'id_antrean' => $dadang->id_antrean,
            'status_antrean' => 'Dipanggil'
        ]);

        // Check if synchronized status in pendaftarans table (Dadang is Pendaftaran with no '003')
        $this->assertDatabaseHas('pendaftarans', [
            'id_pendaftaran' => 'P003',
            'status' => 'Dipanggil'
        ]);
    }

    public function test_pegawai_can_selesai_patient(): void
    {
        $pegawai = Pegawai::first();
        $dadang = Antrean::whereHas('pendaftaran.pasien', function($q) {
            $q->where('nama', 'Dadang');
        })->firstOrFail();

        // Call selesai with Dadang's dynamic ID
        $response = $this->actingAs($pegawai, 'pegawai')
            ->post(route('pegawai.dashboard.selesai', $dadang->id_antrean));

        $response->assertRedirect(route('pegawai.dashboard'));
        $response->assertSessionHas('success');

        // Check if status updated in database
        $this->assertDatabaseHas('antreans', [
            'id_antrean' => $dadang->id_antrean,
            'status_antrean' => 'Selesai'
        ]);

        // Check if synchronized status in pendaftarans table
        $this->assertDatabaseHas('pendaftarans', [
            'id_pendaftaran' => 'P003',
            'status' => 'Selesai'
        ]);
    }

    public function test_pegawai_can_access_pendaftaran_with_filters(): void
    {
        $pegawai = Pegawai::first();

        // Access index page
        $response = $this->actingAs($pegawai, 'pegawai')
            ->get(route('pegawai.pendaftaran.index'));

        $response->assertStatus(200);
        $response->assertSee('Data Pendaftaran');
        $response->assertSee('Udang Keju');
        $response->assertSee('Rino Bleber');

        // Access with search filter
        $responseFiltered = $this->actingAs($pegawai, 'pegawai')
            ->get(route('pegawai.pendaftaran.index', ['search' => 'Udang']));
        
        $responseFiltered->assertSee('Udang Keju');
        $responseFiltered->assertDontSee('Rino Bleber');

        // Access with poli filter
        $responsePoli = $this->actingAs($pegawai, 'pegawai')
            ->get(route('pegawai.pendaftaran.index', ['poli' => 'Poli Bedah']));
        
        $responsePoli->assertSee('Udang Keju');
        $responsePoli->assertDontSee('Rino Bleber');
    }

    public function test_pegawai_can_view_pendaftaran_detail(): void
    {
        $pegawai = Pegawai::first();

        // Access detail page for 001 (Udang Keju)
        $response = $this->actingAs($pegawai, 'pegawai')
            ->get(route('pegawai.pendaftaran.show', 'P001'));

        $response->assertStatus(200);
        $response->assertSee('Detail Pendaftaran Pasien');
        $response->assertSee('P001');
        $response->assertSee('Udang Keju');
        $response->assertSee('Poli Bedah');
        $response->assertSee('dr. Pardede');
        $response->assertSee('Bantul');
        $response->assertSee('Gak tau dog');
    }
}
