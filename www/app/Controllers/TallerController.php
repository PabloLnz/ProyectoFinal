<?php

namespace Com\Daw2\Controllers;
use Com\Daw2\Models\EmpleadosModel;
use Com\Daw2\Core\BaseController;

class TallerController extends BaseController
{

    /**
     * @return void
     * @throws \Exception
     * Muestra el index del taller
     */
    public function showIndexTaller()
    {
        $modelEmpleados = new EmpleadosModel();
        $trabajadores = $modelEmpleados->getUsuariosActivos();
        
        $data = [
            'seccion' => '/indexTaller',
        ];

        $data['trabajadores'] = $trabajadores;
        $this->view->showViews(
            array('templates/head.view.php','templates/aside.view.php','indexTaller.view.php','templates/footer.view.php'),$data);
    }

    /**
     * @param int $id
     * @return void
     * cambia la disponibilidad de un empleado
     */
    public function cambiarDisponibilidad(int $id)
    {
        $nuevoEstado = filter_input(INPUT_GET,'disponibilidad', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $errores = $this->checkErrores($nuevoEstado, $id);

        if (!empty($errores)) {
                $mensaje = new Mensaje("Estado no  válido", Mensaje::ERROR);
                $this->addFlashMessage($mensaje);
                
            header("Location: /indexTaller");
            exit();
        }

        $model = new EmpleadosModel();
        $model->actualizarDisponibilidad($id, $nuevoEstado);

        header("Location: /indexTaller");
        exit();
    }


    /**
     * @param string $nuevoEstado
     * @param int $id
     * @return array
     * check errors para cambiar la disponibilidad
     */
    private function checkErrores(string $nuevoEstado,int $id)
    {
        $permitidos = ['disponible', 'en servicio', 'indispuesto'];

        $errores = [];

        if (!in_array($nuevoEstado, $permitidos)) {
            $errores[] = "Estado no válido.";
        }

        if(!is_numeric($id) || $id <= 0){
            $errores[] = "ID no válido.";
        }

        return $errores;
    }

    /**
     * @return void
     * cerrar sesion
     */
    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit();
    }
}
