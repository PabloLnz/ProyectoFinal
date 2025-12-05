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
    public function getFacturasByCliente(int $idCliente) : array {
        $stmt = $this->pdo->prepare("
           SELECT DISTINCT f.id_factura,f.fecha_emision,f.total,f.estado,f.metodo_pago,f.comentarios, 
                           v.matricula AS matricula_vehiculo, ut.nombre AS nombre_empleado      
            FROM facturas f
            INNER JOIN factura_reparacion fr ON f.id_factura = fr.id_factura
            INNER JOIN reparaciones r ON fr.id_reparacion = r.id_reparacion
            INNER JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
            INNER JOIN usuario_taller ut ON r.id_usuario = ut.id_usuario
            WHERE f.id_cliente = :idCliente
            ORDER BY f.fecha_emision DESC, f.id_factura
        ");
        $stmt->execute(['idCliente' => $idCliente]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function actualizarEstadoYMetodoPago(int $idFactura, string $metodoPago): bool {
        $stmt = $this->pdo->prepare("
            UPDATE facturas 
            SET estado = 'pagada', 
                metodo_pago = :metodoPago
            WHERE id_factura = :idFactura AND estado = 'pendiente'
        ");

        $stmt->execute([
            ':metodoPago' => $metodoPago,
            ':idFactura' => $idFactura
        ]);
        return $stmt->rowCount() > 0;
    }

}


