<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ReparacionesModel extends BaseDbModel
{
  

    public function getPiezasUsadas($idVehiculo)
    {
        $stmt = $this->pdo->prepare("
            SELECT rp.id_reparacion_pieza, rp.cantidad, rp.precio_pieza_reparacion,
                   p.nombre, p.codigo
            FROM reparacion_pieza rp
            INNER JOIN reparaciones r ON rp.id_reparacion = r.id_reparacion
            INNER JOIN piezas p ON rp.id_pieza = p.id_pieza
            WHERE r.id_vehiculo = :id
        ");
        $stmt->execute(array('id' => $idVehiculo));
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}