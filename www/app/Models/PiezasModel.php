<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class PiezasModel extends BaseDbModel
{
  

    public function getPiezasDisponibles()
    {
        $stmt = $this->pdo->query("
            SELECT * FROM piezas
            WHERE stock > 0
            ORDER BY nombre ASC
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


}