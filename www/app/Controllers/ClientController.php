<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class ClientController extends BaseController
{

    public function index() {

        $this->view->showViews(array('index.view.php'));
    }

    public function showLogin()
    {
        $this->view->showViews(array('login.view.php'));
    }

    public function login() {
        header('Location: /indexTaller');
    }
}