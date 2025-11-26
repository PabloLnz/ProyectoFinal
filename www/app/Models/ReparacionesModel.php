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

    public function agregarPieza(int $idReparacion, int $idPieza, int $cantidad, float $precio) {
        $stmt = $this->pdo->prepare("INSERT INTO reparacion_pieza (id_reparacion, id_pieza, cantidad, precio_pieza_reparacion) VALUES (:reparacion, :pieza, :cantidad, :precio)");
        $stmt->execute([
            ':reparacion' => $idReparacion,
            ':pieza' => $idPieza,
            ':cantidad' => $cantidad,
            ':precio' => $precio
        ]);
    }

    public function eliminarPieza(int $idReparacionPieza) {
        $stmt = $this->pdo->prepare("DELETE FROM reparacion_pieza WHERE id_reparacion_pieza = :id");
        $stmt->execute([':id' => $idReparacionPieza]);
    }

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

    //public function calcularTotal(int $idVehiculo): float {
     //   $stmt = $this->pdo->prepare("
      //      SELECT SUM(cantidad * precio) as total

    //}

}