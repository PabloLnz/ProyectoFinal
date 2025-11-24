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


    public function getReservasByCliente($idCliente)
    {
        $sql = "SELECT r.*, v.marca, v.modelo, v.matricula
                FROM reservas r
                INNER JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
                WHERE r.id_cliente = :id_cliente
                ORDER BY r.fecha_reserva DESC, r.hora_reserva DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_cliente' => $idCliente]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


        public function deleteReservaCliente(int $id_reserva): bool {
        $sql = "DELETE FROM reservas WHERE id_reserva = :id_reserva";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id_reserva" => $id_reserva
        ]);
        return $stmt->rowCount() > 0;
    }

    public function obtenerReserva(int $id_reserva): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reservas WHERE id_reserva = :id_reserva");
        $stmt->execute(['id_reserva' => $id_reserva]);
        return $stmt->fetch(\PDO::FETCH_ASSOC); 
    }

}