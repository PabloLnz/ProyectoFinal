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


    public function getVehiculosActivos(): array
    {
        $stmt = $this->pdo->query("
        SELECT DISTINCT v.id_vehiculo,
                        v.matricula,
                        v.marca,
                        v.modelo,
                        v.anyo,
                        v.estado AS estado_vehiculo,
                        c.nombre AS cliente_nombre,
                        c.telefono AS cliente_telefono,
                        c.email AS cliente_email,
                        c.direccion AS cliente_direccion,
                        r.fecha_reserva,
                        r.comentariosReserva
        FROM vehiculos v
        INNER JOIN clientes c ON v.id_cliente = c.id_cliente
        INNER JOIN reservas r ON r.id_vehiculo = v.id_vehiculo
        WHERE r.estado IN ('confirmada','finalizada')
        ORDER BY v.id_vehiculo ASC
    ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function actualizarEstadoPend(int $idVehiculo, string $estado): bool {
        $stmt = $this->pdo->prepare("UPDATE vehiculos SET estado = :estado WHERE id_vehiculo = :id");
        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $idVehiculo
        ]);
    }

    public function getVehiculoById(int $idVehiculo)
    {
        $stmt = $this->pdo->prepare("
            SELECT v.*, 
                   c.nombre AS cliente_nombre, 
                   c.telefono AS cliente_telefono,
                   c.email AS cliente_email, 
                   c.direccion AS cliente_direccion,
                   v.estado AS estado_vehiculo
            FROM vehiculos v
            INNER JOIN clientes c ON v.id_cliente = c.id_cliente
            WHERE v.id_vehiculo = :id
        ");
        $stmt->execute([':id' => $idVehiculo]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function actualizarEstado(int $idVehiculo, string $estado)
    {
        $stmt = $this->pdo->prepare("
            UPDATE vehiculos SET estado = :estado WHERE id_vehiculo = :id
        ");
        $stmt->execute([':estado' => $estado, ':id' => $idVehiculo]);
    }
}
