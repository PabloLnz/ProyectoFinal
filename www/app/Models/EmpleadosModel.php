<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class EmpleadosModel extends BaseDbModel
{
    public function getEmpleadosLogin(string $email):array|false{
        $stmt = $this->pdo->prepare("SELECT * FROM usuario_taller WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

}