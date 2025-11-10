<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class TallerController extends BaseController
{


    public function showIndexTaller()
    {
        
        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','indexTaller.view.php','templates/footer.view.php'
        ));
    }
     public function showEmpleadosTaller()
    {
       
        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','empleadosTaller.view.php','templates/footer.view.php'
        ));
    }

      public function showVehiculos()
    {
       
        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','vehiculosTaller.view.php','templates/footer.view.php'
        ));
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit();
    }
}


