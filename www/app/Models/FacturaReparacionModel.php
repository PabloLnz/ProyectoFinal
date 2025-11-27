<?php 
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class FacturaReparacionModel extends BaseDbModel {

    public function asociarFacturaReparacion(int $idFactura, int $idReparacion)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO factura_reparacion (id_factura, id_reparacion)
            VALUES (:idFactura, :idReparacion)
        ");
        $stmt->execute([':idFactura' => $idFactura, ':idReparacion' => $idReparacion]);
    }
    
public function getReparacionPendienteFactura(int $idVehiculo): ?array {
    $stmt = $this->pdo->prepare("
        SELECT r.*
        FROM reparaciones r
        LEFT JOIN factura_reparacion fr ON fr.id_reparacion = r.id_reparacion
        WHERE r.id_vehiculo = :id AND fr.id_factura IS NULL
        ORDER BY r.fecha_inicio ASC
        LIMIT 1
    ");
    $stmt->execute([':id' => $idVehiculo]);
    return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
}

    
}
