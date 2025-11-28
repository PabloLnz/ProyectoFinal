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
            $sql .= " ORDER BY ut.id_usuario $dir";
        } elseif ($order == 2) {
            $sql .= " ORDER BY ut.nombre $dir"; 
        } elseif ($order == 3) {
            $sql .= " ORDER BY r.nombre_rol $dir"; 
        } elseif ($order == 4) {
            $sql .= " ORDER BY ut.email $dir"; 
        } elseif ($order == 5) {
            $sql .= " ORDER BY ut.activo $dir"; 
        }else {
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
            $sql .= " ORDER BY ut.id_usuario $dir";
        } elseif ($order == 2) {
            $sql .= " ORDER BY ut.nombre $dir"; 
        } elseif ($order == 3) {
            $sql .= " ORDER BY r.nombre_rol $dir"; 
        } elseif ($order == 4) {
            $sql .= " ORDER BY ut.email $dir"; 
        } elseif ($order == 5) {
            $sql .= " ORDER BY ut.activo $dir"; 
        }else {
            $sql .= " ORDER BY ut.nombre $dir";
        }


    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($valores);
    return $stmt->fetchColumn(0);
}


    public function getUsuariosActivos()
    {
        $stmt = $this->pdo->query('
            SELECT *
            FROM usuario_taller ut
            INNER JOIN roles r ON ut.id_rol = r.id_rol
            WHERE ut.activo = 1
            ORDER BY ut.nombre ASC
        ');
        
        return $stmt->fetchAll();
    }

        public function actualizarDisponibilidad($id_usuario, $estado)
    {
        $stmt = $this->pdo->prepare("UPDATE usuario_taller 
                                    SET disponibilidad = :estado 
                                    WHERE id_usuario = :id");

        $stmt->execute([
            ':estado' => $estado,
            ':id'     => $id_usuario
        ]);
    }

    public function deleteEmpleado(int $id_usuario): bool
    {
        $sql = "DELETE FROM usuario_taller WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id_usuario" => $id_usuario,
        ]);
     
        return $stmt->rowCount() > 0;
    }

    public function getUsuarioDisable($id_usuario):array|false{
        $sql="SELECT * FROM usuario_taller WHERE id_usuario = :id_usuario;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

       public function setAlta(int $id_usuario):bool{
        $sql = "UPDATE usuario_taller  SET activo=1 WHERE id_usuario = :id_usuario ";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            "id_usuario" => $id_usuario,

        ]);
        return $stmt->rowCount()>0;

    }

    public function setBaja(int $id_usuario):bool{
        $sql = "UPDATE usuario_taller  SET activo=0 WHERE id_usuario = :id_usuario ";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            "id_usuario" => $id_usuario,

        ]);
        return $stmt->rowCount()>0;

    }
    

}
