<?php 
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class FacturasModel extends BaseDbModel {

public function crearFactura(int $idCliente, float $total, string $comentario = ''): int {
    $stmt = $this->pdo->prepare("
        INSERT INTO facturas (id_cliente, fecha_emision, total, comentarios)
        VALUES (:idCliente, NOW(), :total, :comentario)
    ");
    $stmt->execute([
        ':idCliente' => $idCliente,
        ':total' => $total, 
        ':comentario' => $comentario]);
    return intval($this->pdo->lastInsertId());
}


public function getFacturaPorReparacion(int $idReparacion): ?array {
    $stmt = $this->pdo->prepare("
        SELECT f.* 
        FROM facturas f
        JOIN factura_reparacion fr ON fr.id_factura = f.id_factura
        WHERE fr.id_reparacion = :idReparacion
        LIMIT 1
    ");
    $stmt->execute([':idReparacion' => $idReparacion]);
    return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
}
}
