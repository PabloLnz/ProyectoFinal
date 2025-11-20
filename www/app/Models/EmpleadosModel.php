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

public function getEmpeleadosByFilters(array $parametros, int $page, int $order, string $dir): array
{
    $valores = [];
    $offset = ($page - 1) * 2;
    $filtros = [];

    if (isset($parametros['inputNombre']) && $parametros['inputNombre'] !== "") {
        $filtros[] = "ut.nombre LIKE :inputNombre";
        $valores['inputNombre'] = "%" . $parametros["inputNombre"] . "%";
    }

    if (isset($parametros['selectPuesto']) && is_numeric($parametros['selectPuesto']) && $parametros['selectPuesto'] > 0) {
        $filtros[] = "ut.id_rol = :selectPuesto";
        $valores['selectPuesto'] = $parametros["selectPuesto"];
    }

    if (isset($parametros['selectEstado']) && ($parametros['selectEstado'] === '0' || $parametros['selectEstado'] === '1')) {
        $filtros[] = "ut.activo = :selectEstado";
        $valores['selectEstado'] = $parametros["selectEstado"];
    }

    $sql = "SELECT ut.id_usuario, ut.nombre, ut.email, ut.activo, ut.id_rol,
                   r.nombre_rol AS nombre_rol
                FROM usuario_taller ut
                LEFT JOIN roles r ON ut.id_rol = r.id_rol";

    if ($filtros) {
        $sql .= " WHERE " . implode(" AND ", $filtros) . " ";
    }

    if ($order == 1) {
        $sql .= " ORDER BY ut.nombre $dir";
    } elseif ($order == 2) {
        $sql .= " ORDER BY ut.email $dir";
    } elseif ($order == 3) {
        $sql .= " ORDER BY r.nombre_rol $dir";
    } else {
        $sql .= " ORDER BY ut.nombre $dir";
    }

    $sql .= " LIMIT 2 OFFSET $offset";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($valores);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
public function getLastEmpleados(array $parametros, int $order, string $dir): int
{
    $valores = [];
    $filtros = [];

    if (isset($parametros['inputNombre']) && $parametros['inputNombre'] !== "") {
        $filtros[] = "ut.nombre LIKE :inputNombre";
        $valores['inputNombre'] = "%" . $parametros["inputNombre"] . "%";
    }

    if (isset($parametros['selectPuesto']) && is_numeric($parametros['selectPuesto']) && $parametros['selectPuesto'] > 0) {
        $filtros[] = "ut.id_rol = :selectPuesto";
        $valores['selectPuesto'] = $parametros["selectPuesto"];
    }

    if (isset($parametros['selectEstado']) && ($parametros['selectEstado'] === '0' || $parametros['selectEstado'] === '1')) {
        $filtros[] = "ut.activo = :selectEstado";
        $valores['selectEstado'] = $parametros["selectEstado"];
    }

    $sql = "SELECT COUNT(*) AS total
                FROM usuario_taller ut
                LEFT JOIN roles r ON ut.id_rol = r.id_rol";

    if ($filtros) {
        $sql .= " WHERE " . implode(" AND ", $filtros) . " ";
    }

    if ($order == 1) {
        $sql .= " ORDER BY ut.nombre $dir";
    } elseif ($order == 2) {
        $sql .= " ORDER BY ut.email $dir";
    } elseif ($order == 3) {
        $sql .= " ORDER BY r.nombre_rol $dir";
    } else {
        $sql .= " ORDER BY ut.nombre $dir";
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($valores);
    return $stmt->fetchColumn(0);
}


}