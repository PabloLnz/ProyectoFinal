<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class PiezasModel extends BaseDbModel
{

    /**
     * @return array
     * devuelce las piezas disponibles
     */
public function getPiezasDisponibles(): array {
    return $this->pdo->query("
        SELECT * FROM piezas ORDER BY nombre ASC
    ")->fetchAll(\PDO::FETCH_ASSOC);
}

    /**
     * @param int $idPieza
     * @return float|null
     * deculeve el precio de la pieza
     */
public function getPrecioPieza(int $idPieza): ?float {
    $stmt = $this->pdo->prepare("SELECT precio FROM piezas WHERE id_pieza = :id LIMIT 1");
    $stmt->execute([':id' => $idPieza]);
    return $stmt->fetchColumn();
}

    /**
     * @param int $idPieza
     * @param int $cantidad
     * @return bool
     * quita stock de la BBDD
     */
    public function quitarStock(int $idPieza, int $cantidad): bool {
        $stmt = $this->pdo->prepare("
        UPDATE piezas 
        SET stock = stock - :cantidad
        WHERE id_pieza = :id AND stock >= :cantidad2
    ");
        $stmt->execute([
            ':cantidad' => $cantidad,
            ':cantidad2' => $cantidad,
            ':id' => $idPieza
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * @param int $idPieza
     * @param int $cantidad
     * @return bool
     * suma stock a la BBDD
     */
    public function sumarStock(int $idPieza, int $cantidad): bool {
        $stmt = $this->pdo->prepare("
        UPDATE piezas 
        SET stock = stock + :cantidad 
        WHERE id_pieza = :id
    ");
        return $stmt->execute([
            ':cantidad' => $cantidad,
            ':id' => $idPieza
        ]);
    }


}