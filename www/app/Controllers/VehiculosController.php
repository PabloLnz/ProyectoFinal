<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\VehiculosModel;

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

         public function gestionarVehiculo()
    {
       
        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','gestionVehiculo.view.php','templates/footer.view.php'
        ));
    }
}