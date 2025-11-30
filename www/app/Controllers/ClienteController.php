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

    public function showRegister()
    {
        $this->view->showViews(array('register.view.php'));
    }


    public function showHorarios()
    {
        $this->view->showViews(array('horarios.view.php'));
    }

    public function showSobreNosotros()
    {
        $this->view->showViews(array('sobreNosotros.view.php'));
    }


    public function register()
    {
        $modelCliente = new ClienteModel();
        $modelEmpleado = new EmpleadosModel();

        $nombre = $_POST['nombre'] ?? "";
        $email = $_POST['email'] ?? "";
        $pass = $_POST['pass'] ?? "";
        $telefono = $_POST['telefono'] ?? "";
        $direccion = $_POST['direccion'] ?? "";

        $clienteExistente = $modelCliente->getusuariosEmail($email);
        $empleadoExistente = $modelEmpleado->getEmpleadosEmail($email);

        if ($clienteExistente !== false || $empleadoExistente !== false) {
            $data['datosIncorrectos'] = "El correo electrónico ya está registrado. Por favor, utiliza otro.";
            $this->view->showViews(array('register.view.php'), $data);
            return;
        }

        $passHash = password_hash($pass, PASSWORD_DEFAULT);

        $registroExitoso = $modelCliente->insertCliente($nombre, $email, $passHash, $telefono, $direccion);

        if ($registroExitoso) {
            $nuevoCliente = $modelCliente->getDatosCliente($email);
            if ($nuevoCliente) {
                $_SESSION['datosUsuario'] = $nuevoCliente;
            }
            header('Location: /');
        } else {
            $data['datosIncorrectos'] = "Ha ocurrido un error inesperado al registrar los datos.";
            $this->view->showViews(array('register.view.php'), $data);
        }
    }

    public function login()
    {
        $modelUsuario = new ClienteModel();
        $modelEmpleado = new EmpleadosModel();


        $email = $_POST['email'] ?? "";
        $pass = $_POST['pass'] ?? "";

        $usuarios = $modelUsuario->getusuariosEmail($email);
        $empleados = $modelEmpleado->getEmpleadosEmail($email);
        if ($usuarios !== false) {
            $existePass = password_verify($pass, $usuarios['pass']);
            if ($existePass !== false) {
                    $_SESSION['datosUsuario'] = $usuarios;
                    header('Location: /');
            } else {
                $data['datosIncorrectos'] = "Los datos introducidos son incorrectos";
                $this->view->showViews(array('login.view.php'), $data);
            }
        } elseif ($empleados !== false) {
            $existePass = password_verify($pass, $empleados['pass']);
            if ($existePass !== false) {
                if($empleados['activo']==1){
                    $_SESSION['datosEmpleado'] = $empleados;
                    $_SESSION['permisos']=$this->permisos($empleados['id_rol']);

                    header('Location: /indexTaller');
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