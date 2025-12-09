<?php


declare(strict_types=1);

namespace Com\Daw2\Tests;

use Com\Daw2\Controllers\EmpleadosController;
use PHPUnit\Framework\TestCase;

class EmpleadosControllerTest extends TestCase
{
    public function testAltaFallaPorErrores()
    {
        $empleadoController = new EmpleadosController();

        $postDataInvalida = [
            'nombre' => 'J1',
            'email' => 'email_invalido',
            'pass' => '123',
            'pass2' => '1234',
            'telefono' => '123',
            'id_rol' => '99',
            'id_pais' => 'País Con Número 1'
        ];

        $reflection = new \ReflectionMethod(EmpleadosController::class, 'checkErroresAlta');
        $reflection->setAccessible(true);
        $errors = $reflection->invoke($empleadoController, $postDataInvalida, false);

        $this->assertArrayHasKey('nombre', $errors, "Falta el error de nombre.");
        $this->assertArrayHasKey('email', $errors, "Falta el error de email.");
        $this->assertArrayHasKey('telefono', $errors, "Falta el error de teléfono.");
        $this->assertArrayHasKey('pass', $errors, "Falta el error de contraseña no coincidente.");
        $this->assertArrayHasKey('pass2', $errors, "Falta el error de confirmación de contraseña no coincidente.");
        $this->assertArrayHasKey('id_rol', $errors, "Falta el error de rol inválido.");
        $this->assertArrayHasKey('id_pais', $errors, "Falta el error de país inválido.");
        $this->assertCount(7, $errors, "Se esperaban 7 errores de validación.");
    }
}