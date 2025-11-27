<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ReparacionesModel extends BaseDbModel
{
  

public function getReparacionPorVehiculo(int $idVehiculo): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM reparaciones WHERE id_vehiculo = :id LIMIT 1");
        $stmt->execute([':id' => $idVehiculo]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function crearReparacion(int $idVehiculo, int $idUsuario, string $descripcion) {
        $stmt = $this->pdo->prepare("INSERT INTO reparaciones (id_vehiculo, id_usuario, descripcion, fecha_inicio) VALUES (:vehiculo, :usuario, :desc, NOW())");
        $stmt->execute([
            ':vehiculo' => $idVehiculo,
            ':usuario' => $idUsuario,
            ':desc' => $descripcion
        ]);
        return $this->pdo->lastInsertId();
    }



public function actualizarCoste(int $idReparacion, float $coste)
{
    $stmt = $this->pdo->prepare("
        UPDATE reparaciones
        SET coste = :coste, fecha_fin = NOW()
        WHERE id_reparacion = :id
    ");
    $stmt->execute([':coste' => $coste, ':id' => $idReparacion]);

}
}