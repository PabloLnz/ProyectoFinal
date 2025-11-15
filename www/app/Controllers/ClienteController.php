<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\ClienteModel;
use Com\Daw2\Models\EmpleadosModel;

class ClienteController extends BaseController
{


    public function index() {

        $this->view->showViews(array('index.view.php'));
    }

    public function showLogin()
    {
        $this->view->showViews(array('login.view.php'));
    }

    public function login()
    {
        $modelUsuario = new ClienteModel();
        $modelEmpleado = new EmpleadosModel();


        $email = $_POST['email'] ?? "";
        $pass = $_POST['pass'] ?? "";

        $usuarios = $modelUsuario->getusuariosLogin($email);
        $empleados = $modelEmpleado->getEmpleadosLogin($email);
        if ($usuarios !== false) {
            $existePass = password_verify($pass, $usuarios['pass']);
            if ($existePass !== false) {
                if($usuarios['baja']==0){
                    $_SESSION['datosUsuario'] = $usuarios;
                    header('Location: /');
                }else{
                    $data['datosIncorrectos'] = "Los datos introducidos son incorrectos";
                    $this->view->showViews(array('login.view.php'), $data);
                }
            } else {
                $data['datosIncorrectos'] = "Los datos introducidos son incorrectos";
                $this->view->showViews(array('login.view.php'), $data);
            }
        } elseif ($empleados !== false) {
            $existePass = password_verify($pass, $empleados['pass']);
            if ($existePass !== false) {
                if($empleados['baja']==0){
                    $_SESSION['datosUsuario'] = $empleados;
                    $_SESSION['permisos']=$this->permisos($empleados['id_rol']);

                    header('Location: /');
                }else{
                    $data['datosIncorrectos'] = "El usuario está dado de baja";
                    $this->view->showViews(array('login.view.php'), $data);
                }
            } else {
                $data['datosIncorrectos'] = "Los datos introducidos son incorrectos";
                $this->view->showViews(array('login.view.php'), $data);
            }

        }else{
            $data['datosIncorrectos'] = "Los datos introducidos son incorrectos";
            $this->view->showViews(array('login.view.php'), $data);
        }
    }
    public function permisos(int $idRol):array{

        $permisos=[];

        if ($idRol==1){
            $permisos=[
                'inicioTaller'=>'rwd',
                'empleados'=>'rwd',
                'vehiculos'=>'rwd',
                'reservas'=>'rwd',
                'historial'=>'rwd',
                'facturacion'=>'rwd'
            ];
        }elseif ($idRol==2){
            $permisos=[
                'inicioTaller'=>'rwd',
                'empleados'=>'rwd',
                'vehiculos'=>'rwd',
                'reservas'=>'rwd',
                'historial'=>'r',
                'facturacion'=>'r'
            ];
        }elseif ($idRol==3){
            $permisos=[
                'inicioTaller'=>'r',
                'empleados'=>'r',
                'vehiculos'=>'r',
                'reservas'=>'r',
            ];
        }
        return $permisos;
    }

}