use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\TipoTramite;
use PHPUnit\Framework\Attributes\Test;

class TramiteCrudTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function puede_crear_un_tramite(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/tramites', [
            'nombre' => 'Licencia de Funcionamiento',
            'descripcion' => 'Otorgamiento de licencias comerciales',
        ]);

        $response->assertStatus(302); // redirección después de guardar
        $this->assertDatabaseHas('tipo_tramites', ['nombre' => 'Licencia de Funcionamiento']);
    }
}
