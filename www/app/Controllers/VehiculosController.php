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

   public function gestionarVehiculo($idVehiculo)
    {
        $vehiculosModel = new VehiculosModel();
        $piezasModel = new PiezasModel();
        $reparacionModel = new ReparacionesModel();

        $vehiculo = $vehiculosModel->getVehiculoById($idVehiculo);
        if (!$vehiculo) {
        
            header('Location: /vehiculos');
            exit();
        }

        $piezas = $piezasModel->getPiezasDisponibles();
        $piezasUsadas = $reparacionModel->getPiezasUsadas($idVehiculo);

        $data['vehiculo'] = $vehiculo;
        $data['piezas'] = $piezas;
        $data['piezasUsadas'] = $piezasUsadas;
    

        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','gestionVehiculo.view.php','templates/footer.view.php'), $data);
    }

}