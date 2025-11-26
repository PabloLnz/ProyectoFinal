<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class TallerController extends BaseController
{


    public function showIndexTaller()
    {
        $data = ['seccion' => '/indexTaller'];
        
        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','indexTaller.view.php','templates/footer.view.php'), $data);
    }
 




    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit();
    }
}


