<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ReservasModel extends BaseDbModel
{
    public function insertReserva(int $id_cliente, int $id_vehiculo, string $fecha_reserva, string $hora_reserva, ?string $comentariosReserva = null): bool {
        $sql = "INSERT INTO reservas (id_cliente, id_vehiculo, fecha_reserva, hora_reserva, estado, comentariosReserva, creacion_reserva) VALUES (:id_cliente, :id_vehiculo, :fecha_reserva, :hora_reserva, 'pendiente', :comentariosReserva, CURRENT_TIMESTAMP)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_cliente' => $id_cliente,
            ':id_vehiculo' => $id_vehiculo,
            ':fecha_reserva' => $fecha_reserva,
            ':hora_reserva' => $hora_reserva,
            ':comentariosReserva' => $comentariosReserva
        ]);

        return $stmt->rowCount() > 0;
    }
}