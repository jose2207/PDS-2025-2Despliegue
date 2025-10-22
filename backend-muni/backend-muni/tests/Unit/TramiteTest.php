<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TipoTramite;


class TramiteTest extends TestCase
{
    /** @test */
    public function puede_instanciar_tipo_tramite_correctamente()
    {
        $tramite = new TipoTramite([
            'nombre' => 'Licencia de Construcción',
            'descripcion' => 'Trámite para obtener licencia municipal',
        ]);

        $this->assertEquals('Licencia de Construcción', $tramite->nombre);
        $this->assertEquals('Trámite para obtener licencia municipal', $tramite->descripcion);
    }
}
