<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class VehiculosController extends BaseController
{

     
     
     public function showVehiculos()
    {
       
        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','vehiculosTaller.view.php','templates/footer.view.php'
        ));
    }

         public function gestionarVehiculo()
    {
       
        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','gestionVehiculo.view.php','templates/footer.view.php'
        ));
    }
}