<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ReparacionesModel extends BaseDbModel
{


    /**
     * @param int $idVehiculo
     * @return array|null
     * devuelve una reparacion de un vehiculo por su id
     */
public function getReparacionPorVehiculo(int $idVehiculo): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM reparaciones WHERE id_vehiculo = :id LIMIT 1");
        $stmt->execute([':id' => $idVehiculo]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * @param int $idVehiculo
     * @param int $idUsuario
     * @param string $descripcion
     * @return false|string
     * crea y registra una nueva reparacion
     */
    public function crearReparacion(int $idVehiculo, int $idUsuario, string $descripcion) {
        $stmt = $this->pdo->prepare("INSERT INTO reparaciones (id_vehiculo, id_usuario, descripcion, fecha_inicio) VALUES (:vehiculo, :usuario, :desc, NOW())");
        $stmt->execute([
            ':vehiculo' => $idVehiculo,
            ':usuario' => $idUsuario,
            ':desc' => $descripcion
        ]);
        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $idVehiculo
     * @param int $idUsuario
     * @param string|null $descripcion
     * @return false|string
     * crea una nueva reparacion y la marca como pendiente
     */
   public function crearReparacionPendiente(int $idVehiculo, int $idUsuario, string $descripcion = null)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO reparaciones (id_vehiculo, id_usuario, descripcion, fecha_inicio)
            VALUES (:vehiculo, :usuario, :desc, NOW())
        ");

        $stmt->execute([
            ':vehiculo' => $idVehiculo,
            ':usuario'  => $idUsuario,
            ':desc'     => $descripcion
        ]);

        return $this->pdo->lastInsertId();
    }

    /**
     * @param int $idVehiculo
     * @return mixed|null
     * devuelve una reparacion pendiente para un vehiculo
     */
    public function getReparacionPendientePorVehiculo(int $idVehiculo)
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM reparaciones
            WHERE id_vehiculo = :id AND fecha_fin IS NULL
            LIMIT 1
        ");

        $stmt->execute([':id' => $idVehiculo]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * @param int $idReparacion
     * @param float $coste
     * @return void
     * actualiza el coste y marca el fin de una reparacion
     */
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