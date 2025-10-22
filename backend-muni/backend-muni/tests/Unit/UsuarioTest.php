<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UsuarioTest extends TestCase
{
    /** @test */
    public function puede_crear_un_usuario()
    {
        $usuario = new User([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => bcrypt('123456')
        ]);

        $this->assertEquals('Juan Pérez', $usuario->name);
        $this->assertEquals('juan@example.com', $usuario->email);
        $this->assertTrue(password_verify('123456', $usuario->password));
    }

    /** @test */
    public function el_usuario_tiene_un_email_valido()
    {
        $usuario = new User(['email' => 'test@example.com']);
        $this->assertMatchesRegularExpression('/^.+@.+\..+$/', $usuario->email);
    }
}
