<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class RolModel extends BaseDbModel
{
    /**
     * @return array
     * devuelve los roles de la BBDD
     */
    public function getRoles(): array
    {
        $stmt = $this->pdo->query("SELECT id_rol, nombre_rol FROM roles ORDER BY id_rol");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



}