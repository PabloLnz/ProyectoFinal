<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Libraries\Mensaje;
use Com\Daw2\Models\ReservasModel;
use Com\Daw2\Models\VehiculosModel;

class ReservaClienteController extends BaseController
{
   public function showReservaCliente()
{
    $idCliente = $_SESSION['datosUsuario']['id_cliente'];

    $model = new ReservasModel();
    $reservas = $model->getReservasByCliente($idCliente);

    $data['reservas'] = $reservas;
    $this->view->showViews(['reservasClientes.view.php'], $data);
}


    public function showNuevaReserva()
    {
        $this->view->showViews(array('nuevaReserva.view.php'));

    }


    public function nuevaReserva()
    {
        $input  = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $errors = $this->checkErroresReserva($input);

        if (empty($errors)) {
            $idCliente = $_SESSION['datosUsuario']['id_cliente'];

            $matricula    = trim($input['matricula'] ?? '');
            $marca        = "BMW";
            $modelo       = trim($input['modelo'] ?? '');
            $anyo         = trim($input['anyo'] ?? '');
            $fechaReserva = trim($input['fecha_reserva'] ?? '');
            $horaReserva  = trim($input['hora_reserva'] ?? '');
            $comentarios  = trim($input['comentariosReserva'] ?? '');

            $vehiculoModel = new VehiculosModel();
            $idVehiculo = $vehiculoModel->obtenerCrearVehiculo($idCliente, $matricula, $marca, $modelo, (int)$anyo);

            $model = new ReservasModel();
            $ok = $model->insertReserva($idCliente, $idVehiculo, $fechaReserva, $horaReserva, $comentarios);

            if ($ok) {
                $mensaje = new Mensaje("Reserva creada correctamente", Mensaje::SUCCESS);
                $this->addFlashMessage($mensaje);
                header('Location: /reservaCliente');
                exit();
            } else {
                $errors['general'] = "Error al crear la reserva";
            }
        }
        $data['errors'] = $errors;
        $data['input'] = $input;
        $this->view->showViews(['nuevaReserva.view.php'], $data);
    }





    public function checkErroresReserva(array $data): array
    {
        $errors = [];

        $matricula = trim($data['matricula'] ?? '');
        if (empty($matricula)) {
            $errors['matricula'] = 'Debe indicar la matrícula';
        } elseif (!preg_match('/^[0-9]{1,4}\s?[A-Z]{1,3}$/i', $matricula)) {
            $errors['matricula'] = 'Formato de matrícula no válido';
        }

        $modelo = trim($data['modelo'] ?? '');
        if (empty($modelo)) {
            $errors['modelo'] = 'Debe indicar el modelo';
        } elseif (strlen($modelo) > 50) {
            $errors['modelo'] = 'El modelo no puede superar 50 caracteres';
        }

        $anyo = trim($data['anyo'] ?? '');
        if (empty($anyo)) {
            $errors['anyo'] = 'Debe indicar el año';
        } elseif (!is_numeric($anyo) || $anyo < 1950 || $anyo > 2028) {
            $errors['anyo'] = 'Año no válido';
        }

        $fecha = trim($data['fecha_reserva'] ?? '');
        if (empty($fecha)) {
            $errors['fecha_reserva'] = 'Debe indicar una fecha';
        } else {
            $fechaMinima = date('Y-m-d', strtotime('+1 day'));
            if ($fecha < $fechaMinima) {
                $errors['fecha_reserva'] = 'La fecha debe ser a partir de mañana';
            }
        }

        $hora = trim($data['hora_reserva'] ?? '');
        if (empty($hora)) {
            $errors['hora_reserva'] = 'Debe indicar una hora';
        } elseif ($hora < '10:00' || $hora > '20:00') {
            $errors['hora_reserva'] = 'La hora debe estar entre 10:00 y 20:00';
        }

        $comentarios = trim($data['comentariosReserva'] ?? '');
        if (empty($comentarios)) {
            $errors['comentariosReserva'] = 'Debe especificar el motivo de la visita';
        } elseif (strlen($comentarios) > 500) {
            $errors['comentariosReserva'] = 'Los comentarios no pueden superar 500 caracteres';
        }

        return $errors;
    }



    public function deleteReservaCliente(int $id_reserva)
    {
        $model = new ReservasModel();
        $reserva = $model->obtenerReserva($id_reserva);

        if ($reserva === false) {
            $mensaje = new Mensaje("La reserva no existe", Mensaje::ERROR);
            $this->addFlashMessage($mensaje);
            header('Location: /reservaCliente');
            exit;
        }

        $fechaHoraReserva = strtotime($reserva['fecha_reserva'] . ' ' . $reserva['hora_reserva']);
        $ahora = time();
        if (($fechaHoraReserva - $ahora) < 24 * 3600) {
            $mensaje = new Mensaje("No se puede cancelar la reserva con menos de 24 horas de antelación", Mensaje::ERROR);
            $this->addFlashMessage($mensaje);
            header('Location: /reservaCliente');
            exit;
        }

        if ($model->deleteReservaCliente($id_reserva)) {
            $mensaje = new Mensaje("Reserva cancelada correctamente", Mensaje::INFO);
        } else {
            $mensaje = new Mensaje("Error al cancelar la reserva", Mensaje::ERROR);
        }
        $this->addFlashMessage($mensaje);
        header('Location: /reservaCliente');
    }
}