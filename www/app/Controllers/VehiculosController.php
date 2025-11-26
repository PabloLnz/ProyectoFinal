<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\VehiculosModel;
use Com\Daw2\Models\PiezasModel;
use Com\Daw2\Models\ReparacionesModel;

class VehiculosController extends BaseController
{

     
     
     public function showVehiculos()
    {
        $modelVehiculos = new VehiculosModel();
        $vehiculos = $modelVehiculos->getVehiculosActivos();

        $data = ['seccion' => '/vehiculos',];
        $data['vehiculos'] = $vehiculos;

        $this->view->showViews(['templates/head.view.php', 'templates/aside.view.php', 'vehiculosTaller.view.php', 'templates/footer.view.php'],$data);
    }


       public function gestionarVehiculo(int $idVehiculo) {
        $vehiculosModel = new VehiculosModel();
        $piezasModel = new PiezasModel();
        $reparacionesModel = new ReparacionesModel();

        $vehiculo = $vehiculosModel->getVehiculoById($idVehiculo);
        if (!$vehiculo) {
            header("Location: /vehiculos");
            exit;
        }

        $data['vehiculo'] = $vehiculo;
        $data['piezas'] = $piezasModel->getPiezasDisponibles();
        $data['piezasUsadas'] = $reparacionesModel->getPiezasUsadas($idVehiculo);

        $this->view->showViews(
            ['templates/head.view.php', 'templates/aside.view.php', 'gestionVehiculo.view.php', 'templates/footer.view.php'],
            $data
        );
    }

    public function actualizarEstado(int $idVehiculo) {
        $estado = $_POST['estado'] ?? null;

        if (!in_array($estado, ['pendiente', 'finalizado'])) {
            $this->gestionarVehiculo($idVehiculo);
            exit;
        }

        $vehiculosModel = new VehiculosModel();
        $vehiculosModel->actualizarEstado($idVehiculo, $estado);

        $this->gestionarVehiculo($idVehiculo);
    }

   public function agregarPieza(int $idVehiculo) {
    $piezasModel = new PiezasModel();
    $reparacionesModel = new ReparacionesModel();

    $idPieza = intval($_POST['id_pieza']);
    $cantidad = intval($_POST['cantidad']);
    $precio = $piezasModel->getPrecioPieza($idPieza);

    $reparacion = $reparacionesModel->getReparacionPorVehiculo($idVehiculo);

    $idUsuario = $_SESSION['datosEmpleado']['id_usuario'];
    $idReparacion = $reparacionesModel->crearReparacion($idVehiculo, $idUsuario, "Reparación iniciada");

    $reparacionesModel->agregarPieza($idReparacion, $idPieza, $cantidad, $precio);

    $vehiculosModel = new VehiculosModel();
    $vehiculo = $vehiculosModel->getVehiculoById($idVehiculo);
    $data['vehiculo'] = $vehiculo;
    $data['piezas'] = $piezasModel->getPiezasDisponibles();
    $data['piezasUsadas'] = $reparacionesModel->getPiezasUsadas($idVehiculo);

    $this->view->showViews(['templates/head.view.php', 'templates/aside.view.php', 'gestionVehiculo.view.php', 'templates/footer.view.php'], $data);
}


    public function eliminarPieza(int $idReparacionPieza, int $idVehiculo) {
        $reparacionesModel = new ReparacionesModel();
        $reparacionesModel->eliminarPieza($idReparacionPieza);

        $this->gestionarVehiculo($idVehiculo);
    }

    public function generarFactura(int $idVehiculo) {
        $reparacionesModel = new ReparacionesModel();
        $total = $reparacionesModel->calcularTotal($idVehiculo);

        
    }
}