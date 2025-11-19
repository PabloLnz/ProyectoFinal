<?php

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class EmpleadosModel extends BaseDbModel
{
    public function getEmpleadosEmail(string $email):array|false{
        $stmt = $this->pdo->prepare("SELECT * FROM usuario_taller WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    public function insertEmpleado(string $nombre, string $email, string $passHash, string $telefono, int $id_rol, int $id_pais): bool
    {
        $sql = "INSERT INTO usuario_taller (nombre, email, pass, telefono, id_rol, id_pais, activo)
            VALUES (:nombre, :email, :pass, :telefono, :id_rol, :id_pais, 1)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':pass' => $passHash,
            ':telefono' => $telefono,
            ':id_rol' => $id_rol,
            ':id_pais' => $id_pais,
        ]);
        return $stmt->rowCount() > 0;
    }

    public function getRoles(): array
    {
        $stmt = $this->pdo->query("SELECT id_rol, nombre_rol FROM roles ORDER BY id_rol");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPaises(): array
    {
        $stmt = $this->pdo->query("SELECT id_pais, nombre FROM paises ORDER BY nombre");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function obtenerCrearPaises(string $codigo, string $nombre): int
    {
    
        $stmt = $this->pdo->prepare("SELECT id_pais FROM paises WHERE nombre = :nombre LIMIT 1");
        $stmt->execute([':nombre' => $nombre]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row && isset($row['id_pais'])) {
            return (int)$row['id_pais'];
        }
        $stmt = $this->pdo->prepare("INSERT INTO paises (nombre) VALUES (:nombre)");
        $stmt->execute([':nombre' => $nombre]);
        return (int)$this->pdo->lastInsertId();
    }
}