<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\EmpleadosModel;
use Com\Daw2\Models\RolModel;
use Com\Daw2\Models\PaisesModel;
use Com\Daw2\Libraries\Mensaje;

class EmpleadosController extends BaseController
{

public function showEmpleados(string $mensaje = "")
{
    $data = ['seccion' => '/empleadosTaller'];
    $data['input'] = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $data['errors'] = $this->checkErrors($_GET);

    $model = new EmpleadosModel();
    $rolModel = new RolModel();
    $roles = $rolModel->getRoles();

    $url = $_GET;
    if (isset($url['page'])) {
        unset($url['page']);
    }
    $url = http_build_query($url);
    $data['url'] = $url;

    if (!isset($_GET['page']) || !is_numeric($_GET['page'])) {
        $page = 1;
    } else {
        $page = (int)$_GET['page'];
    }

    if (isset($_GET['order']) && is_numeric($_GET['order']) && $_GET['order'] >= 1 && $_GET['order'] <= 5) {
        $order = (int)$_GET['order'];
    } else {
        $order = 1;
    }

    if (isset($_GET['dir']) && ($_GET['dir'] === 'ASC' || $_GET['dir'] === 'DESC')) {
        $dir = $_GET['dir'];
    } else {
        $dir = 'ASC';
    }

    $data['page'] = $page;
    $data['lastPage'] = 1;
    $data['order'] = $order;
    $data['dir'] = $dir;

    if ($data['errors'] === []) {
        $empleados = $model->getEmpeleadosByFilters($_GET, $page, $order, $dir);
        $total = $model->getLastEmpleados($_GET, $order, $dir);
        $lastPage = ceil($total / 2);

        $data['lastPage'] = $lastPage;
        $data['empleados'] = $empleados;
    } else {
        $data['empleados'] = [];
    }

    if (!empty($mensaje)) {
        $data['mensaje'] = $mensaje;
    }

    $data['roles'] = $roles;
    $this->view->showViews(array('templates/head.view.php', 'templates/aside.view.php', 'empleadosTaller.view.php', 'templates/footer.view.php'), $data);
}


public function checkErrors(array $data): array
{
    $errors = [];

    if (isset($data['selectPuesto']) && $data['selectPuesto'] !== "") {
        if (!is_numeric($data['selectPuesto']) || (int)$data['selectPuesto'] < 0) {
            $errors['selectPuesto'] = 'Debe seleccionar un rol válido';
        }
    }

    if (isset($data['selectEstado']) && $data['selectEstado'] !== "") {
        if (!in_array($data['selectEstado'], ['0', '1'], true)) {
            $errors['selectEstado'] = 'Debe seleccionar un estado válido';
        }
    }

    return $errors;
}


    public function showAltaEmpleado(array $input = [], array $errors = [])
    {
        $data = [
            'titulo' => 'Alta de Empleado',
            'breadcrumb' => ['Inicio / Alta de empleados']
        ];

        $data['errors'] = $errors;
        $data['input'] = $input;

        $rolModel = new RolModel();
        $paisesModel = new PaisesModel();
        $data['roles'] = $rolModel->getRoles();
        $data['paises'] = $paisesModel->getPaises();

        $this->view->showViews(array('templates/head.view.php','templates/aside.view.php','altaEmpleado.view.php','templates/footer.view.php'), $data);
    }

    public function altaEmpleado()
    {
        $input = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $errors = $this->checkErroresAlta($input, false);

        if (empty($errors)) {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $pass = $_POST['pass'] ?? '';
            $id_rol = isset($_POST['id_rol']) ? (int) $_POST['id_rol'] : 0;
            $pais = trim($_POST['id_pais'] ?? '');
            $paisesModel = new PaisesModel();
            $id_pais = 0;
            if ($pais !== '') {
                $id_pais = $paisesModel->obtenerCrearPaises('', $pais);
            }
            $empleadosModel = new EmpleadosModel();
            $existe = $empleadosModel->getEmpleadosEmail($email);
            if ($existe !== false) {
                $mensaje = new Mensaje('El email ya está en uso', Mensaje::ERROR);
                $this->addFlashMessage($mensaje);
                header('Location: /empleadosTaller');
                exit();
            }

            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $ok = $empleadosModel->insertEmpleado($nombre, $email, $passHash, $telefono, $id_rol, $id_pais);
            if ($ok) {
                $mensaje = new Mensaje('Empleado creado correctamente', Mensaje::SUCCESS);
                $this->addFlashMessage($mensaje);
                header('Location: /empleadosTaller');
                exit();
            } else {
                $mensaje = new Mensaje('Error al crear el empleado', Mensaje::ERROR);
                $this->addFlashMessage($mensaje);
                $this->showAltaEmpleado($input, ['general' => 'No se pudo insertar el empleado.']);
            }
        } else {
            $this->showAltaEmpleado($input, $errors);
        }
    }

    public function checkErroresAlta(array $data, bool $edicion = false): array
    {
        $errors = [];

        $username = $data['username'] ?? $data['nombre'] ?? '';

        if (empty($username)) {
            $errors['username'] = "El nombre de usuario no puede estar vacío";
        } elseif (!preg_match('/^[a-zA-Z0-9_ ]{5,20}$/', $username)) {
            $errors['username'] = "El nombre de usuario no es válido, debe tener entre 5 y 20 caracteres";
        }

        $passVacio = false;
        if (!$edicion) {
            if (empty($data['pass'])) {
                $errors['pass'] = "La contraseña no puede estar vacía";
                $passVacio = true;
            }

            if (empty($data['pass2'])) {
                $errors['pass2'] = "La confirmación de contraseña no puede estar vacía";
                $passVacio = true;
            }
        }

        if ($passVacio === false && ($data['pass'] ?? '') !== ($data['pass2'] ?? '')) {
            $errors['pass'] = "Las contraseñas no coinciden";
            $errors['pass2'] = "Las contraseñas no coinciden";
        }

        if (empty($data['email'])) {
            $errors['email'] = "El email no puede estar vacío";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El email no es correcto";
        }

        if (empty($data['id_rol'])) {
            $errors['rol'] = "El rol no puede estar vacío";
        } elseif ((int)$data['id_rol'] < 1 || (int)$data['id_rol'] > 3) {
            $errors['rol'] = "Introduzca un rol válido";
        }

        return $errors;
    }

    public function deleteEmpleado($id_usuario)
    {
        $modelEmpleados = new EmpleadosModel();
        $usuarioEliminado = $modelEmpleados->deleteEmpleado($id_usuario);
        if ($usuarioEliminado === true) {
            $mensaje = new Mensaje("El usuario se ha eliminado correctamente", Mensaje::INFO);
            $this->addFlashMessage($mensaje);
        } else {
            $mensaje = new Mensaje("El no se ha podido eliminar", Mensaje::INFO);
            $this->addFlashMessage($mensaje);
        }
        header('Location: /empleadosTaller');
    }
}