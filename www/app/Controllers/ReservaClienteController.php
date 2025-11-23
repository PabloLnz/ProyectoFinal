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
        $this->view->showViews(array('reservasClientes.view.php'));

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

            $matricula      = trim($input['matricula'] ?? '');
            $marca          = trim($input['marca'] ?? '');
            $modelo         = trim($input['modelo'] ?? '');
            $anyo           = trim($input['anyo'] ?? '');
            $fechaReserva   = trim($input['fecha_reserva'] ?? '');
            $horaReserva    = trim($input['hora_reserva'] ?? '');
            $comentarios    = trim($input['comentariosReserva'] ?? '');

            $vehiculoModel = new VehiculosModel();
            $idVehiculo = $vehiculoModel->obtenerCrearVehiculo($idCliente,$matricula,$marca,$modelo,(int)$anyo);

            $model = new ReservasModel();
            $ok = $model->insertReserva($idCliente,$idVehiculo,$fechaReserva,$horaReserva,$comentarios);


            if ($ok) {
                $mensaje = new Mensaje("Reserva creada correctamente", Mensaje::SUCCESS);
            } else {
                $mensaje = new Mensaje("Error al crear la reserva", Mensaje::ERROR);
            }

            $this->addFlashMessage($mensaje);
        }

        $this->view->showViews(['reservasClientes.view.php']);
    }




    public function checkErroresReserva(array $data): array
    {
        $errors = [];

        if (!isset($data['fecha_reserva']) || empty($data['fecha_reserva'])) {
            $errors['fecha_reserva'] = 'Debe indicar una fecha';
        } else {
            $fechaMinima = date('Y-m-d', strtotime('+1 day'));
            if ($data['fecha_reserva'] < $fechaMinima) {
                $errors['fecha_reserva'] = 'La fecha debe ser a partir de mañana';
            }
        }

        if (!isset($data['hora_reserva']) || empty($data['hora_reserva'])) {
            $errors['hora_reserva'] = 'Debe indicar una hora';
        } else {
            if ($data['hora_reserva'] < '10:00' || $data['hora_reserva'] > '20:00') {
                $errors['hora_reserva'] = 'La hora debe estar entre 10:00 y 20:00';
            }
        }

        if (!isset($data['comentariosReserva']) || empty($data['comentariosReserva'])) {
            $errors['comentariosReserva'] = 'Debe especificar el motivo de la visita.';
        } elseif (strlen($data['comentariosReserva']) > 500) {
            $errors['comentariosReserva'] = 'Los comentarios no pueden superar 500 caracteres';
        }
        return $errors;
    }




}