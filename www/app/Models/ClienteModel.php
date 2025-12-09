<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ClienteModel extends BaseDbModel
{


    /**
     * @param string $email
     * @return array|false
     * comprueba si ya hay un usuario con ese email
     */
    public function getusuariosEmail(string $email):array|false{
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    /**
     * @param string $email
     * @return array
     * decuelve los datos de un cliente
     */
    public function getDatosCliente(string $email):array{
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    /**
     * @param string $nombre
     * @param string $email
     * @param string $passHash
     * @param string $telefono
     * @param string $direccion
     * @return bool
     * permite insertar clientes
     */
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