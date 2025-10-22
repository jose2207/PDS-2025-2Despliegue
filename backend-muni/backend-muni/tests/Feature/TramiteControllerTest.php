<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\TipoTramite;

class TramiteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_tipo_tramite()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/tipos-tramite', [
            'nombre' => 'Licencia de Construcción',
            'descripcion' => 'Trámite para obtener licencia municipal',
        ]);

        $response->assertStatus(302); // redirección tras guardar
        $this->assertDatabaseHas('tipo_tramites', [
            'nombre' => 'Licencia de Construcción',
        ]);
    }

    /** @test */
    public function puede_listar_los_tipos_de_tramite()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        TipoTramite::factory()->count(3)->create();

        $response = $this->get('/tipos-tramite');
        $response->assertStatus(200);
        $this->assertCount(3, TipoTramite::all());
    }

    /** @test */
    public function puede_actualizar_un_tipo_tramite()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $tramite = TipoTramite::create([
            'nombre' => 'Licencia de Negocio',
            'descripcion' => 'Trámite para abrir un negocio',
        ]);

        $response = $this->put("/tipos-tramite/{$tramite->id}", [
            'nombre' => 'Licencia Comercial',
            'descripcion' => 'Trámite actualizado',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tipo_tramites', [
            'nombre' => 'Licencia Comercial',
        ]);
    }

    /** @test */
    public function puede_eliminar_un_tipo_tramite()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $tramite = TipoTramite::create([
            'nombre' => 'Licencia Temporal',
            'descripcion' => 'Trámite temporal para eventos',
        ]);

        $response = $this->delete("/tipos-tramite/{$tramite->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('tipo_tramites', [
            'nombre' => 'Licencia Temporal',
        ]);
    }
}
