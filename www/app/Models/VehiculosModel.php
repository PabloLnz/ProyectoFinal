<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class VehiculosModel extends BaseDbModel
{
    /**
     * @param int $idCliente
     * @param string $matricula
     * @param string $marca
     * @param string $modelo
     * @param int $anyo
     * @return int
     * busca un vehiculo por su matricula y lo devuelve si existe, si no existe lo crea y lo devuelve
     */
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


    /**
     * @return array
     * devuelve todos los vehiculos con reservas confirmadas o finalizadas
     */
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
                r.comentariosReserva,
                rep.fecha_fin AS reparacion_fin,
                rep.coste AS coste_reparacion
FROM vehiculos v
INNER JOIN clientes c ON v.id_cliente = c.id_cliente
INNER JOIN reservas r ON r.id_vehiculo = v.id_vehiculo
LEFT JOIN reparaciones rep ON rep.id_vehiculo = v.id_vehiculo
WHERE r.estado IN ('confirmada','finalizada')
ORDER BY v.id_vehiculo ASC
    ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $idVehiculo
     * @param string $estado
     * @return bool
     * fuerza el estado de un vehiculo a pendiente
     */
    public function actualizarEstadoPend(int $idVehiculo, string $estado): bool {
        $stmt = $this->pdo->prepare("UPDATE vehiculos SET estado = :estado WHERE id_vehiculo = :id");
        return $stmt->execute([
            ':estado' => $estado,
            ':id' => $idVehiculo
        ]);
    }

    /**
     * @param int $idVehiculo
     * @return mixed
     * devuelve un vehiculo segun su id
     */
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

    /**
     * @param int $idVehiculo
     * @param string $estado
     * @return void
     * actualiza el estado del vehiculo
     */
    public function actualizarEstado(int $idVehiculo, string $estado)
    {
        $stmt = $this->pdo->prepare("
            UPDATE vehiculos SET estado = :estado WHERE id_vehiculo = :id
        ");
        $stmt->execute([':estado' => $estado, ':id' => $idVehiculo]);
    }
}
