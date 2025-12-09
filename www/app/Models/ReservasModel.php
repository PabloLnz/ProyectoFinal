<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ReservasModel extends BaseDbModel
{
    /**
     * @param int $id_cliente
     * @param int $id_vehiculo
     * @param string $fecha_reserva
     * @param string $hora_reserva
     * @param string|null $comentariosReserva
     * @return bool
     * crea una reserva
     */
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

    /**
     * @param $idCliente
     * @return array|false
     * devuelve lasreservas d e un cliente
     */
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


    /**
     * @param int $id_reserva
     * @return bool
     * permite aun cliente borrar su reserva
     */
        public function deleteReservaCliente(int $id_reserva): bool {
        $sql = "DELETE FROM reservas WHERE id_reserva = :id_reserva";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id_reserva" => $id_reserva
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * @param int $id_reserva
     * @return array|false
     * muestra una reserva especifica
     */
    public function obtenerReserva(int $id_reserva): array|false
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reservas WHERE id_reserva = :id_reserva");
        $stmt->execute(['id_reserva' => $id_reserva]);
        return $stmt->fetch(\PDO::FETCH_ASSOC); 
    }

    /**
     * @return array|false
     * muestra todas las reservas incluyendo detalles
     */
    public function getReservasGeneral()
    {
        $sql = "SELECT r.id_reserva,r.fecha_reserva,r.hora_reserva,r.estado,r.creacion_reserva,c.id_cliente,c.nombre AS nombre_cliente,v.id_vehiculo,v.marca,v.modelo,v.matricula,v.anyo,v.estado AS estado_vehiculo
                FROM reservas r
                INNER JOIN clientes c ON r.id_cliente = c.id_cliente
                INNER JOIN vehiculos v ON r.id_vehiculo = v.id_vehiCulo
                ORDER BY 
                    FIELD(LOWER(r.estado), 'pendiente', 'confirmada') DESC,
                    r.creacion_reserva ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return mixed
     * devuelve todos los detalles de una reserva por su id
     */
    public function getReservaById($id) {
        $sql = "SELECT r.id_reserva,r.fecha_reserva,r.hora_reserva,r.estado,r.creacion_reserva,
                    c.id_cliente,c.nombre AS nombre_cliente, c.telefono, c.email,r.comentariosReserva,
                    v.id_vehiculo,v.marca,v.modelo,v.matricula,v.anyo,v.estado AS estado_vehiculo
                FROM reservas r
                INNER JOIN clientes c ON r.id_cliente = c.id_cliente
                INNER JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
                WHERE r.id_reserva = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id_reserva
     * @param string $nuevo_estado
     * @return bool
     * cambia el estado de una reserva
     */
    public function cambiarEstado(int $id_reserva, string $nuevo_estado): bool
    {
        $sql = "UPDATE reservas SET estado = :estado WHERE id_reserva = :id_reserva";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'estado' => $nuevo_estado,
            'id_reserva' => $id_reserva
        ]);
    }

}