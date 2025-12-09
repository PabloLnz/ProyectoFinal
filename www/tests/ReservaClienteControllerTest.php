<?php

namespace Tests\Com\Daw2\Controllers;

use Com\Daw2\Controllers\ReservaClienteController;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class ReservaClienteControllerTest extends TestCase
{
    private $controller;
    private $idCliente = 10;
    private $manana;
    private $hoy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manana = date('Y-m-d', strtotime('+1 day'));
        $this->hoy = date('Y-m-d');

        $_SESSION['datosUsuario']['id_cliente'] = $this->idCliente;

        $this->controller = new ReservaClienteController();
    }

    private function getValidData(): array
    {
        return [
            'matricula' => '1234 ABC',
            'modelo' => 'X3',
            'anyo' => '2020',
            'fecha_reserva' => $this->manana,
            'hora_reserva' => '14:30',
            'comentariosReserva' => 'Revision de aceite y frenos.',
        ];
    }

    private function callCheckErroresReserva(array $data): array
    {
        $reflection = new ReflectionMethod(ReservaClienteController::class, 'checkErroresReserva');
        $reflection->setAccessible(true);
        return $reflection->invoke($this->controller, $data);
    }

    public function testDatosValidosNoDevuelvenErrores()
    {
        $errors = $this->callCheckErroresReserva($this->getValidData());
        $this->assertEmpty($errors, 'No se esperaban errores con datos válidos.');
    }

    public function testValidacionFallaConTodosLosErroresPosibles()
    {
        $postDataInvalida = [
            'matricula' => 'ABC',
            'modelo' => str_repeat('A', 51),
            'anyo' => '1900',
            'fecha_reserva' => $this->hoy,
            'hora_reserva' => '09:00',
            'comentariosReserva' => str_repeat('B', 501),
        ];

        $errors = $this->callCheckErroresReserva($postDataInvalida);

        $this->assertArrayHasKey('matricula', $errors, "Falta el error de matrícula con formato inválido.");
        $this->assertArrayHasKey('modelo', $errors, "Falta el error de modelo demasiado largo.");
        $this->assertArrayHasKey('anyo', $errors, "Falta el error de año fuera de rango.");
        $this->assertArrayHasKey('fecha_reserva', $errors, "Falta el error de fecha anterior a mañana.");
        $this->assertArrayHasKey('hora_reserva', $errors, "Falta el error de hora fuera de rango.");
        $this->assertArrayHasKey('comentariosReserva', $errors, "Falta el error de comentarios demasiado largos.");

        $postDataVacios = [
            'matricula' => '',
            'modelo' => '',
            'anyo' => '',
            'fecha_reserva' => '',
            'hora_reserva' => '',
            'comentariosReserva' => '',
        ];
        $errorsVacios = $this->callCheckErroresReserva($postDataVacios);

        $this->assertArrayHasKey('matricula', $errorsVacios, "Falta el error de matrícula vacía.");
        $this->assertArrayHasKey('modelo', $errorsVacios, "Falta el error de modelo vacío.");
        $this->assertArrayHasKey('anyo', $errorsVacios, "Falta el error de año vacío.");
        $this->assertArrayHasKey('fecha_reserva', $errorsVacios, "Falta el error de fecha vacía.");
        $this->assertArrayHasKey('hora_reserva', $errorsVacios, "Falta el error de hora vacía.");
        $this->assertArrayHasKey('comentariosReserva', $errorsVacios, "Falta el error de comentarios vacíos.");

        $this->assertCount(6, $errors, "Se esperaban 6 errores de validación en el set de datos con formato/rango inválido.");

        $this->assertCount(6, $errorsVacios, "Se esperaban 6 errores de validación en el set de datos vacíos.");
    }
}