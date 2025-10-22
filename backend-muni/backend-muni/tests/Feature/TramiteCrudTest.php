<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\TipoTramite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TramiteCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_tramite()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tramites', [
            'nombre' => 'Licencia de Funcionamiento',
            'descripcion' => 'Otorgamiento de licencias comerciales'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tipo_tramites', ['nombre' => 'Licencia de Funcionamiento']);
    }

    /** @test */
    public function puede_listar_tramites()
    {
        $user = User::factory()->create();
        TipoTramite::factory()->create(['nombre' => 'Cambio de Razón Social']);

        $response = $this->actingAs($user)->get('/tramites');
        $response->assertStatus(200);
        $response->assertSee('Cambio de Razón Social');
    }

    /** @test */
    public function puede_actualizar_un_tramite()
    {
        $user = User::factory()->create();
        $tramite = TipoTramite::factory()->create(['nombre' => 'Antiguo Nombre']);

        $response = $this->actingAs($user)->put("/tramites/{$tramite->id}", [
            'nombre' => 'Nuevo Nombre'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tipo_tramites', ['nombre' => 'Nuevo Nombre']);
    }

    /** @test */
    public function puede_eliminar_un_tramite()
    {
        $user = User::factory()->create();
        $tramite = TipoTramite::factory()->create();

        $response = $this->actingAs($user)->delete("/tramites/{$tramite->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('tipo_tramites', ['id' => $tramite->id]);
    }
}
