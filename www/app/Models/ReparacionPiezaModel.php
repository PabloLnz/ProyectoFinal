<?php 
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ReparacionPiezaModel extends BaseDbModel {

    /**
     * @param int $idReparacion
     * @return float
     * calcula el precio de una reparacion
     */
public function calcularCosteReparacion(int $idReparacion): float
{
    $stmt = $this->pdo->prepare("
        SELECT SUM(cantidad * precio_pieza_reparacion) as total
        FROM reparacion_pieza
        WHERE id_reparacion = :id
    ");
    $stmt->execute([':id' => $idReparacion]);
    return floatval($stmt->fetch()['total']);
}

    /**
     * @param int $idReparacion
     * @param int $idPieza
     * @param int $cantidad
     * @param float $precio
     * @return void
     * agrega piezas  auna reparacion
     */
    public function agregarPieza(int $idReparacion, int $idPieza, int $cantidad, float $precio) {
        $stmt = $this->pdo->prepare("INSERT INTO reparacion_pieza (id_reparacion, id_pieza, cantidad, precio_pieza_reparacion) VALUES (:reparacion, :pieza, :cantidad, :precio)");
        $stmt->execute([
            ':reparacion' => $idReparacion,
            ':pieza' => $idPieza,
            ':cantidad' => $cantidad,
            ':precio' => $precio
        ]);
    }

    /**
     * @param int $idReparacionPieza
     * @return array|null
     * devuelve las piezas usadas en una reparacion por su id
     */
public function getPiezaUsada(int $idReparacionPieza): ?array
{
    $stmt = $this->pdo->prepare("
        SELECT * FROM reparacion_pieza 
        WHERE id_reparacion_pieza = :id
    ");
    $stmt->execute([':id' => $idReparacionPieza]);
    return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
}

    /**
     * @param int $idReparacionPieza
     * @return void
     * elimina uan pieza usada en una reparacion
     */
    public function eliminarPieza(int $idReparacionPieza) {
        $stmt = $this->pdo->prepare("DELETE FROM reparacion_pieza WHERE id_reparacion_pieza = :id");
        $stmt->execute([':id' => $idReparacionPieza]);
    }

    /**
     * @param int $idVehiculo
     * @return array
     * devuelve las piezas utilizadas en una reparacion por la id del vehiculo
     */
    public function getPiezasUsadas(int $idVehiculo): array {
        $stmt = $this->pdo->prepare("
            SELECT rp.*, p.nombre, p.codigo 
            FROM reparacion_pieza rp 
            JOIN reparaciones r ON r.id_reparacion = rp.id_reparacion
            JOIN piezas p ON p.id_pieza = rp.id_pieza
            WHERE r.id_vehiculo = :id
        ");
        $stmt->execute([':id' => $idVehiculo]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

 
}