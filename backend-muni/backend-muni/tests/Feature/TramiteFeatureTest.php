<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\TipoTramite;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TramiteFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_autenticado_puede_listar_tramites()
    {
        $user = User::factory()->create();
        TipoTramite::factory()->create(['nombre' => 'Trámite de Prueba']);

        $response = $this->actingAs($user)->get('/tramites');

        $response->assertStatus(200);
        $response->assertSee('Trámite de Prueba');
    }

    /** @test */
    public function un_usuario_autenticado_puede_crear_un_tramite()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tramites', [
            'nombre' => 'Nuevo Trámite',
            'descripcion' => 'Creación de un nuevo trámite municipal',
        ]);

        $response->assertStatus(302); // redirección después de guardar
        $this->assertDatabaseHas('tipo_tramites', [
            'nombre' => 'Nuevo Trámite',
        ]);
    }
}
