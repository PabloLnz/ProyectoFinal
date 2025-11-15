<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ClienteModel extends BaseDbModel
{


    public function getusuariosLogin(string $email):array|false{
        $stmt = $this->pdo->prepare("SELECT * FROM usuario_sistema WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }


}