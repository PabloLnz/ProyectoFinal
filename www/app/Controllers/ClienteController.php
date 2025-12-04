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

        $validacion = $this->checkErrorsRegister($_POST);

        $data['errors'] = $validacion;
        $data['input']  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($data['errors'] === "") {

            $nombre   = $data['input']['nombre'] ?? "";
            $email    = $data['input']['email'] ?? "";
            $pass     = $data['input']['pass'] ?? "";
            $telefono = $data['input']['telefono'] ?? "";
            $direccion= $data['input']['direccion'] ?? "";

            $clienteExistente = $modelCliente->getusuariosEmail($email);
            $empleadoExistente = $modelEmpleado->getEmpleadosEmail($email);

            if ($clienteExistente !== false || $empleadoExistente !== false) {
                $data['errors'] = "El correo electrónico ya está registrado. Por favor, utiliza otro.";
                $this->view->showViews(['register.view.php'], $data);
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
                $data['errors'] = "Ha ocurrido un error inesperado al registrar los datos.";
                $this->view->showViews(array('register.view.php'), $data);
            }

        } else {
            $this->view->showViews(array('register.view.php'), $data);
        }
    }

    public function login()
    {
        $modelUsuario = new ClienteModel();
        $modelEmpleado = new EmpleadosModel();

        $validacion = $this->checkErrors($_POST);

        $data['errors'] = $validacion;
        $data['input']  = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($data['errors'])) {

            $email = $data['input']['email'];
            $pass  = $data['input']['pass'];

            $usuarios  = $modelUsuario->getUsuariosEmail($email);
            $empleados = $modelEmpleado->getEmpleadosEmail($email);

            if ($usuarios !== false && password_verify($pass, $usuarios['pass'])) {

                $_SESSION['datosUsuario'] = $usuarios;
                header('Location: /');
                return;

            } elseif ($empleados !== false && password_verify($pass, $empleados['pass'])) {

                if ($empleados['activo'] == 1) {
                    $_SESSION['datosEmpleado'] = $empleados;
                    $_SESSION['permisos'] = $this->permisos($empleados['id_rol']);
                    header('Location: /indexTaller');
                    return;
                }
                $data['errors']="Datos incorrectos";
                $this->view->showViews(['login.view.php'], $data);
                return;
            }
            $data['errors']="El usuario está dado de baja";
            $this->view->showViews(['login.view.php'], $data);

        } else {
            $this->view->showViews(['login.view.php'], $data);
        }
    }


    private function checkErrors(array $post): array
    {
        $errors = [];

        $email = trim($post['email'] ?? "");
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 120) {
            $errors[] = "Datos incorrectos";
        }

        $pass = trim($post['pass'] ?? "");
        if (strlen($pass) < 3 || strlen($pass) > 120) {
            $errors[] = "Datos incorrectos";
        }

        return $errors;
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




    private function checkErrorsRegister(array $post): string
    {
        $errors = "";

        $nombre = trim($post['nombre'] ?? "");
        if ($nombre === "" || strlen($nombre) < 3 || strlen($nombre) > 120) {
            $errors = "Datos incorrectos";
            return $errors;
        }

        $email = trim($post['email'] ?? "");
        if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 120) {
            $errors = "Datos incorrectos";
            return $errors;
        }

        $pass = trim($post['pass'] ?? "");
        if ($pass === "" || strlen($pass) < 3 || strlen($pass) > 120) {
            $errors = "Datos incorrectos";
            return $errors;
        }

        $telefono = trim($post['telefono'] ?? "");
        if ($telefono === "" || strlen($telefono) < 9 || strlen($telefono) > 15) {
            $errors = "Datos incorrectos";
            return $errors;
        }

        $direccion = trim($post['direccion'] ?? "");
        if ($direccion === "" || strlen($direccion) < 3 || strlen($direccion) > 255) {
            $errors = "Datos incorrectos";
            return $errors;
        }

        return $errors;
    }

}