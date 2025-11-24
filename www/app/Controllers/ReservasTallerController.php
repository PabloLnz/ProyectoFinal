<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class ReservasTallerController extends BaseController
{

    public function showReservas()
    {

        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','reservasTaller.view.php','templates/footer.view.php'
        ));
    }


}