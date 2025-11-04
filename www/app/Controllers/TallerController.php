<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class TallerController extends BaseController
{


    public function showIndexTaller()
    {
        $this->view->showViews(array('indexTaller.view.php'));
    }
}


