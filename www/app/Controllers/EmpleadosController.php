<?php

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\EmpleadosModel;
use Com\Daw2\Libraries\Mensaje;

class EmpleadosController extends BaseController
{
    public function showAltaEmpleado(array $input = [], array $errors = [])
    {
        $data = [
            'titulo' => 'Alta de Empleado',
            'breadcrumb' => ['Inicio / Alta de empleados']
        ];

        $data['errors'] = $errors;
        $data['input'] = $input;

        $model = new EmpleadosModel();
        $data['roles'] = $model->getRoles();
        $data['paises'] = $model->getPaises();

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
            $model = new EmpleadosModel();
            $id_pais = 0;
            if ($pais !== '') {
                $id_pais = $model->obtenerCrearPaises('', $pais);
            }
           
            $existe = $model->getEmpleadosEmail($email);
            if ($existe !== false) {
                $mensaje = new Mensaje('El email ya está en uso', Mensaje::ERROR);
                $this->addFlashMessage($mensaje);
                header('Location: /empleadosTaller');
                exit();
            }

            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $ok = $model->insertEmpleado($nombre, $email, $passHash, $telefono, $id_rol, $id_pais);
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
}