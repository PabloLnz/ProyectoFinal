<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

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


        $email = $_POST['email'] ?? "";
        $pass = $_POST['pass'] ?? "";

        $usuarios = $modelUsuario->getusuariosLogin($email);
        if ($usuarios !== false) {
            $existePass = password_verify($pass, $usuarios['pass']);
            if ($existePass !== false) {
                if($usuarios['baja']==0){
                    $_SESSION['datosUsuario'] = $usuarios;
                    //$_SESSION['permisos']=$this->permisos($usuarios['id_rol']);

                    header('Location: /');
                }else{
                    $data['datosIncorrectos'] = "El usuario está dado de baja";
                    $this->view->showViews(array('login.view.php'), $data);
                }
            } else {
                $data['datosIncorrectos'] = "Los datos introducidos son incorrectos";
                $this->view->showViews(array('login.view.php'), $data);
            }
        } else {
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
                'historial'=>'rwd'
            ];
        }elseif ($idRol==2){
            $permisos=[
                'proveedores'=>'r',
                'categorias'=>'r',
                'usuario-sistema'=>'r',
                'productos'=>'r'

            ];
        }elseif ($idRol==3){
            $permisos=[
                'usuario-sistema'=>'',
                'proveedores'=>'rwd',
                'productos'=>'rwd'
            ];
        }
        return $permisos;
    }

}