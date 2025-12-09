<?php

declare(strict_types=1);

namespace Com\Daw2\Tests;

use Com\Daw2\Controllers\ClienteController;
use PHPUnit\Framework\TestCase;

class ClienteControllerTest extends TestCase
{
    private ClienteController $clienteController;

    protected function setUp(): void
    {
        $this->clienteController = new ClienteController();

        $_SESSION = [];
        $_POST = [];
        $_GET = [];
    }

    /** @test */
    public function testPermisosAdmin()
    {
        $expectedPermisos = [
            'inicioTaller'=>'rwd',
            'empleados'=>'rwd',
            'vehiculos'=>'rwd',
            'reservas'=>'rwd',
            'facturacion'=>'rwd'
        ];

        $result = $this->clienteController->permisos(1);

        $this->assertEquals($expectedPermisos, $result, "Los permisos para el Rol 1 no son correctos.");
    }

    /** @test */
    public function testRegistroFallaSinDatos()
    {
        $postData = [
            'nombre' => '',
            'email' => '',
            'pass' => '',
            'telefono' => '',
            'direccion' => ''
        ];

        $reflection = new \ReflectionMethod(ClienteController::class, 'checkErrorsRegister');
        $reflection->setAccessible(true);
        $errors = $reflection->invoke($this->clienteController, $postData);

        $this->assertEquals("Datos incorrectos", $errors, "Se esperaba un error por nombre vacío.");
    }

    /** @test */
    public function testLoginValido()
    {
        $postData = [
            'email' => 'usuario_valido@dominio.com',
            'pass' => 'MiPassSecreto123'
        ];

        $reflection = new \ReflectionMethod(ClienteController::class, 'checkErrors');
        $reflection->setAccessible(true);
        $errors = $reflection->invoke($this->clienteController, $postData);

        $this->assertEmpty($errors, "No se esperaban errores para credenciales que cumplen el formato.");
    }

}