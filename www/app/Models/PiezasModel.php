<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class PiezasModel extends BaseDbModel
{
  

public function getPiezasDisponibles(): array {
    return $this->pdo->query("
        SELECT * FROM piezas ORDER BY nombre ASC
    ")->fetchAll(\PDO::FETCH_ASSOC);
}

public function getPrecioPieza(int $idPieza): ?float {
    $stmt = $this->pdo->prepare("SELECT precio FROM piezas WHERE id_pieza = :id LIMIT 1");
    $stmt->execute([':id' => $idPieza]);
    return $stmt->fetchColumn();
}

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