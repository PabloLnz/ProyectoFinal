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

public function getFacturasByFilters(array $parametros): array {
    $valores = [];
    $filtros = [];

    if (!empty($parametros['inputCliente'])) {
        $filtros[] = "(c.nombre LIKE :cliente OR c.id_cliente = :clienteExacto)";
        $valores[':cliente'] = '%' . $parametros['inputCliente'] . '%';
        $valores[':clienteExacto'] = $parametros['inputCliente'];
    }

    if (!empty($parametros['selectEstado'])) {
        $filtros[] = "f.estado = :estado";
        $valores[':estado'] = $parametros['selectEstado'];
    }

    if (!empty($parametros['inputFechaDesde'])) {
        $filtros[] = "f.fecha_emision >= :desde";
        $valores[':desde'] = $parametros['inputFechaDesde'];
    }

    if (!empty($parametros['inputFechaHasta'])) {
        $filtros[] = "f.fecha_emision <= :hasta";
        $valores[':hasta'] = $parametros['inputFechaHasta'];
    }

    if (!empty($parametros['inputTotalMax'])) {
        $filtros[] = "f.total <= :maxCoste";
        $valores[':maxCoste'] = $parametros['inputTotalMax'];
    }

    $sql = "
        SELECT 
            f.*,
            c.nombre AS nombre_cliente
        FROM facturas f
        INNER JOIN clientes c ON f.id_cliente = c.id_cliente
    ";

    if (!empty($filtros)) {
        $sql .= " WHERE " . implode(" AND ", $filtros);
    }

    $sql .= " ORDER BY f.fecha_emision DESC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($valores);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


}


