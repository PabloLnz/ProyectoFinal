<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\ReservasModel;
use Com\Daw2\Libraries\Mensaje;
use Com\Daw2\Models\ReparacionesModel;
class ReservasTallerController extends BaseController
{


    public function showReservas(): void
    {
        $data = ['seccion' => '/reservas'];
        $reservasModel = new ReservasModel ();
        $reservas = $reservasModel->getReservasGeneral();
        $data['reservas']=$reservas;

        $this->view->showViews(['templates/head.view.php','templates/aside.view.php','reservasTaller.view.php','templates/footer.view.php'], $data);
    }

    

        public function confirmarReserva(int $id_reserva): void
{
    $reservaModel = new ReservasModel();
    $reservaModel->cambiarEstado($id_reserva, 'confirmada');


    $reserva = $reservaModel->getReservaById($id_reserva);
    if ($reserva) {
        $vehiculoId = $reserva['id_vehiculo'];
        $reparacionesModel = new ReparacionesModel();
        $existeReparacion = $reparacionesModel->getReparacionPendientePorVehiculo($vehiculoId);
        if (!$existeReparacion) {
            $reparacionesModel->crearReparacionPendiente($vehiculoId);
        }
        $mensaje = new Mensaje("Reserva confirmada correctamente", Mensaje::SUCCESS);
    } else {
        $mensaje = new Mensaje("Error al confirmar la reserva", Mensaje::ERROR);
    }

    $this->addFlashMessage($mensaje);
    header('Location: /reservas');
    exit;
}



    public function rechazarReserva(int $id_reserva): void
    {
        $reservaRechazada = new ReservasModel();
        $reservaRechazada->cambiarEstado($id_reserva, 'rechazada');

        if ($reservaRechazada) {
            $mensaje = new Mensaje("Reserva rechazada correctamente", Mensaje::SUCCESS);
        } else {
            $mensaje = new Mensaje("Error al rechazar la reserva", Mensaje::ERROR);
        }

        $this->addFlashMessage($mensaje);
        header('Location: /reservas');
        exit;
    }

    public function finalizarReserva(int $id_reserva): void
    {
        $reservaFinalizada = new ReservasModel();
        $reservaFinalizada->cambiarEstado($id_reserva, 'finalizada');

        if ($reservaFinalizada) {
            $mensaje = new Mensaje("Reserva finalizada correctamente", Mensaje::SUCCESS);
        } else {
            $mensaje = new Mensaje("Error al finalizar la reserva", Mensaje::ERROR);
        }

        $this->addFlashMessage($mensaje);
        header('Location: /reservas');
        exit;
    }

    public function noAsistidaReserva(int $id_reserva): void
    {
        $reservaNoAsistida = new ReservasModel();
        $reservaNoAsistida->cambiarEstado($id_reserva, 'no_asistida');

        if ($reservaNoAsistida) {
            $mensaje = new Mensaje("Reserva marcada como no asistida", Mensaje::SUCCESS);
        } else {
            $mensaje = new Mensaje("Error al marcar la reserva como no asistida", Mensaje::ERROR);
        }

        $this->addFlashMessage($mensaje);
        header('Location: /reservas');
        exit;
    }

public function gestionarReservas($id_reserva) {
    $id = (int)$id_reserva;
    if ($id <= 0) {
        header("Location: /reservas");
        exit;
    }

    $reservaModel = new ReservasModel();
    $reserva = $reservaModel->getReservaById($id);
    if (!$reserva) {
        die("Reserva no encontrada");
    }

    $reservas = $reservaModel->getReservasGeneral();

    $data = [
        'reserva' => $reserva,
        'reservas' => $reservas
    ];

    $this->view->showViews([
        'templates/head.view.php',
        'templates/aside.view.php',
        'reservasTaller.view.php',
        'templates/footer.view.php'
    ], $data);
}


}