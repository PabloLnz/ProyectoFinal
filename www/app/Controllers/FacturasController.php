<?php
declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\FacturasModel;

class FacturasController extends BaseController
{
    public function showFacturas()
    {
        $data = ['seccion' => '/facturacion'];
        
        $data['estadosFactura'] = [
            ['id_estado' => 'pendiente', 'nombre_estado' => 'Pendiente de Pago'],
            ['id_estado' => 'pagada', 'nombre_estado' => 'Pagada'],
            ['id_estado' => 'cancelada', 'nombre_estado' => 'Cancelada']
        ];
        
        $data['input'] = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['errors'] = $this->checkErrors($_GET); 

        $facturasModel = new FacturasModel();
        $data['facturas'] = [];
        
        if ($data['errors'] === []) {
            $facturas = $facturasModel->getFacturasByFilters($_GET);

            foreach ($facturas as &$factura) {
                $factura['fechaFormateada'] = date('d/m/Y', strtotime($factura['fecha_emision']));
                $factura['totalFormateado'] = number_format((float)$factura['total'], 2, ',', '.') . ' €';
            }

            $data['facturas'] = $facturas;
            
          
            if (empty($facturas)) {
                $data['mensaje'] = 'No se encontraron facturas.';
            }
            
        } else {
            $data['facturas'] = [];
            $data['mensaje'] = 'Error en los filtros. Por favor, corrija los errores marcados.';
        }
        $this->view->showViews(
            array('templates/head.view.php', 'templates/aside.view.php', 'facturasTaller.view.php', 'templates/footer.view.php'), 
            $data
        );
    }

    public function checkErrors(array $data): array
    {
        $errors = [];
        $validos = ['pendiente', 'pagada', 'cancelada']; 

        if (isset($data['selectEstado']) && $data['selectEstado'] !== "") {
            if (!in_array($data['selectEstado'], $validos)) {
                 $errors['selectEstado'] = 'Debe seleccionar un estado de factura válido: Pendiente, Pagada o Cancelada.';
            }
        }
        
        $cliente = $data['inputCliente'] ?? '';
        if (strlen($cliente) > 100) {
            $errors['inputCliente'] = 'El nombre o ID del cliente es demasiado largo.';
        }

        $fechaDesde = $data['inputFechaDesde'] ?? '';
        $fechaHasta = $data['inputFechaHasta'] ?? '';

        if ($fechaDesde !== "" && !preg_match("/^\d{4}-\d{2}-\d{2}$/", $fechaDesde)) {
            $errors['inputFechaDesde'] = 'El formato de la fecha de inicio no es válido (AAAA-MM-DD).';
        }
        
        if ($fechaHasta !== "" && !preg_match("/^\d{4}-\d{2}-\d{2}$/", $fechaHasta)) {
            $errors['inputFechaHasta'] = 'El formato de la fecha de fin no es válido (AAAA-MM-DD).';
        }
        
        if (empty($errors) && $fechaDesde !== "" && $fechaHasta !== "") {
            if (strtotime($fechaDesde) > strtotime($fechaHasta)) {
                $errors['inputFechaDesde'] = 'La fecha de inicio no puede ser posterior a la fecha de fin.';
            }
        }
        
        $totalMax = $data['inputTotalMax'] ?? '';
        if (!empty($totalMax)) {
            if (!is_numeric($totalMax) || (float)$totalMax < 0) {
                $errors['inputTotalMax'] = 'El total máximo debe ser un valor numérico positivo.';
            }
        }

        return $errors;
    }

    public function showFacturasCliente() {

        if (!isset($_SESSION['datosUsuario'])){
            header("Location: /login");
            exit;
        }

        $idCliente = intval($_SESSION['datosUsuario']['id_cliente']);

        $model = new FacturasModel();
        $facturas = $model->getFacturasByCliente($idCliente);

        $data['facturas']=$facturas;

        $this->view->showViews(['facturasCliente.view.php',], $data);
    }
}