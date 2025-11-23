<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class VehiculosModel extends BaseDbModel
{
    public function obtenerCrearVehiculo(int $idCliente, string $matricula, string $marca, string $modelo, int $anyo): int
    {

        $stmt = $this->pdo->prepare("SELECT id_vehiculo FROM vehiculos WHERE matricula = :matricula LIMIT 1");
        $stmt->execute([':matricula' => $matricula]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row && isset($row['id_vehiculo'])) {
            return (int)$row['id_vehiculo'];
        }

        $stmt = $this->pdo->prepare("
        INSERT INTO vehiculos (id_cliente, matricula, marca, modelo, anyo)
        VALUES (:id_cliente, :matricula, :marca, :modelo, :anyo)
    ");

        $stmt->execute([
            ':id_cliente' => $idCliente,
            ':matricula'  => $matricula,
            ':marca'      => $marca,
            ':modelo'     => $modelo,
            ':anyo'       => $anyo
        ]);

        return (int)$this->pdo->lastInsertId();
    }

}