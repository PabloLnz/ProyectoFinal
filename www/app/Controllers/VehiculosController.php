<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\VehiculosModel;
use Com\Daw2\Models\PiezasModel;
use Com\Daw2\Models\ReparacionesModel;
use Com\Daw2\Models\FacturasModel;
use Com\Daw2\Models\FacturaReparacionModel;
use Com\Daw2\Models\ReparacionPiezaModel;
use Com\Daw2\Libraries\Mensaje;

class VehiculosController extends BaseController
{

    public function showVehiculos()
    {
        $modelVehiculos = new VehiculosModel();
        $vehiculos = $modelVehiculos->getVehiculosActivos();

        $data = [
            'seccion' => '/vehiculos',
        ];
        $data['vehiculos'] = $vehiculos;

        $this->view->showViews(['templates/head.view.php', 'templates/aside.view.php', 'vehiculosTaller.view.php', 'templates/footer.view.php'], $data);
    }

   public function gestionarVehiculo(int $idVehiculo)
{
    $vehiculosModel = new VehiculosModel();
    $piezasModel = new PiezasModel();
    $reparacionPiezaModel = new ReparacionPiezaModel();
    $facturasModel = new FacturasModel();
    $reparacionesModel = new ReparacionesModel();

    $vehiculo = $vehiculosModel->getVehiculoById($idVehiculo);
    if (!$vehiculo) {
        header("Location: /vehiculos");
        exit;
    }

    $data['vehiculo'] = $vehiculo;
    $data['piezas'] = $piezasModel->getPiezasDisponibles();
    $data['piezasUsadas'] = $reparacionPiezaModel->getPiezasUsadas($idVehiculo);

    $reparacion = $reparacionesModel->getReparacionPorVehiculo($idVehiculo);

    $facturas = $facturasModel->getFacturaPorReparacion($reparacion['id_reparacion']);
    $comentario = '';
    if ($facturas) {
        $comentario = $facturas['comentarios'];
    }
    $data['comentario'] = $comentario;
    $this->view->showViews(['templates/head.view.php', 'templates/aside.view.php', 'gestionVehiculo.view.php', 'templates/footer.view.php'],$data);
}


    public function actualizarEstado(int $idVehiculo)
    {
        $estado = $_POST['estado'] ?? null;

        if (!in_array($estado, ['pendiente', 'finalizado'])) {
            $this->gestionarVehiculo($idVehiculo);
            exit;
        }

        $vehiculosModel = new VehiculosModel();
        $vehiculosModel->actualizarEstado($idVehiculo, $estado);

        $this->gestionarVehiculo($idVehiculo);
    }

    public function agregarPieza(int $idVehiculo)
    {
        $piezasModel = new PiezasModel();
        $reparacionesModel = new ReparacionesModel();
        $reparacionPiezaModel = new ReparacionPiezaModel();

        $idPieza = intval($_POST['id_pieza']);
        $cantidad = intval($_POST['cantidad']);
        $precio = $piezasModel->getPrecioPieza($idPieza);

        $reparacion = $reparacionesModel->getReparacionPorVehiculo($idVehiculo);

        if (!$reparacion) {
            $idUsuario = $_SESSION['datosEmpleado']['id_usuario'];
            $idReparacion = $reparacionesModel->crearReparacion(
                $idVehiculo,
                $idUsuario,
                "Reparación iniciada"
            );
        } else {
            $idReparacion = $reparacion['id_reparacion'];
        }

        $reparacionPiezaModel->agregarPieza($idReparacion, $idPieza, $cantidad, $precio);

        $piezasModel->quitarStock($idPieza, $cantidad);

        $this->gestionarVehiculo($idVehiculo);
    }

public function eliminarPieza(int $idReparacionPieza, int $idVehiculo)
{
    $reparacionesPiezaModel = new ReparacionPiezaModel();
    $piezasModel = new PiezasModel();

    $pieza = $reparacionesPiezaModel->getPiezaUsada($idReparacionPieza);
    if ($pieza) {
        $piezasModel->sumarStock($pieza['id_pieza'], $pieza['cantidad']);
    }

    $reparacionesPiezaModel->eliminarPieza($idReparacionPieza);
    $this->gestionarVehiculo($idVehiculo);
}




    public function generarFactura(int $idVehiculo)
    {
        $vehiculosModel = new VehiculosModel();
        $reparacionesModel = new ReparacionesModel();
        $facturaRepModel = new FacturaReparacionModel();
        $facturasModel = new FacturasModel();
        $reparacionPiezaModel = new ReparacionPiezaModel();

        $vehiculo = $vehiculosModel->getVehiculoById($idVehiculo);
        if (!$vehiculo) {
            header("Location: /vehiculos");
            exit;
        }

        $reparacion = $facturaRepModel->getReparacionPendienteFactura($idVehiculo);
        if (!$reparacion) {
            $mensaje = new Mensaje("No hay reparaciones pendientes de facturar.", Mensaje::ERROR);
            $this->addFlashMessage($mensaje);
            $this->gestionarVehiculo($idVehiculo);
            return;
        }

        $total = $reparacionPiezaModel->calcularCosteReparacion($reparacion['id_reparacion']);

        $comentario = $_POST['comentario'] ?? '';

        $idFactura = $facturasModel->crearFactura($vehiculo['id_cliente'], $total, $comentario);

        $facturaRepModel->asociarFacturaReparacion($idFactura, $reparacion['id_reparacion']);

        $reparacionesModel->actualizarCoste($reparacion['id_reparacion'], $total);

        $vehiculosModel->actualizarEstado($idVehiculo, 'finalizado');

        $mensaje = new Mensaje("Factura generada correctamente", Mensaje::SUCCESS);
        $this->addFlashMessage($mensaje);

        $this->gestionarVehiculo($idVehiculo);
    }
}
