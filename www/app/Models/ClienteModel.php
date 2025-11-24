<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ClienteModel extends BaseDbModel
{


    public function getusuariosEmail(string $email):array|false{
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }
    public function getDatosCliente(string $email):array{
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }
    public function insertCliente(string $nombre, string $email, string $passHash, string $telefono, string $direccion): bool
    {

        $sql = "INSERT INTO clientes (nombre, email, pass, telefono, direccion) 
            VALUES (:nombre, :email, :pass, :telefono, :direccion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':pass' => $passHash,
            ':telefono' => $telefono,
            ':direccion' => $direccion,
        ]);
        return $stmt->rowCount()>0;

    }


}